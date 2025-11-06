<?php
/**
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * File   : jagoteknik\app\Http\Controllers\ChatController.php
 * Desc   : Chat Controller
 * Date   : 2025-11-06
 */

namespace App\Http\Controllers;


use App\Models\LiveChat;
use App\Models\User;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ChatController extends Controller
{
    public function index()
    {
        return view('livechatview');
    }


    public function rooms(Request $req)
    {
        $auth = Auth::user();
        if (!$auth) {
            $auth = User::first();
            if (!$auth) {
                return response()->json(['rooms' => [], 'unread_total' => 0, 'me' => []]);
            }
        }


        // Normalisasi field user yang dipakai aplikasi
        $authId    = $auth->id_user ?? $auth->id;
        $authName  = $auth->nama    ?? $auth->name ?? 'Me';
        $authEmail = $auth->email   ?? null;


        // Deteksi role: prioritas pakai mentor.user_id kalau ada; fallback cocokkan email
        $mentor = Mentor::where(function ($q) use ($authId) {
                        $q->where('user_id', $authId);
                    })
                    ->orWhere(function ($q) use ($authEmail) {
                        if ($authEmail) $q->where('email', $authEmail);
                    })
                    ->first();


        $isMentor = (bool) $mentor;


        if ($isMentor) {
            // daftar user yang pernah chat dengan mentor ini
            $pairs = LiveChat::select('id_user')
                ->where('id_mentor', $mentor->id_mentor)
                ->groupBy('id_user')
                ->pluck('id_user');


            // ambil profil user lawan bicara
            $partners = User::whereIn('id_user', $pairs)->get()->keyBy('id_user');
        } else {
            // daftar mentor yang pernah chat dengan user ini
            $pairs = LiveChat::select('id_mentor')
                ->where('id_user', $authId)
                ->groupBy('id_mentor')
                ->pluck('id_mentor');


            // ambil profil mentor lawan bicara
            $partners = Mentor::whereIn('id_mentor', $pairs)->get()->keyBy('id_mentor');
        }


        $rooms = [];
        $unreadTotal = 0;


        foreach ($pairs as $pid) {
            if ($isMentor) {
                $partner = $partners[$pid] ?? null;
                $name    = $partner->nama ?? $partner->name ?? 'User';
                $avatar  = $partner->foto_profil
                           ?? $partner->avatar
                           ?? 'https://i.pravatar.cc/150?img=12';


                $last = LiveChat::where('id_mentor', $mentor->id_mentor)
                        ->where('id_user', $pid)
                        ->orderByDesc('created_at')
                        ->orderByDesc('tanggal')
                        ->orderByDesc('waktu')
                        ->first();


                $unread = LiveChat::where('id_mentor', $mentor->id_mentor)
                        ->where('id_user', $pid)
                        ->where('sender_type', 'user')
                        ->where('is_read', 0)
                        ->count();


                $msgs = LiveChat::where('id_mentor', $mentor->id_mentor)
                        ->where('id_user', $pid)
                        ->orderBy('created_at')
                        ->orderBy('tanggal')
                        ->orderBy('waktu')
                        ->take(50)->get()
                        ->map(fn($m) => $this->mapMessage($m, true))
                        ->values();


                $rid = "user:$pid";
            } else {
                $partner = $partners[$pid] ?? null;
                $name    = $partner->nama ?? $partner->name ?? 'Mentor';
                $avatar  = $partner->foto_profil
                           ?? $partner->avatar
                           ?? 'https://i.pravatar.cc/150?img=22';


                $last = LiveChat::where('id_user', $authId)
                        ->where('id_mentor', $pid)
                        ->orderByDesc('created_at')
                        ->orderByDesc('tanggal')
                        ->orderByDesc('waktu')
                        ->first();


                $unread = LiveChat::where('id_user', $authId)
                        ->where('id_mentor', $pid)
                        ->where('sender_type', 'mentor')
                        ->where('is_read', 0)
                        ->count();


                $msgs = LiveChat::where('id_user', $authId)
                        ->where('id_mentor', $pid)
                        ->orderBy('created_at')
                        ->orderBy('tanggal')
                        ->orderBy('waktu')
                        ->take(50)->get()
                        ->map(fn($m) => $this->mapMessage($m, false))
                        ->values();


                $rid = "mentor:$pid";
            }


            $unreadTotal += $unread;


            $rooms[] = [
                'id'      => $rid,
                'name'    => $name,
                'avatar'  => $avatar,
                'unread'  => $unread,
                'time'    => $this->formatTime($last),
                'last'    => $last->message ?? '',
                'messages'=> $msgs,
            ];
        }


        // urut terbaru + unread
        usort($rooms, function ($a, $b) {
            $ta = $a['time'] ?? '00:00';
            $tb = $b['time'] ?? '00:00';
            $cmp = strcmp($tb, $ta);
            return $cmp !== 0 ? $cmp : ($b['unread'] <=> $a['unread']);
        });


        return response()->json([
            'rooms'        => $rooms,
            'unread_total' => $unreadTotal,
            'me'           => [
                'is_mentor' => $isMentor,
                'mentor_id' => $mentor->id_mentor ?? null,
                'user_id'   => $authId,
                'name'      => $authName,
                'avatar'    => ($auth->foto_profil ?? $auth->avatar) ?: 'https://i.pravatar.cc/150?img=68',
            ],
        ]);
    }


    public function send(Request $req)
    {
        $req->validate([
            'to_type' => 'required|in:user,mentor',
            'to_id'   => 'required|integer',
            'message' => 'nullable|string',
            'media'   => 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);


        $auth = Auth::user() ?? User::first();
        if (!$auth) {
            return response()->json(['ok' => false, 'msg' => 'User tidak ditemukan'], 422);
        }


        $authId    = $auth->id_user ?? $auth->id;
        $authEmail = $auth->email ?? null;


        $mentor = Mentor::where(function ($q) use ($authId) {
                        $q->where('user_id', $authId);
                    })
                    ->orWhere(function ($q) use ($authEmail) {
                        if ($authEmail) $q->where('email', $authEmail);
                    })
                    ->first();
        $isMentor = (bool) $mentor;


        if ($isMentor) {
            $idUser   = $req->to_type === 'user' ? (int) $req->to_id : null;
            $idMentor = $mentor->id_mentor;
            $sender   = 'mentor';
            if (!$idUser) return response()->json(['ok'=>false, 'msg'=>'Target user kosong'], 422);
        } else {
            $idUser   = $authId;
            $idMentor = $req->to_type === 'mentor' ? (int) $req->to_id : null;
            $sender   = 'user';
            if (!$idMentor) return response()->json(['ok'=>false, 'msg'=>'Target mentor kosong'], 422);
        }


        $mediaUrl = null;
        if ($req->hasFile('media')) {
            $path = $req->file('media')->store('chat-media', 'public');
            $mediaUrl = Storage::url($path);
        }


        // Simpan dengan aman untuk dua kemungkinan nama kolom media (media_url/media)
        $row = new LiveChat([
            'id_user'     => $idUser,
            'id_mentor'   => $idMentor,
            'sender_type' => $sender,
            'message'     => $req->input('message'),
            'is_read'     => 0,
            'status'      => 'sent',
        ]);
        if (method_exists($row, 'isFillable')) {
            if ($row->isFillable('media_url')) $row->media_url = $mediaUrl;
            if ($row->isFillable('media'))     $row->media     = $mediaUrl;
        } else {
            // fallback
            $row->media_url = $mediaUrl;
        }
        $row->save();


        return response()->json([
            'ok'      => true,
            'message' => $this->mapMessage($row, $isMentor),
        ]);
    }


    public function markRead(Request $req)
    {
        $req->validate(['room_id' => 'required|string']);


        $auth     = Auth::user() ?? User::first();
        $authId   = $auth->id_user ?? $auth->id;
        $authMail = $auth->email ?? null;


        $mentor = Mentor::where(function ($q) use ($authId) {
                        $q->where('user_id', $authId);
                    })
                    ->orWhere(function ($q) use ($authMail) {
                        if ($authMail) $q->where('email', $authMail);
                    })
                    ->first();
        $isMentor = (bool) $mentor;


        [$type, $pid] = explode(':', $req->room_id);


        if ($isMentor && $type === 'user') {
            LiveChat::where('id_mentor', $mentor->id_mentor)
                ->where('id_user', (int) $pid)
                ->where('sender_type', 'user')
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
        } elseif (!$isMentor && $type === 'mentor') {
            LiveChat::where('id_user', $authId)
                ->where('id_mentor', (int) $pid)
                ->where('sender_type', 'mentor')
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
        }


        return response()->json(['ok' => true]);
    }


    private function mapMessage(LiveChat $m, bool $viewerIsMentor): array
    {
        $side = $viewerIsMentor
            ? ($m->sender_type === 'user'   ? 'left' : 'right')
            : ($m->sender_type === 'mentor' ? 'left' : 'right');


        // dukung 2 nama kolom media
        $media = $m->media_url ?? $m->media ?? null;


        return [
            'side' => $side,
            'type' => $media ? 'image' : 'text',
            'text' => $m->message,
            'src'  => $media,
            'time' => $this->formatTime($m),
            'read' => (int) ($m->is_read ?? 0),
        ];
    }


    private function formatTime($row): ?string
    {
        if (!$row) return null;
        if (!empty($row->created_at)) {
            return optional($row->created_at)->timezone(config('app.timezone'))->format('H:i');
        }
        // fallback bila masih pakai kolom tanggal+waktu
        $date = $row->tanggal ?? null;
        $time = $row->waktu   ?? null;
        if ($date || $time) {
            try {
                return date('H:i', strtotime(trim(($date ?: '') . ' ' . ($time ?: ''))));
            } catch (\Throwable $e) {
                return null;
            }
        }
        return null;
    }
}

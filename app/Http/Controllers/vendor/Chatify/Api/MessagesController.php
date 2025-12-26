<?php
/**
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * File   : MessagesController.php
 * Date   : 18-12-2025
 */
namespace App\Http\Controllers\vendor\Chatify\Api;

use App\Models\User;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Chatify\Http\Controllers\MessagesController as BaseMessagesController;
use App\Models\ChFavorite as Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class MessagesController extends BaseMessagesController
{
    private function userTable(): string
    {
        return (new User)->getTable(); // 'user'
    }

    private function userKey(): string
    {
        return (new User)->getKeyName(); // 'id_user'
    }

    private function authId()
    {
        // Auth::id() sudah aman kalau model auth kamu sudah diset benar
        return Auth::id();
    }

    /**
     * Convert avatar field to a valid URL for Chatify UI.
     * Supports:
     * - absolute URL (http/https)
     * - Chatify default avatar file
     * - public path like "image/gambar_mentor/hafidz.png" or "/image/gambar_mentor/hafidz.png"
     */
    private function jtAvatarUrl($user): string
    {
        $raw = $user->getRawOriginal('avatar') ?: $user->getRawOriginal('foto_profil');

        if (empty($raw)) {
            // default Chatify avatar.png
            $raw = config('chatify.user_avatar.default');
        }

        // absolute URL
        if (preg_match('#^https?://|^//#', $raw)) {
            return $raw;
        }

        // default Chatify avatar file -> storage/users-avatar/avatar.png
        if ($raw === config('chatify.user_avatar.default')) {
            return asset('storage/' . config('chatify.user_avatar.folder') . '/' . $raw);
        }

        // public path
        return asset(ltrim($raw, '/'));
    }

    /**
     * Ensure these attributes exist for Chatify JS:
     * - id
     * - name
     * - avatar (URL)
     */
    private function hydrateChatifyUser(User $u): User
    {
        // Chatify JS expects "id" + "name"
        $u->setAttribute('id', $u->getAttribute($this->userKey()));
        $u->setAttribute('name', $u->nama ?? $u->name ?? '');

        // Avatar URL for UI
        $u->setAttribute('avatar', $this->jtAvatarUrl($u));

        return $u;
    }

    public function idFetchData(Request $request)
    {
        $favorite = Chatify::inFavorite($request['id']);

        $fetch = User::where($this->userKey(), $request['id'])->first();

        if (!$fetch) {
            return Response::json([
                'favorite' => $favorite,
                'fetch' => null,
                'user_avatar' => null,
            ], 200);
        }

        $fetch = $this->hydrateChatifyUser($fetch);

        $fetchArr = $fetch->toArray();
        $fetchArr['id'] = $fetch->id;
        $fetchArr['name'] = $fetch->name;
        $fetchArr['avatar'] = $fetch->avatar;

        return Response::json([
            'favorite' => $favorite,
            'fetch' => $fetchArr,
            'user_avatar' => $fetch->avatar,
        ], 200);
    }

    public function search(Request $request)
    {
        $getRecords = '';
        $input = trim(filter_var($request['input']));
        $authId = $this->authId();
        $key = $this->userKey();

        $records = User::where($key, '!=', $authId)
            ->where(function ($q) use ($input) {
                $q->where('nama', 'LIKE', "%{$input}%")
                  ->orWhere('username', 'LIKE', "%{$input}%")
                  ->orWhere('email', 'LIKE', "%{$input}%");
            })
            ->paginate($request->per_page ?? $this->perPage);

        foreach ($records->items() as $record) {
            $record = $this->hydrateChatifyUser($record);

            $getRecords .= view('Chatify::layouts.listItem', [
                'get' => 'search_item',
                'user' => $record,
            ])->render();
        }

        if ($records->total() < 1) {
            $getRecords = '<p class="message-hint center-el"><span>Nothing to show.</span></p>';
        }

        return Response::json([
            'records' => $getRecords,
            'total' => $records->total(),
            'last_page' => $records->lastPage()
        ], 200);
    }

    public function getFavorites(Request $request)
    {
        $favoritesList = '';
        $authId = $this->authId();

        $favorites = Favorite::where('user_id', $authId);

        foreach ($favorites->get() as $favorite) {
            $user = User::where($this->userKey(), $favorite->favorite_id)->first();
            if ($user) {
                $user = $this->hydrateChatifyUser($user);
                $favoritesList .= view('Chatify::layouts.favorite', ['user' => $user])->render();
            }
        }

        return Response::json([
            'count' => $favorites->count(),
            'favorites' => $favorites->count() > 0 ? $favoritesList : 0,
        ], 200);
    }

    public function updateContactItem(Request $request)
    {
        $user = User::where($this->userKey(), $request['user_id'])->first();
        if (!$user) {
            return Response::json(['message' => 'User not found!'], 401);
        }

        $user = $this->hydrateChatifyUser($user);

        // Ambil last message + unseen (mengikuti cara Chatify)
        $lastMessage = Chatify::getLastMessageQuery($user->id);
        $unseenCounter = Chatify::countUnseenMessages($user->id);

        if ($lastMessage) {
            $lastMessage->created_at = $lastMessage->created_at->toIso8601String();
            $lastMessage->timeAgo = $lastMessage->created_at->diffForHumans();
        }

        $contactItem = view('Chatify::layouts.listItem', [
            'get' => 'users',
            'user' => $user,
            'lastMessage' => $lastMessage,
            'unseenCounter' => $unseenCounter,
        ])->render();

        return Response::json([
            'contactItem' => $contactItem,
        ], 200);
    }

    /**
     * Contacts list: tampilkan mentor dari tabel user.
     * FIX: inject avatar URL dari DB (public/image/gambar_mentor) agar tampil di Chatify.
     */
    public function getContacts(Request $request)
    {
        $authId = $this->authId();
        $key = $this->userKey();

        $users = User::query()
            ->where($key, '!=', $authId)
            ->where('is_mentor', 1)
            ->orderBy('nama', 'asc')
            ->paginate($request->per_page ?? $this->perPage);

        $contacts = '';

        foreach ($users->items() as $u) {
            $u = $this->hydrateChatifyUser($u);

            $contacts .= view('Chatify::layouts.listItem', [
                'get'  => 'users',
                'user' => $u,
            ])->render();
        }

        if (trim($contacts) === '') {
            $contacts = '<p class="message-hint center-el"><span>Tidak ada mentor</span></p>';
        }

        return response()->json([
            'contacts' => $contacts,
            'total' => $users->total(),
            'last_page' => $users->lastPage(),
        ], 200);
    }
}

<?php
/**
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * File   : MessageController.php
  * Date   : 18-12-2025
 */
namespace App\Http\Controllers\vendor\Chatify;

use App\Models\User;
use App\Models\ChMessage as LocalMessage; // kalau kamu butuh versi lokal (opsional)

use Chatify\Facades\ChatifyMessenger as Chatify;
use Chatify\Http\Controllers\MessagesController as BaseMessagesController;
use App\Models\ChFavorite as Favorite;
use App\Models\ChMessage as Message;
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
        return Auth::id(); // aman utk PK custom
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

        // pastikan avatar dan name kebentuk
        $fetchWithAvatar = Chatify::getUserWithAvatar($fetch);

        // PENTING: paksa 'name' & 'id' ada di JSON (untuk JS Chatify)
        $fetchArr = $fetchWithAvatar->toArray();
        $fetchArr['id'] = $fetchWithAvatar->id;     // dari accessor
        $fetchArr['name'] = $fetchWithAvatar->name; // dari accessor

        return Response::json([
            'favorite' => $favorite,
            'fetch' => $fetchArr,
            'user_avatar' => $fetchWithAvatar->avatar,
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
            $getRecords .= view('Chatify::layouts.listItem', [
                'get' => 'search_item',
                'user' => Chatify::getUserWithAvatar($record),
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
                $favoritesList .= view('Chatify::layouts.favorite', ['user' => $user]);
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

        return Response::json([
            'contactItem' => Chatify::getContactItem($user),
        ], 200);
    }

    /**
     * ✅ FIX UTAMA:
     * - jangan pakai GROUP BY ch_messages dulu (bikin error only_full_group_by)
     * - tampilkan mentor dari tabel user (hasil seeding) supaya list kiri langsung muncul
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
            $contacts .= view('Chatify::layouts.listItem', [
                'get'  => 'users',
                'user' => Chatify::getUserWithAvatar($u),
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

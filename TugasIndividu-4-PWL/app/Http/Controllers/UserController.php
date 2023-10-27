<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Models\User;

class UserController extends Controller
{
    public function register (Request $request) {
        try {
            $user = $request -> validate ([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required'],
                'role' => ['required'],
            ]);

            User::create($user);
            
            return response() -> json ([
                'data' => $user,
                'message' => 'Registrasi Pengguna Berhasil'
            ], 201);
        } catch (\Exception $e) {
            return response() -> json ([
                'data' => NULL,
                'message' => $e -> getMessage(),
            ], 400);
        }
    }

    public function login (Request $request) {
        try {
            $user = $request -> validate ([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            Auth::attempt($user);
        } catch (\Exception $e) {
            return response() -> json ([
                'data' => NULL,
                'message' => $e -> getMessage(),
            ], 400);
        }

        $userAuth = Auth::user();
        
        if ($userAuth) {
            $token = $userAuth -> createToken('raja') -> accessToken;

            return response() -> json ([
                'data' => [
                    'access_token' => $token,
                ],
            ], 200);
        }

        return response() -> json ([
            'data' => $user,
            'message' => 'Pengguna Tidak Ditemukan',
        ], 400);
    }

    public function unauthorize () {
        return response() -> json ([
            'message' => 'Oops.., Pengguna Tidak Terverifikasi',
        ], 401);
    }

    public function logout () {
        if (Auth::guard('api') -> check()) {
            $accessToken = Auth::guard('api') -> user() -> token();
            
            DB::table('oauth_refresh_tokens')
                -> where ('access_token_id', $accessToken -> id)
                -> update (['revoked' => true]);
            
            $accessToken -> revoke();

            return response() -> json ([
                'message' => 'Pengguna Berhasil Keluar',
            ], 200);
        }

        $this -> unauthorize();
    }
}

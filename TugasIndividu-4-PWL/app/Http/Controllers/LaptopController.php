<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\Laptop;

class LaptopController extends Controller
{
    public function create (Request $request) {
        if (Auth::user()->role === 'admin'){
            try {
                $laptop = $request -> validate ([
                    'tipe' => ['required'],
                    'kategori' => ['required'],
                    'merek' => ['required'],
                    'harga' => ['required']
                ]);

                Laptop::create($laptop);

                return response() -> json ([
                    'data' => $laptop,
                    'message' => 'Data Laptop Berhasil Dibuat'
                ], 201);
            } catch (\Exception $e) {
                return response() -> json ([
                    'data' => NULL,
                    'message' => $e -> getMessage(),
                ], 400);
            }
        }
        return response() -> json ([
            'data' => NULL,
            'message' => 'Akun Anda Tidak Memiliki Akses',
        ], 401);
    }

    public function read () {
        return response () -> json ([
            'data' => Laptop::latest() -> get(),
        ], 200);
    }

    public function update (Laptop $laptop, Request $request) {
        if (Auth::user()->role === 'admin') {
            try {
                if(!$request['tipe'] and !$request['kategori'] and !$request['merek'] and !$request['harga']) {
                    return response () -> json ([
                        'message' => 'Data Perubahan Tidak Ditemukan'
                    ], 400);
                }

                if ($request['tipe']) {
                    $laptop -> tipe = $request['tipe'];
                }
                if ($request['kategori']) {
                    $laptop -> kategori = $request['kategori'];
                }
                if ($request['merek']) {
                    $laptop -> merek = $request['merek'];
                }
                if ($request['harga']) {
                    $laptop -> harga = $request['harga'];
                }

                $laptop -> save();

                return response () -> json ([
                    'data' => $laptop,
                    'message' => 'Data Laptop Berhasil Diubah'
                ], 200);
            } catch (\Exception $e) {
                return response () -> json ([
                    'data' => NULL,
                    'message' => $e -> getMessage(),
                ], 400);
            }
        }
        return response() -> json ([
            'data' => NULL,
            'message' => 'Akun Anda Tidak Memiliki Akses',
        ], 401);
    }

    public function delete (Laptop $laptop) {
        if (Auth::user()->role === 'admin') {
            try {
                $laptop -> delete();
                
                return response () -> json ([
                    'message' => 'Data Laptop Berhasil Dihapus'
                ], 200);
            } catch (\Exception $e) {
                return response () -> json ([
                    'message' => $e -> getMessage()
                ], 400);
            }
        }
        return response() -> json ([
            'data' => NULL,
            'message' => 'Akun Anda Tidak Memiliki Akses',
        ], 401);
    }
}

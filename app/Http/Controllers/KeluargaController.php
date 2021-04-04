<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Keluarga;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
// use Illuminate\Support\Facades\Auth;

class KeluargaController extends Controller
{
    public function __construct()
    {
        // Gunanya biar semua request di controller ini
        // Harus sudah login
        // $this->middleware('role.auth:admins|keluarga');
    }

    protected static $rule = [
        'nama_keluarga' => 'required',
        'username' => 'required|unique:Keluarga',
        'email' => 'required|email|unique:Keluarga',
        'password' => 'required',
        'nama_lingkungan_diketuai' => 'unique:Keluarga'
    ];

    public function index() {
        try{
            $keluarga = Keluarga::all();

            if (sizeof($keluarga) == 0) {
                return response([
                    'message' => 'data is empty',
                    'data' => [],
                ], 200);
            } else {
                return response([
                    'message' => 'successfully retrieved',
                    'data' => $keluarga,
                ], 200);
            }
        } catch (\Illuminate\Database\QueryException $e){
            return response([
                'message' => $e,
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $keluarga = Keluarga::find($id);
            
            if ($keluarga === null) {
                return response()->json([
                    'message' => 'Not found',
                ], 404);
            } else {
                return response()->json([
                'message' => 'Successfully retrieved',
                'keluarga' => $keluarga
            ], 200);
            }
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }

    public function store(Request $request)
    {
        //validate incoming request 
        $this->validate($request, self::$rule);

        try {
            $keluarga = new Keluarga;
            $keluarga->nama_keluarga = $request->input('nama_keluarga');
            $keluarga->username = $request->input('username');
            $keluarga->email = $request->input('email');
            $plainPassword = $request->input('password');
            $keluarga->password = Hash::make($plainPassword);

            $keluarga->nama_lingkungan_diketuai = $request->nama_lingkungan_diketuai === "" 
                ? null
                : $request->input('nama_lingkungan_diketuai');
            
            $keluarga->created_at = Carbon::now();

            $keluarga->save();
            return response([
                'keluarga' => $keluarga,
                'message' => 'Registered successfully'
            ], 201);

        } catch (\Exception $e) {
            return response([
                'message' => 'Registration Failed!',
                'error' => $e
            ], 409);
        }
    }

    public function profile()
    {
        return response()->json([
            'message' => 'Successfully retrieved',
            'keluarga' => JWTAuth::user()
        ], 200);
    }

    public function update(Request $request, $id) {
        $keluarga = Keluarga::find($id);

        if ($keluarga === null) {
            return response([
                'message' => 'Not found',
            ], 404);
        } else {
            $keluarga->nama_keluarga = $request->nama_keluarga;
            $keluarga->username = $request->username;
            $keluarga->email = $request->email;
            if ($request->nama_lingkungan_diketuai === "") {
                $keluarga->nama_lingkungan_diketuai = null;
            } else {
                $keluarga->nama_lingkungan_diketuai = $request->nama_lingkungan_diketuai;
            }
            $keluarga->updated_at = Carbon::now();

            try {
                $update = $keluarga->save();
                return response([
                    'message' => 'Updated successfully',
                    'result' => $keluarga
                ], 200);
            } catch (\Illuminate\Database\QueryException $e) {
                return response([
                    'message' => $e
                ], 500);
            }
        }
    }

    public function destroy($id) {
        $keluarga = Keluarga::find($id);
        
        if ($keluarga === null) {
            return response([
                'message' => 'not found'
            ], 404);
        } else {
            try {
                $keluarga->delete();

                return response([
                    'message' => 'Deleted successfully',
                ], 200);
            } catch (\Illuminate\Database\QueryException $e) {
                return response([
                    'message' => $e,
                ], 500);
            }
        }
    }

    public function trash() {
        try {
            $trashKeluarga = Keluarga::onlyTrashed()->get();

            if (sizeof($trashKeluarga) === 0) {
                return response([
                    'message' => 'trash is empty',
                    'data' => []
                ], 200);
            } else {
                return response([
                    'message' => 'trash data received',
                    'data' => $trashKeluarga
                ], 200);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }

    public function getAllFamilyMember($idKeluarga) {
        try {
            $familyMembers = Keluarga::find($idKeluarga)->getAllFamilyMember;
            
            if ($familyMembers === null) {
                return response()->json([
                    'message' => 'No family member found',
                ], 404);
            } else {
                return response()->json([
                'message' => 'Successfully retrieved',
                'familyMembers' => $familyMembers
            ], 200);
            }
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }
}
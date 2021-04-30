<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Mail;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AdminController extends Controller
{
    public function __construct()
    {
        // Gunanya biar semua request di controller ini
        // Harus sudah login
        // $this->middleware('role.auth:admins');
    }

    protected static $rule = [
        'nama' => 'required',
        'email' => 'required|email|unique:Admin',
        'password' => 'required',
        'role' => 'required'
    ];

    public function index() {
        try{
            $admin = Admin::all();

            if (sizeof($admin) == 0) {
                return response([
                    'message' => 'data is empty',
                    'data' => [],
                ], 200);
            } else {
                return response([
                    'message' => 'successfully retrieved',
                    'data' => $admin,
                ], 200);
            }
        } catch (\Illuminate\Database\QueryException $e){
            return response([
                'message' => $e,
            ], 500);
        }
        
    }

    public function getSekretariat() {
        try{
            $admin = Admin::where('role', "Sekretariat")->get();

            if (sizeof($admin) == 0) {
                return response([
                    'message' => 'data is empty',
                    'data' => [],
                ], 200);
            } else {
                return response([
                    'message' => 'successfully retrieved',
                    'data' => $admin,
                ], 200);
            }
        } catch (\Illuminate\Database\QueryException $e){
            return response([
                'message' => $e,
            ], 500);
        }
        
    }

    public function getRomo() {
        try{
            $admin = Admin::where('role', "Romo")->get();

            if (sizeof($admin) == 0) {
                return response([
                    'message' => 'data is empty',
                    'data' => [],
                ], 200);
            } else {
                return response([
                    'message' => 'successfully retrieved',
                    'data' => $admin,
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
            $admin = Admin::find($id);
            
            if ($admin === null) {
                return response()->json([
                    'message' => 'Not found',
                ], 404);
            } else {
                return response()->json([
                'message' => 'Successfully retrieved',
                'data' => $admin
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
            $admin = new Admin;
            $admin->nama = $request->input('nama');
            $admin->email = $request->input('email');
            $plainPassword = $request->input('password');
            $admin->password = Hash::make($plainPassword);
            $admin->role = $request->input('role');
            $admin->created_at = Carbon::now();

            if($request->input('role') === 'Sekretariat') {
                $admin->id = IdGenerator::generate(['table' => 'Admin', 'length' => 10, 'prefix' =>'SKT-']);
            } else if($request->input('role') === 'Romo'){
                $admin->id = IdGenerator::generate(['table' => 'Admin', 'length' => 10, 'prefix' =>'ROM-']);
            } else if($request->input('role') === 'SU'){
                $admin->id = IdGenerator::generate(['table' => 'Admin', 'length' => 10, 'prefix' =>'SU-']);
            }
            
            $data = array(
                'nama' => $request->input('nama'),
                'role' => $request->input('role'),
                'password' => $request->input('password'),
            );

            $admin->save();

            // $this->sendEmail($data);
            return response([
                'result' => $admin,
                'message' => 'Registered successfully'
            ], 201);
        } catch (\Exception $e) {
            return response([
                'message' => 'Registration Failed!',
                'error' => $e
            ], 409);
        }
    }

    public function sendEmail($personData) {
        // Mail::to(request('NewAdminMail'))->send(new AdminAccount());
        
        Mail::send('NewAdminMail', $personData, function($message) {
            $message
                ->to($request->input('email'), $request->input('nama'));
        });
    }

    public function profile($id)
    {
        $admin = Admin::find($id);

        return response([
            'message' => 'Retrieved',
            'admin' => $admin,
        ], 404);

        // return response()->json([
        //     'message' => 'Successfully retrieved',
        //     'admin' => JWTAuth::user()
        // ], 200);
    }

    public function update(Request $request, $id) {
        $admin = Admin::find($id);

        if ($admin === null) {
            return response([
                'message' => 'Not found',
            ], 404);
        } else {
            $admin->nama = $request->nama;
            $admin->role = $request->role;
            $admin->email = $request->email;
            $admin->updated_at = Carbon::now();

            try {
                $update = $admin->save();
                return response([
                    'message' => 'Updated successfully',
                    'result' => $admin
                ], 200);
            } catch (\Illuminate\Database\QueryException $e) {
                return response([
                    'message' => $e
                ], 500);
            }
        }
    }

    public function destroy($id) {
        $admin = Admin::find($id);
        
        if ($admin === null) {
            return response([
                'message' => 'not found'
            ], 404);
        } else {
            try {
                $admin->delete();

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
}

<?php

namespace App\Http\Controllers;

use App\Models\Lingkungan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LingkunganController extends Controller
{
    public function __construct()
    {
        // Gunanya biar semua request di controller ini
        // Harus sudah login
        // $this->middleware('role.auth:admins,keluarga');
    }
    
    protected static $rule = [
        'nama_lingkungan' => 'required',
        'paroki_id' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $lingkungan = Lingkungan::all();

            if (sizeof($lingkungan) == 0) {
                return response([
                    'message' => 'data is empty',
                    'data' => [],
                ], 200);
            } else {
                return response([
                    'message' => 'successfully retrieved',
                    'data' => $lingkungan,
                ], 200);
            }
        } catch (\Illuminate\Database\QueryException $e){
            return response([
                'message' => $e,
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, self::$rule);

        try {
            $lingkungan = new Lingkungan;
            $lingkungan->nama_lingkungan = $request->input('nama_lingkungan');
            $lingkungan->paroki_id = $request->input('paroki_id');
            $lingkungan->id_ketua_lingkungan = $request->input('id_ketua_lingkungan') === "" 
                ? null
                : $request->id_ketua_lingkungan;
            $lingkungan->created_at = Carbon::now();

            $lingkungan->save();
            return response([
                'data' => $lingkungan,
                'message' => 'Registered successfully'
            ], 201);

        } catch (\Exception $e) {
            return response([
                'message' => 'Registration Failed!',
                'error' => $e
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lingkungan  $lingkungan
     * @return \Illuminate\Http\Response
     */
    public function show(Lingkungan $lingkungan)
    {
        try {
            $lingkungan = Lingkungan::find($id);
            
            if ($lingkungan === null) {
                return response()->json([
                    'message' => 'Not found',
                ], 404);
            } else {
                return response()->json([
                'message' => 'Successfully retrieved',
                'data' => $lingkungan
            ], 200);
            }
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lingkungan  $lingkungan
     * @return \Illuminate\Http\Response
     */
    public function edit(Lingkungan $lingkungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lingkungan  $lingkungan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lingkungan $lingkungan)
    {
        $lingkungan = Lingkungan::find($id);

        if ($lingkungan === null) {
            return response([
                'message' => 'Not found',
            ], 404);
        } else {
            $lingkungan->nama_ketua_lingkungan = $request->nama_ketua_lingkungan;
            $lingkungan->paroki_id = $request->paroki_id;
            if ($request->nama_ketua_lingkungan === "") {
                $lingkungan->nama_ketua_lingkungan = null;
            } else {
                $lingkungan->nama_ketua_lingkungan = $request->nama_ketua_lingkungan;
            }
            $lingkungan->updated_at = Carbon::now();

            try {
                $lingkungan->save();
                return response([
                    'message' => 'Updated successfully',
                    'result' => $lingkungan
                ], 200);
            } catch (\Illuminate\Database\QueryException $e) {
                return response([
                    'message' => $e
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lingkungan  $lingkungan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lingkungan = Lingkungan::find($id);
        
        if ($lingkungan === null) {
            return response([
                'message' => 'not found'
            ], 404);
        } else {
            try {
                $lingkungan->delete();

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

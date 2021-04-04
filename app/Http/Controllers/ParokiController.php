<?php

namespace App\Http\Controllers;

use App\Models\Paroki;
use Illuminate\Http\Request;

class ParokiController extends Controller
{
    // public function __construct()
    // {
    //     // Gunanya biar semua request di controller ini
    //     // Harus sudah login
    //     $this->middleware('role.auth:admins,keluarga');
    // }
    
    protected static $rule = [
        'nama_paroki' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $paroki = Paroki::all();

            if (sizeof($paroki) == 0) {
                return response([
                    'message' => 'data is empty',
                    'data' => [],
                ], 200);
            } else {
                return response([
                    'message' => 'successfully retrieved',
                    'data' => $paroki,
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
            $paroki = new Paroki;
            $paroki->nama_paroki = $request->input('nama_paroki');
            $paroki->id_romo_paroki = $request->id_romo_paroki === "" 
                ? null
                : $request->id_romo_paroki;
            $paroki->created_at = Carbon::now();

            $paroki->save();
            return response([
                'paroki' => $paroki,
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
     * @param  \App\Paroki  $paroki
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $paroki = Paroki::find($id);
            
            if ($paroki === null) {
                return response()->json([
                    'message' => 'Not found',
                ], 404);
            } else {
                return response()->json([
                    'paroki' => $paroki,
                    'message' => 'Successfully retrieved'
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
     * @param  \App\Paroki  $paroki
     * @return \Illuminate\Http\Response
     */
    public function edit(Paroki $paroki)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paroki  $paroki
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paroki = Paroki::find($id);

        if ($paroki === null) {
            return response([
                'message' => 'Not found',
            ], 404);
        } else {
            $paroki->nama_paroki = $request->nama_paroki;
            if ($paroki->id_romo_paroki === "") {
                $paroki->id_romo_paroki = null;
            } else {
                $paroki->id_romo_paroki = $request->id_romo_paroki;
            }
            $paroki->updated_at = Carbon::now();

            try {
                $update = $paroki->save();
                return response([
                    'message' => 'Updated successfully',
                    'result' => $paroki
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
     * @param  \App\Paroki  $paroki
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paroki = Paroki::find($id);
        
        if ($paroki === null) {
            return response([
                'message' => 'not found'
            ], 404);
        } else {
            try {
                $paroki->delete();

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

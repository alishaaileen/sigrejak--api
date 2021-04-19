<?php

namespace App\Http\Controllers;

use App\Models\Umat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UmatController extends Controller
{

    protected static $rule = [
        'nama' => 'required',
        'tempat_lahir' => 'required',
        'tgl_lahir' => 'required|date_format:Y-m-d',
        'jenis_kelamin' => 'required',
        // 'nama_baptis' => 'required',
        'alamat' => 'required',
        // 'no_telp' => 'required',
        'pekerjaan' => 'required',
        'status_meninggal' => 'required',
        'status_umat_aktif' => 'required',
        'keluarga_id' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $umat = Umat::all();

            if (sizeof($umat) == 0) {
                return response([
                    'message' => 'data is empty',
                    'data' => [],
                ], 200);
            } else {
                return response([
                    'message' => 'successfully retrieved',
                    'data' => $umat,
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
            $umat = new Umat;
            $umat->nama = $request->input('nama');
            $umat->tempat_lahir = $request->input('tempat_lahir');
            $umat->tgl_lahir = $request->input('tgl_lahir');
            $umat->jenis_kelamin = $request->input('jenis_kelamin');
            $umat->nama_baptis = $request->input('nama_baptis');
            $umat->alamat = $request->input('alamat');
            $umat->no_telp = $request->input('no_telp');
            $umat->pekerjaan = $request->input('pekerjaan');
            $umat->status_meninggal = $request->input('status_meninggal');
            $umat->status_umat_aktif = $request->input('status_umat_aktif');
            $umat->lingkungan_id = $request->input('lingkungan_id');
            $umat->paroki_id = $request->input('paroki_id');
            $umat->keluarga_id = $request->input('keluarga_id');
            // $umat->id_romo_paroki = $request->id_romo_paroki === "" 
            //     ? null
            //     : $request->id_romo_paroki;
            $umat->created_at = Carbon::now();

            $umat->save();
            return response([
                'message' => 'Registered successfully',
                'result' => $umat,
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
     * @param  \App\Umat  $umat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $umat = Umat::find($id);
            
            if ($umat === null) {
                return response()->json([
                    'message' => 'Not found',
                ], 404);
            } else {
                return response()->json([
                    'message' => 'Successfully retrieved',
                    'data' => $umat,
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
     * @param  \App\Umat  $umat
     * @return \Illuminate\Http\Response
     */
    public function edit(Umat $umat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Umat  $umat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $umat = Umat::find($id);

        if ($umat === null) {
            return response([
                'message' => 'Not found',
            ], 404);
        } else {
            $umat->nama = $request->nama;
            $umat->tempat_lahir = $request->tempat_lahir;
            $umat->tgl_lahir = $request->tgl_lahir;
            $umat->jenis_kelamin = $request->jenis_kelamin;
            $umat->nama_baptis = $request->nama_baptis;
            $umat->alamat = $request->alamat;
            $umat->no_telp = $request->no_telp;
            $umat->pekerjaan = $request->pekerjaan;
            $umat->status_meninggal = $request->status_meninggal;
            $umat->status_umat_aktif = $request->status_umat_aktif;
            $umat->lingkungan_id = $request->lingkungan_id;
            $umat->paroki_id = $request->paroki_id;
            $umat->keluarga_id = $request->keluarga_id;
            $umat->updated_at = Carbon::now();

            try {
                $update = $umat->save();
                return response([
                    'result' => $umat,
                    'message' => 'Updated successfully'
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
     * @param  \App\Umat  $umat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $umat = Umat::find($id);
        
        if ($umat === null) {
            return response([
                'message' => 'not found'
            ], 404);
        } else {
            try {
                $umat->delete();

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

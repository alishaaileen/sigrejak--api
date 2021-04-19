<?php

namespace App\Http\Controllers;

use App\Models\DetailUmat;
use Illuminate\Http\Request;

class DetailUmatController extends Controller
{
    protected static $rule = [
        'id_umat' => 'required|unique:Detail_Umat',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $detail = DetailUmat::all();

            if (sizeof($detail) == 0) {
                return response([
                    'message' => 'data is empty',
                    'data' => [],
                ], 200);
            } else {
                return response([
                    'message' => 'successfully retrieved',
                    'data' => $detail,
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
            $detail = new DetailUmat;
            $detail->id_umat = $request->input('id_umat');
            $detail->tgl_baptis = $request->input('tgl_baptis');
            $detail->tgl_komuni = $request->input('tgl_komuni');
            $detail->tgl_penguatan = $request->input('tgl_penguatan');
            $detail->cara_menikah = $request->input('cara_menikah');
            $detail->tgl_menikah = $request->input('tgl_menikah');
            $detail->file_akta_lahir = $request->input('file_akta_lahir');
            $detail->file_ktp = $request->input('file_ktp');

            $detail->save();
            return response([
                'message' => 'Registered successfully',
                'result' => $detail,
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
     * @param  \App\DetailUmat  $detailUmat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $detail = DetailUmat::find($id);
            
            if ($detail === null) {
                return response()->json([
                    'message' => 'Not found',
                ], 404);
            } else {
                return response()->json([
                    'message' => 'Successfully retrieved',
                    'data' => $detail,
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
     * @param  \App\DetailUmat  $detailUmat
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailUmat $detailUmat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetailUmat  $detailUmat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detail = Umat::find($id);

        if ($detail === null) {
            return response([
                'message' => 'Not found',
            ], 404);
        } else {
            $detail->id_umat = $request->id_umat;
            $detail->tgl_baptis = $request->tgl_baptis;
            $detail->tgl_komuni = $request->tgl_komuni;
            $detail->tgl_penguatan = $request->tgl_penguatan;
            $detail->cara_menikah = $request->cara_menikah;
            $detail->tgl_menikah = $request->tgl_menikah;
            $detail->file_akta_lahir = $request->file_akta_lahir;
            $detail->file_ktp = $request->file_ktp;

            try {
                $update = $detail->save();
                return response([
                    'result' => $detail,
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
     * @param  \App\DetailUmat  $detailUmat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $detail = DetailUmat::find($id);
        
        // if ($detail === null) {
        //     return response([
        //         'message' => 'not found'
        //     ], 404);
        // } else {
        //     try {
        //         $detail->delete();

        //         return response([
        //             'message' => 'Deleted successfully',
        //         ], 200);
        //     } catch (\Illuminate\Database\QueryException $e) {
        //         return response([
        //             'message' => $e,
        //         ], 500);
        //     }
        // }
    }
}

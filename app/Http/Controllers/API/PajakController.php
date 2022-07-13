<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PajakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama' => 'required',
            'rate' => 'required|numeric'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'validation error',
                'status' => 'failed',
                'error' => $validation->errors()
            ], 400);
        }

        Pajak::create($request->all());
        return response()->json([
            'message' => 'Pajak berhasil ditambahkan',
            'status' => 'success',
            'data' => $request->all(),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'nama' => 'required',
            'rate' => 'required|numeric'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'validation error',
                'status' => 'failed',
                'error' => $validation->errors()
            ], 400);
        }


        $update = Pajak::where('id', $id)->update($request->all());
        if (!$update) {
            return response()->json([
                'message' => "Pajak dengan id $id tidak ditemukan",
                'status' => 'failed',
                'tes' => $update
            ], 200);
        }
        return response()->json([
            'message' => "Pajak dengan id $id berhasil diupate",
            'status' => 'success',
            'tes' => $update
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Pajak::destroy($id);

        if (!$delete) {
            return response()->json([
                'message' => "Pajak dengan id $id tidak ditemukan",
                'status' => 'failed',
            ], 200);
        }

        return response()->json([
            'message' => "Pajak dengan id $id berhasil dihapus",
            'status' => 'success',
        ], 200);
    }
}

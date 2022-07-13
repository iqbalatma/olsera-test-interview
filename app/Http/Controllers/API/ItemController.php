<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemPajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $validation = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'validation error',
                'status' => 'failed',
                'error' => $validation->errors()
            ], 400);
        }


        //check pajak :minimal 2
        $idPajak = $request->input('pajak_id');
        if (count($idPajak) < 2) {
            return response()->json([
                'message' => 'Minimum requirement pajak tidak terpenuhi',
                'status' => 'failed',
            ], 400);
        }


        $item =  Item::create($request->all());

        $insertedItem = Item::find($item->id);
        $insertedItem->pajak()->attach($idPajak);

        return response()->json([
            'message' => 'Item berhasil ditambahkan',
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
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'validation error',
                'status' => 'failed',
                'error' => $validation->errors()
            ], 400);
        }

        $idPajak = $request->input('pajak_id');

        $item = Item::find($id);
        $item->pajak()->sync($idPajak);

        $update = Item::where('id', $id)->update(['nama' => $request->input('nama')]);

        if (!$update) {
            return response()->json([
                'message' => "Item dengan id $id tidak ditemukan",
                'status' => 'failed',
            ], 200);
        }

        return response()->json([
            'message' => "Item dengan id $id berhasil diupate",
            'status' => 'success',
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
        $item = Item::find($id);
        $item->pajak()->detach();

        $delete = Item::destroy($id);

        if (!$delete) {
            return response()->json([
                'message' => "Item dengan id $id tidak ditemukan",
                'status' => 'failed',
            ], 200);
        }

        return response()->json([
            'message' => "Item dengan id $id berhasil dihapus",
            'status' => 'success',
            'delete' => $delete
        ], 200);
    }
}

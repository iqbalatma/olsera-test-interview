<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemPajakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $items = DB::table('items')
        //     ->select('items.nama as nama_item', 'items.id', 'item_pajak.item_id', 'item_pajak.pajak_id', 'pajaks.rate', 'pajaks.nama as nama_pajak')
        //     ->rightJoin('item_pajak', 'items.id', '=', 'item_pajak.item_id')
        //     ->join('pajaks', 'pajaks.id', '=', 'item_pajak.pajak_id')
        //     ->get();

        $sql = "SELECT items.*, group_concat(item_pajak.item_id) FROM items 
                3 JOIN item_pajak ON items.id = item_pajak.item_id
                INNER JOIN pajaks ON pajaks.id = item_pajak.pajak_id group by items.id
            ";

        $sql = 'select items.id, items.nama,group_concat(item_pajak.pajak_id) as pajak
            from items join 
                 item_pajak 
                 on items.id = item_pajak.item_id 
            group by items.id, items.nama';
        // $sql = "SELECT item_pajak.item_id,item_pajak.pajak_id, items.id, items.nama as nama_item, GROUP_CONCAT(item_pajak.pajak_id) as pajak_id FROM items 
        //         RIGHT JOIN item_pajak ON items.id = item_pajak.item_id
        //         INNER JOIN pajaks ON pajaks.id = item_pajak.pajak_id
        //     ";

        $items = DB::select($sql);




        return response()->json([
            'data' => $items,
            'status' => 'success',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

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
        $sql = "select items.id, items.nama,
        concat(
            '[',
            group_concat(
                JSON_OBJECT(
                    'id',pajaks.id,
                    'nama', pajaks.nama,
                     'rate', concat(pajaks.rate * 100,'%')
                     )
                ),
            ']'
                )
            as pajak
            from items join 
                 item_pajak 
                 on items.id = item_pajak.item_id
                 join pajaks on pajaks.id = item_pajak.pajak_id
            group by items.id, items.nama";

        $items = DB::select($sql);
        $finalItems = [];
        foreach ($items as $key => $value) {
            $currentItem = $value;
            $currentItem->pajak = json_decode($value->pajak);
            array_push($finalItems, $currentItem);
        }


        return response()->json([
            'status' => 'success',
            'final_item' => $finalItems
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

<?php

namespace App\Http\Controllers\API;

use App\Models\transaksi;
use App\Http\Controllers\Controller;
use App\Models\masterBarang;
use App\Http\Requests\StoretransaksiRequest;
use App\Http\Requests\UpdatetransaksiRequest;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
   
    public function index()
    {
        return Transaksi::all();
    }

    public function store(Request $request)
    {
        $body = $request->all();
        $body['tanggalTransaksi'] = date('Y-m-d H:i:s');
        
        try {
            $create = Transaksi::create($body);
            
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json('QueryException', 500);
        } catch (\Throwable $th) {
            return 'error';
        }

        masterBarang::findOrFail($request->master_barang_id)->kurangiStok($request->terjual);
        return $create;
    }

    public function show(Transaksi $transaksi)
    {
        return $transaksi;
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        

        try {
            if ($transaksi->master_barang_id == $request->master_barang_id) {
                $updateData = $request->terjual - $transaksi->terjual;
                masterBarang::findOrFail($transaksi->master_barang_id)->kurangiStok($updateData);
            }
            
            $transaksi->update($request->all());            
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json($ex.'QueryException', 500);
        } catch (\Throwable $th) {
            return 'error';
        }

        return $transaksi;
    }

    public function destroy(Transaksi $transaksi)
    {
        masterBarang::findOrFail($transaksi->master_barang_id)->kurangiStok(-$transaksi->terjual);
        $transaksi->delete();
        return response()->json('the item was been deleted', 204);
    }

}

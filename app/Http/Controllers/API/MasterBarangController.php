<?php

namespace App\Http\Controllers\API;

use App\Models\masterBarang;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoremasterBarangRequest;
use App\Http\Requests\UpdatemasterBarangRequest;
use Illuminate\Http\Request;


class MasterBarangController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        return MasterBarang::all();
    }

    public function store(Request $request)
    {
        try {
            $create = MasterBarang::create($request->all());
            
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json('QueryException', 500);
        } catch (\Throwable $th) {
            return 'error';
        }
        return $create;
    }

    public function show(MasterBarang $masterBarang)
    {
        return $masterBarang;
    }

    public function update(Request $request, MasterBarang $masterBarang)
    {
        $masterBarang->update($request->all());
        return $masterBarang;
    }

    public function destroy(MasterBarang $masterBarang)
    {
        $masterBarang->delete();
        return response()->json('the item was been deleted', 204);
    }
}

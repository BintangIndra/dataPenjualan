<?php
namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterBarangController extends Controller
{
    public function index()
    {
        // session('user_token')
        return view('masterBarang.index');
    }
}
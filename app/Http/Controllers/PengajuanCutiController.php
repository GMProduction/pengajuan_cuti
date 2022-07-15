<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    //
    public function index(){
        return view('admin.transaksi', ['sidebar' => 'cuti']);

    }
}

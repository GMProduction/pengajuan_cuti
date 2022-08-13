<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
        $user = User::with('karyawan')->find(auth()->id());
        return view('karyawan.profil', ['sidebar' => 'profil', 'data' => $user]);
    }

}

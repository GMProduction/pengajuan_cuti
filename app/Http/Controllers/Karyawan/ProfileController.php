<?php

namespace App\Http\Controllers\Karyawan;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Arr;

class ProfileController extends CustomController
{
    public function index()
    {
        $user = User::with('karyawan')->find(auth()->id());

        if (request()->isMethod('POST')) {
            return $this->update($user);
        }

        return view('karyawan.profil', ['sidebar' => 'profil', 'data' => $user]);
    }

    public function update($user)
    {
        $user->update(
            [
                'username' => request('username'),
            ]
        );
        $user->karyawan()->update(
            [
                'nama'   => request('nama'),
                'nip'    => request('nip'),
                'no_hp'  => request('hp'),
                'alamat' => request('alamat'),
            ]
        );

        $image = \request('image');
        if ($image){
            $image     = $this->generateImageName('image');
            $stringImg = '/images/karyawan/'.$image;
            $this->uploadImage('image', $image, 'imageKaryawan');
            if ($user->karyawan->foto){
                if (file_exists('../public'.$user->karyawan->foto)) {
                    unlink('../public'.$user->karyawan->foto);
                }
            }

            $user->karyawan()->update(
                [
                    'foto'   => $stringImg,
                ]
            );
        }

        return redirect('/karyawan/profil');
    }

}

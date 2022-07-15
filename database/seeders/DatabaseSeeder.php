<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            [
                'username' => 'pimpinan',
                'role'     => 'pimpinan',
                'password' => Hash::make('pimpinan'),
            ]
        );

        $user->karyawan()->create(
            [
                'nama'      => 'Pimpinan',
                'nip'       => '123456',
                'no_hp'     => '012121',
                'sisa_cuti' => 100,
                'alamat'    => 'Solo',
                'foto'      => '',
            ]
        );

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\PengajuanCuti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BerandaController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $now        = date('Y-m-d');
        $karyawan   = $this->dataKaryawan();
        $jumlahCuti = $this->dataKaryawanCuti();
        $cuti       = PengajuanCuti::with('karyawan')->where('status', '=', 1)->where('tanggal_mulai', '<=', $now)->where('tanggal_selesai', '>=', $now)->paginate(10);

        return view('admin.beranda', ['sidebar' => 'beranda', 'data' => $cuti, 'karyawan' => $karyawan, 'jumlahCuti' => $jumlahCuti]);
    }

    /**
     * @return mixed
     */
    public function dataKaryawan()
    {
        $user = Karyawan::count('*');

        return $user;
    }

    /**
     * @return mixed
     */
    public function dataKaryawanCuti()
    {
        $now  = date('Y-m-d');
        $user = PengajuanCuti::where('tanggal_mulai', '<=', $now)->where('tanggal_selesai', '>=', $now)->count('*');

        return $user;
    }

}

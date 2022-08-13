<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\PengajuanCuti;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    //
    public function index()
    {
        if (\request()->isMethod('POST')) {
            return $this->create();
        }

        $cuti = PengajuanCuti::whereHas('karyawan', function ($q){
            return $q->where('user_id',auth()->id());
        })->paginate(10);

        return view('karyawan.pengajuancuti', ['sidebar' => 'cuti', 'data' => $cuti]);
    }

    public function create()
    {
        \request()->validate(
            [
                'keterangan' => 'required|string',
            ]
        );

        $start   = \request('start');
        $end     = \request('end');
        $date1   = date_create($start);
        $date2   = date_create($end);
        $diff    = date_diff($date1, $date2);
        $selisih = $diff->format("%R");
        $hari    = (int)$diff->format("%a") + 1;
        if ($selisih == '-'){
            return response()->json(['msg' => 'Tanggal selesai kurang dari tanggal mulai'], 201);
        }
        $cuti = new PengajuanCuti();
        $cuti->create([
            'karyawan_id' => auth()->id(),
            'tanggal_mulai' => $start,
            'tanggal_selesai' => $end,
            'total_hari' => $hari,
            'status' => 0,
            'keterangan' => \request('keterangan')
        ]);

        return 'berhasil';

    }


}

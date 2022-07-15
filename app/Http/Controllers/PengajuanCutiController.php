<?php

namespace App\Http\Controllers;

use App\Models\PengajuanCuti;
use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    //
    public function index(){
        $cuti = PengajuanCuti::with('karyawan')->orderBy('status','ASC')->paginate(10);
        return view('admin.pengajuancuti', ['sidebar' => 'cuti', 'data' => $cuti]);
    }

    public function detailCuti($id){
        if (\request()->isMethod('POST')){
            return $this->updatePengajuan($id);
        }
        $cuti = PengajuanCuti::with('karyawan.user')->find($id);
        return $cuti;
    }

    public function updatePengajuan($id){
        $status = \request('status');
        $cuti = PengajuanCuti::find($id);

        if ($status == 1){
            $sisa = (int)$cuti->karyawan->sisa_cuti;
            $total = (int)$cuti->total_hari;
            if ($sisa < $total){
                return response()->json(['msg' => "Sisa cuti tersedia $sisa"], 201);
            }
            $hasil = $sisa - $total;

            $cuti->karyawan()->update([
                'sisa_cuti' => $hasil
            ]);
        }

        $cuti->update([
            'status' => $status
        ]);

        return 'berhasil';
    }

}

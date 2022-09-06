<?php

namespace App\Http\Controllers;

use App\Models\PengajuanCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        }else{
            $cuti->update([
               'alasan' => \request('alasan')
            ]);

        }

        $cuti->update([
            'status' => $status
        ]);

        return 'berhasil';
    }

    public function cetakLaporan()
    {
//        return $this->dataTransaksi();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataTransaksi())->setPaper('f4', 'potrait');

        return $pdf->stream();
    }

    public function dataTransaksi()
    {
         $trans = PengajuanCuti::with(['karyawan.user'])->where('status',1)->get();
        // return view('admin/laporanpesanan',['data' => $trans]);
        return view('admin/laporancuti',['data' => $trans]);
    }


}

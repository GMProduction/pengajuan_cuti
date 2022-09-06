@extends('karyawan.base')

@section('content')
    <div class="row">
        <div class="col-12">


            <div class="panel">
                <div class="title">
                    <p>Pengajuan Cuti</p>
                    <a class="btn-utama-soft  rnd " data-bs-toggle="modal" data-bs-target="#modaltambahcuti">Buat Pengajuan Cuti <i
                            class="material-icons menu-icon ms-2">add_circle</i></a>
                </div>

                <div class="isi">
                    <div class="table">
                        <table id="table_id" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Awal</th>
                                <th>Tanggal Akhir</th>
                                <th>Jumlah Cuti (hari)</th>
                                <th>Status</th>
                                <th>Karyawan</th>
                            </tr>
                            </thead>
                            <tbody class="select">
                            @forelse($data as $key => $d)
                                <tr>
                                    <td>{{$data->firstItem() + $key}}</td>
                                    <td>{{date('d F Y', strtotime($d->tanggal_mulai))}}</td>
                                    <td>{{date('d F Y', strtotime($d->tanggal_selesai))}}</td>
                                    <td>{{$d->total_hari}}</td>
                                    <td>{{$d->status == 1 ? 'Disetujui' : ($d->status == 2 ? 'Ditolak' : 'Pending')}}</td>
                                    <td>{{$d->keterangan}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">Tidak ada data guru</td>
                                </tr>
                            @endforelse
                            </tbody>

                        </table>
                        <div class="d-flex justify-content-end">
                            {{$data->links()}}
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="modaltambahcuti" tabindex="-1" aria-labelledby="modaltambahcuti" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titlemodaltambahcuti">Ajukan Cuti</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form" onsubmit="return createCuti()">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="start" name="start" placeholder="mulaitanggal">
                            <label for="start" class="form-label">Mulai Tanggal</label>
                        </div>


                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="end" name="end" placeholder="sampaitanggal">
                            <label for="end" class="form-label">Sampai Tanggal</label>
                        </div>

                        <label for="keterangan" class="form-label">Jenis Cuti</label>
                        <select class="form-select" aria-label="Default select example" name="keterangan" id="keterangan">
                            <option selected>Pilih Cuti</option>
                            <option value="Cuti Tahunan">Cuti Tahunan</option>
                            <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                            <option value="Cuti Sakit">Cuti Sakit</option>
                            <option value="Cuti Besar">Cuti Besar</option>
                            <option value="Cuti Karena Alasan Penting">Cuti Karena Alasan Penting</option>
                        </select>
                    </div>
                    <div class=" m-3">

                        <div class="text-center">
                            <button type="submit" class="btn-utama">Simpan</button>
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalChangeQty" tabindex="-1" aria-labelledby="modalChangeQty" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titlemodalChangeQty">Ganti Jumlah yang disetujui</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="qty_diminta" name="qty_diminta"
                               placeholder="qty_diminta" disabled>
                        <label for="qty_diminta" class="form-label">Jumlah yang diminta</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="qty_diterima" name="qty_diterima"
                               placeholder="qty_diterima">
                        <label for="qty_diterima" class="form-label">Jumlah yang disetujui</label>
                    </div>


                </div>

                <div class=" m-3">

                    <div class="text-center">
                        <a class="btn-utama">Simpan</a>
                    </div>


                </div>

            </div>
        </div>
    </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('js/number_formater.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#table_id').DataTable({
                select: {
                    style: 'single'
                }
            });

            $('#table_detail').DataTable();
        });

        function createCuti() {
            saveData('Ajukan Cuti', 'form', window.location.pathname)
            return false;
        }

        function afterSave() {

        }

    </script>
@endsection



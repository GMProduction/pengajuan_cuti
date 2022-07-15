@extends('karyawan.base')

@section('content')
    <div>

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
                                        {{-- <th>Nama Karyawan</th> --}}
                                        <th>Tanggal Awal</th>
                                        {{-- <th>Catatan</th> --}}
                                        <th>Tanggal Akhir</th>
                                        <th>Status</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="select">
                                    <tr>
                                        <td>1</td>
                                        {{-- <td>Karyawan Anak Pak Joko</td> --}}
                                        <td>12 Juni 2022</td>
                                        {{-- <td>Pesan banyak</td> --}}
                                        <td>14 Juni 2022</td>
                                        <td>Pending</td>
                                        {{-- <td class="d-flex ">
                                            <a class="btn-utama sml rnd me-1 d-flex justify-content-center"
                                                data-bs-toggle="modal" data-bs-target="#detailTransaksi">Detail <i
                                                    class="material-icons menu-icon ms-2">info</i></a>


                                        </td> --}}
                                    </tr>

                                </tbody>

                            </table>
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
                    <div class="modal-body">



                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="mulaitanggal" name="Mulai Tanggal" placeholder="mulaitanggal">
                            <label for="mulaitanggal" class="form-label">Mulai Tanggal</label>
                        </div>


                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="sampaitanggal" name="Sampai Tanggal" placeholder="sampaitanggal">
                            <label for="sampaitanggal" class="form-label">Sampai Tanggal</label>
                        </div>


                        <div class="form-floating mb-3">
                            <textarea type="text" class="form-control" id="keterangan" name="keterangan"  rows="5"
                                placeholder="Jhony"></textarea>
                            <label for="keterangan" class="form-label">Keterangan</label>
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
        $(document).ready(function() {
            $('#table_id').DataTable({
                select: {
                    style: 'single'
                }
            });

            $('#table_detail').DataTable();
        });
    </script>
@endsection


</body>

</html>

@extends('admin.base')

@section('content')
    <div>

        <div class="row">
            <div class="col-8">


                <div class="panel">
                    <div class="title">
                        <p>Pengajuan Cuti</p>
                        {{-- <a class="btn-utama-soft  rnd ">Pesanan Baru <i
                                class="material-icons menu-icon ms-2">add_circle</i></a> --}}
                    </div>

                    <div class="isi">
                        <div class="table">
                            <table id="table_id" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Karyawan</th>
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
                                        <td>Karyawan Anak Pak Joko</td>
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

            <div class="col-4">

                <div class="panel">

                    {{-- <div class="title">
                        <p>Detail</p>
                        <a class="btn-accent  rnd ">Cetak <i
                            class="material-icons menu-icon ms-2">print</i></a>

                    </div> --}}

                    <div class="isi">
                        <div class="row">

                            <div class="col-8">
                                <p class="fw-bold">Data Karyawan</p>
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="dk_namakaryawan" disabled
                                        name="dk_namakaryawan" placeholder="Karyawan">
                                    <label for="dk_namakaryawan" class="form-label">Nama Karyawan</label>
                                </div>

                                <div class="form-floating mb-1">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="dk_alamat" disabled style="height: 100px"></textarea>
                                    <label for="dk_alamat">Alamat</label>
                                </div>

                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="dk_username" name="dk_username" disabled
                                        placeholder="Karyawan">
                                    <label for="dk_username" class="form-label">Username</label>
                                </div>

                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="dk_nohpkaryawan" name="dk_nohpkaryawan"
                                        disabled placeholder="no_hp">
                                    <label for="dk_nohpkaryawan" class="form-label">No Hp</label>
                                </div>

                                <div class="form-floating mb-5">
                                    <input type="text" class="form-control" id="dk_sisacuti" name="dk_sisacuti" disabled
                                        placeholder="no_hp">
                                    <label for="dk_sisacuti" class="form-label">Sisa Cuti</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <img style="width: 100%" src="{{ asset('images/local/karyawan.png') }}" />
                            </div>
                            <div class="col-12">
                                <p class="fw-bold">Pengajuan Cuti</p>

                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="dk_totalhari" disabled
                                        name="dk_totalhari" placeholder="Karyawan">
                                    <label for="dk_totalhari" class="form-label">Total Hari Cuti</label>
                                </div>

                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="dk_daritanggal" disabled
                                        name="dk_daritanggal" placeholder="Karyawan">
                                    <label for="dk_daritanggal" class="form-label">Dari Tanggal</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="dk_sampaitanggal" disabled
                                        name="dk_sampaitanggal" placeholder="Karyawan">
                                    <label for="dk_sampaitanggal" class="form-label">Sampai Tanggal</label>
                                </div>

                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="dk_keterangan" disabled
                                        name="dk_keterangan" placeholder="Karyawan">
                                    <label for="dk_keterangan" class="form-label">Keterangan</label>
                                </div>


                                <div class="d-flex">
                                    <a class="btn-utama me-2">Terima</a>
                                    <a class="btn-danger ">Tolak</a>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>


            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="detailTransaksi" tabindex="-1" aria-labelledby="detailTransaksi" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleDetailTransaksi">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <label for="role" class="form-label">Role</label>
                        <select class="form-select mb-3" aria-label="Default select example" id="role"
                            name="role">
                            <option selected>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="pimpinan">Pimpinan</option>
                        </select>


                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nama" name="username"
                                placeholder="Jhony">
                            <label for="nama" class="form-label">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control " id="password" name="password"
                                placeholder="Jhony">
                            <label for="password" class="form-label">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control " id="password_confirmation"
                                name="password_confirmation" placeholder="Jhony">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
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

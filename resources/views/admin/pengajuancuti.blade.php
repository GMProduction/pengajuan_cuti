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
                                    <th>Tanggal Akhir</th>
                                    <th>Jumlah Cuti (hari)</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody class="select">
                                @forelse($data as $key => $d)
                                    <tr id="editTable" data-id="{{$d->id}}">
                                        <td>{{$data->firstItem() + $key}}</td>
                                        <td>{{$d->karyawan->nama}}</td>
                                        <td>{{date('d F Y', strtotime($d->tanggal_mulai))}}</td>
                                        <td>{{date('d F Y', strtotime($d->tanggal_selesai))}}</td>
                                        <td>{{$d->total_hari}}</td>
                                        <td>{{$d->status == 1 ? 'Disetujui' : ($d->status == 2 ? 'Ditolak' : 'Pending')}}</td>
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
                                <img id="imgAvatar" style="width: 100%" src="{{ asset('images/local/karyawan.png') }}"/>
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


                                <div id="btnUpdate" class="d-none">
                                    <div class="d-flex">
                                        <a class="btn-utama me-2" onclick="updateCuti(1)">Terima</a>
                                        <a class="btn-danger " onclick="updateCuti(2)">Tolak</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>

        <!-- Modal -->


        @endsection

        @section('morejs')
            <script src="{{ asset('js/number_formater.js') }}"></script>

            <script>
                let idCuti, namaUser;
                $(document).ready(function () {

                });

                $(document).on('click', '#editTable', function () {
                    idCuti = $(this).data('id');
                    $.get(window.location.pathname + '/' + idCuti, function (res, xhr, code) {
                        console.log(res);
                        if (code.status === 200) {
                            namaUser = res.karyawan.nama;
                            $('#dk_namakaryawan').val(res.karyawan.nama);
                            $('#dk_alamat').val(res.karyawan.alamat);
                            $('#dk_username').val(res.karyawan.user.username);
                            $('#dk_nohpkaryawan').val(res.karyawan.no_hp);
                            $('#dk_sisacuti').val(res.karyawan.sisa_cuti);
                            $('#dk_totalhari').val(res.total_hari);
                            $('#dk_daritanggal').val(res.tanggal_mulai);
                            $('#dk_sampaitanggal').val(res.tanggal_selesai);
                            $('#dk_keterangan').val(res.keterangan);
                            $('#imgAvatar').attr('src',res.karyawan.foto);
                            $('#btnUpdate').removeClass('d-none')
                        }
                    })
                });

                function clear() {
                    $('#dk_namakaryawan').val('');
                    $('#dk_alamat').val('');
                    $('#dk_username').val('');
                    $('#dk_nohpkaryawan').val('');
                    $('#dk_sisacuti').val('');
                    $('#dk_totalhari').val('');
                    $('#dk_daritanggal').val('');
                    $('#dk_sampaitanggal').val('');
                    $('#dk_keterangan').val('');
                    $('#btnUpdate').addClass('d-none')
                }

                function updateCuti(status) {
                    let data = {
                        "_token": '{{csrf_token()}}',
                        "status": status
                    }
                    let text = 'menerima'
                    if (status == 2) {
                        text = 'menolak'
                    }
                    saveDataObjectFormData('Apakah anda yakin akan ' + text + ' pengajuan cuti karyawan ' + namaUser, data, window.location.pathname + '/' + idCuti)
                    return false;
                }

                function afterSave() {

                }
            </script>
            @endsection


            </body>

            </html>

@extends('karyawan.base')

@section('content')
    <div>

        <div class="row">


            <div class="col-12">

                <div class="panel">

                    {{-- <div class="title">
                        <p>Detail</p>
                        <a class="btn-accent  rnd ">Cetak <i
                            class="material-icons menu-icon ms-2">print</i></a>

                    </div> --}}

                    <div class="isi">
                        <form method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-8">
                                    <p class="fw-bold">Data Karyawan</p>
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" id="dk_namakaryawan"
                                               value="{{ $data->karyawan->nama }}" name="nama" placeholder="Karyawan">
                                        <label for="dk_namakaryawan" class="form-label">Nama Karyawan</label>
                                    </div>

                                    <div class="form-floating mb-1">
                                        <textarea class="form-control" placeholder="Leave a comment here" name="alamat" id="dk_alamat" style="height: 100px">{{ $data->karyawan->alamat }}</textarea>
                                        <label for="dk_alamat">Alamat</label>
                                    </div>
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" id="nip" name="nip"
                                               value="{{ $data->karyawan->nip }}" placeholder="nip">
                                        <label for="dk_nohpkaryawan" class="form-label">NIP</label>
                                    </div>
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" id="dk_username" name="username"
                                               value="{{ $data->username }}" placeholder="Karyawan">
                                        <label for="dk_username" class="form-label">Username</label>
                                    </div>

                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" id="dk_nohpkaryawan" name="hp"
                                               value="{{ $data->karyawan->no_hp }}" placeholder="no_hp">
                                        <label for="dk_nohpkaryawan" class="form-label">No Hp</label>
                                    </div>

                                    <div class="form-floating mb-5">
                                        <input type="text" class="form-control" id="dk_sisacuti" readonly
                                               value="{{ $data->karyawan->sisa_cuti }}" placeholder="no_hp">
                                        <label for="dk_sisacuti" class="form-label">Sisa Cuti</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img id="imgAvatar" style="width: 100%" src="{{ asset($data->karyawan->foto) }}" class="mb-3"/>
                                    <input type="file" accept="image/jpeg" name="image"/>
                                </div>

                                <div style="width: 200px">
                                    <button type="submit" class="btn btn-success">Edit</button>

                                </div>
                            </div>
                        </form>

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
                            $('#imgAvatar').attr('src', res.karyawan.foto);
                            if (res.status == 0) {
                                $('#btnUpdate').removeClass('d-none')
                            }
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
                        "_token": '{{ csrf_token() }}',
                        "status": status
                    }
                    let text = 'menerima'
                    if (status == 2) {
                        text = 'menolak'
                    }
                    saveDataObjectFormData('Apakah anda yakin akan ' + text + ' pengajuan cuti karyawan ' + namaUser, data, window
                        .location.pathname + '/' + idCuti)
                    return false;
                }

                function afterSave() {

                }
            </script>
            @endsection


            </body>

            </html>

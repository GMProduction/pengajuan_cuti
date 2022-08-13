@extends('admin.base')

@section('content')


    <div class="panel">
        <div class="title">
            <p>Data Karyawan</p>
            <div class="d-flex gap-2">
                <a class="btn-utama-soft  rnd " id="reseteCuti">Resete Cuti <i
                        class="material-icons menu-icon ms-2">refresh</i></a>
                <a class="btn-utama-soft  rnd " id="addData">Karyawan Baru <i
                        class="material-icons menu-icon ms-2">add_circle</i></a>
            </div>
        </div>

        <div class="isi">
            <div class="table">
                <table id="table_piutang" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>NIP</th>
                        <th>Nama Karyawan</th>
                        <th>Role</th>
                        <th>Foto</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>Username</th>
                        <th>Sisa Cuti</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $key => $d)
                        <tr>
                            <td>{{$data->firstItem() + $key}}</td>
                            <td>{{$d->karyawan ? $d->karyawan->nip : '-'}}</td>
                            <td>{{$d->karyawan ? $d->karyawan->nama : '-'}}</td>
                            <td>{{$d->role}}</td>
                            <td><img class="" src="{{$d->karyawan ? $d->karyawan->foto : ''}}" data-img="{{$d->karyawan ? $d->karyawan->foto : ''}}" id="showImg" role="button"/></td>
                            <td>{{$d->karyawan ? $d->karyawan->alamat : '-'}}</td>
                            <td>{{$d->karyawan ? $d->karyawan->no_hp : '-'}}</td>
                            <td>{{$d->username}}</td>
                            <td>{{$d->karyawan ? $d->karyawan->sisa_cuti : '-'}}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn-success sml rnd me-1" data-row='{{$d}}' id="editData">Edit <i
                                            class="material-icons menu-icon ms-2">edit</i></a>
                                    <a class="btn-danger sml rnd " id="deleteData" data-id="{{$d->id}}">Hapus <i
                                            class="material-icons menu-icon ms-2">delete</i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="9">Tidak ada data guru</td>
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

    <!-- Modal -->
    <div class="modal fade" id="modaltambahuser" tabindex="-1" aria-labelledby="modaltambahuser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltambahuser">Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form" onsubmit="return createKaryawan()">
                    @csrf
                    <input hidden id="id" name="id">
                    <div class="modal-body">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Jhony">
                            <label for="nama" class="form-label">Nama Karyawan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nip" name="nip" placeholder="121515">
                            <label for="nama" class="form-label">NIP</label>
                        </div>
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select mb-3" aria-label="Default select example" id="role" name="role">
                            <option selected value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="pimpinan">Pimpinan</option>
                            <option value="karyawan">Karyawan</option>
                        </select>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control " id="no_hp" name="no_hp"
                                   placeholder="08712345678">
                            <label for="no_hp" class="form-label">No. Hp</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="alamat" class="form-control" id="alamat" name="alamat" placeholder="alamat">
                            <label for="alamat">Alamat</label>
                        </div>

                        <div class="mb-3">
                            <label for="fotobarang" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="foto" name="foto">
                        </div>

                        <hr>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Jhony">
                            <label for="username" class="form-label">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control " id="password" name="password" placeholder="Jhony">
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
                            <button type="submit" class="btn-utama">Simpan</button>
                        </div>


                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalImg" tabindex="-1" aria-labelledby="modaltambahuser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="imgFoto">

            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('js/number_formater.js') }}"></script>

    <script>
        $(document).ready(function () {
            // $('#table_piutang').dataTable();
        });

        $(document).on('click', '#editData, #addData', function () {
            console.log('asdad', $(this).data('row'))
            let data = $(this).data('row');
            $('form #nama').val(data?.karyawan?.nama);
            $('form #role').val(data?.role);
            $('form #id').val(data?.id);
            $('form #no_hp').val(data?.karyawan?.no_hp);
            $('form #nip').val(data?.karyawan?.nip);
            $('form #alamat').val(data?.karyawan?.alamat);
            $('form #username').val(data?.username);
            $('form #password').val(data ? '*******' : '');
            $('form #password_confirmation').val(data ? '*******' : '');
            $('#modaltambahuser').modal('show')
        })

        function createKaryawan() {
            saveData('Tambah karyawan', 'form', window.location.pathname);
            return false;
        }

        function afterSave() {
            $('#modaltambahuser').modal('hide')
        }

        $(document).on('click', '#deleteData', function () {
            console.log('asdasd', $(this).data('id'))
            let data = {
                '_token': '{{csrf_token()}}'
            }
            deleteData('delete', window.location.pathname + '/delete/' + $(this).data('id'), data);

        })

        $(document).on('click', '#showImg', function () {
            console.log()
            let img = $(this).data('img');
            $('#imgFoto').html('<img src="' + img + '"/>')
            $('#modalImg').modal('show')

        })

        $(document).on('click', '#reseteCuti', function () {
            let data = {
              '_token' : '{{csrf_token()}}'
            };
            saveDataObjectFormData('Resete Cuti Semua Karyawan',data, window.location.pathname+'/resete-cuti', afterResete)
            return false;
        })

       function afterResete(){

        }
    </script>
    @endsection


    </body>

    </html>

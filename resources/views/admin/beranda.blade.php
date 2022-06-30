@extends('admin.base')

@section('content')
    <div>

        <div class="row">
            <div class="col-12">
                <div class="panel">
                    <div class="title">
                        <p>Portfolio Peformance</p>
                    </div>

                    <div class="isi">
                        <div class="row">
                            <div class="col-6">
                                <div class="panel-peformace">
                                    <img src="{{ asset('images/local/karyawan.png') }}" />
                                    <div class="content">
                                        <p class="nama">Data Karyawan</p>
                                        <p class="nilai">250</p>
                                        {{-- <p class="status">75% naik</p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="panel-peformace">
                                    <img src="{{ asset('images/local/cuti.png') }}" />
                                    <div class="content">
                                        <p class="nama">Karyawan Sedang Cuti</p>
                                        <p class="nilai">5</p>
                                        {{-- <p class="status">75% naik</p> --}}
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-4">
                                <div class="panel-peformace">
                                    <img src="{{ asset('images/local/contoh-logo-bunder.png') }}" />
                                    <div class="content">
                                        <p class="nama">Pendapatan</p>
                                        <p class="nilai">7.5M</p> --}}
                            {{-- <p class="status">75% naik</p> --}}
                            {{-- </div>
                                </div>
                            </div> --}}
                        </div>

                    </div>

                </div>

                <div class="panel">
                    <div class="title">
                        <p>Karyawan sedang cuti</p>
                        {{-- <a class="btn-utama-soft  rnd ">Pesanan Baru <i
                                class="material-icons menu-icon ms-2">add_circle</i></a> --}}
                    </div>

                    <div class="isi">
                        <div class="table">
                            <table id="table_id" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>Nama Karyawan</th>
                                        <th>Cuti Awal</th>
                                        <th>Cuti Akhir</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>10145678</td>
                                        <td>Bagus</td>
                                        <td>12 April 2022</td>
                                        <td>12 Juni 2022</td>
                                        {{-- <td class="d-flex">
                                            <a class="btn-success sml rnd me-1">Edit <i
                                                    class="material-icons menu-icon ms-2">edit</i></a>

                                            <a class="btn-danger sml rnd ">Hapus <i
                                                    class="material-icons menu-icon ms-2">delete</i></a>
                                        </td> --}}
                                    </tr>

                                </tbody>

                            </table>
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
            $('#table_id').DataTable();
            $('#table_piutang').DataTable();
        });
    </script>
@endsection


</body>

</html>

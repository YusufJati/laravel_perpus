@php
    use Carbon\Carbon;
@endphp

@extends('layouts.mainlayout')

@section('title', 'Riwayat')

@section('page-name', 'Riwayat')

@section('content')
<div class="container">
    <h2 class="text-center">Riwayat Peminjaman Buku</h2>
    <div class="card mt-5">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab" aria-controls="selesai" aria-selected="true">Peminjaman Selesai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="berlangsung-tab" data-toggle="tab" href="#berlangsung" role="tab" aria-controls="berlangsung" aria-selected="false">Peminjaman Berlangsung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="terlambat-tab" data-toggle="tab" href="#terlambat" role="tab" aria-controls="terlambat" aria-selected="false">Peminjaman Terlambat</a>
                </li>                
            </ul>

            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                    <!--peminjaman yang sudah selesai-->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Tanggal Pengembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $item->judul}}</td>
                                        <td>{{ $item->tgl_pinjam }}</td>
                                        <td>{{ $item->tgl_kembali }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="berlangsung" role="tabpanel" aria-labelledby="berlangsung-tab">
                    <!--peminjaman yang sedang berlangsung-->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Tanggal Jatuh Tempo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman as $item)
                                    <tr>
                                        <td>{{ $item->judul}}</td>
                                        <td>{{ $item->tgl_pinjam }}</td>
                                        <td>@php
                                            $jatuhtempo = new Carbon($item->tgl_pinjam);
                                            $tempo = $jatuhtempo->addDays(14);
                                            $jatuh = $tempo->format('Y-m-d');
                                            echo $jatuh;
                                        @endphp</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="terlambat" role="tabpanel" aria-labelledby="terlambat-tab">
                    <!--peminjaman yang terlambat-->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Tanggal Jatuh Tempo</th>
                                    <th scope="col">Tanggal Kembali</th>
                                    <th scope="col">Durasi Terlambat</th>
                                    <th scope="col">Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($terlambat as $item)
                                    <tr>
                                        <td>{{ $item->judul}}</td>
                                        <td>{{ $item->tgl_pinjam }}</td>
                                        <td>@php
                                            $jatuhtempo = new Carbon($item->tgl_pinjam);
                                            $tempo = $jatuhtempo->addDays(14);
                                            $jatuh = $tempo->format('Y-m-d');
                                            echo $jatuh;
                                        @endphp</td>
                                        <td>{{ $item->tgl_kembali }}</td>
                                        <td>
                                            @php
                                               $tanggalkembali = Carbon::parse($item->tgl_kembali);
                                               $tanggaltenggat = Carbon::parse($jatuh);

                                               $durasiterlambat = $tanggalkembali->diffInDays($tanggaltenggat);
                                               echo $durasiterlambat. " hari"
                                            @endphp
                                        </td>
                                        <td>
                                            {{ $item->denda }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#myTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    })
</script>
@endsection
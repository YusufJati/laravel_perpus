@extends('layouts.mainlayout')

@section('title', 'Book List')

@section('page-name', 'book list')

@section('content')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kategori-dropdown').change(function() {
            var selectedKategori = $(this).val();
            filterBuku(selectedKategori);
        });

        function filterBuku(kategoriId) {
            $.ajax({
                url: '/',
                type: 'GET',
                data: { kategori: kategoriId },
                success: function(response) {
                    window.location.replace('/?kategori='+kategoriId);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });
</script>
<div class="col-12 col-sm-6 mb-3">
    <select name="kategori" id="kategori-dropdown" class="form-control form-select" style="width: 15rem">
        <option value="">Select Category</option>
        @foreach ($kategori as $item)
            <option value="{{ $item->idkategori }}">{{ $item->nama }}</option>
        @endforeach
    </select>
</div>

    <div class="my-2">
        <div class="d-flex flex-wrap">

            @foreach ($buku as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card " style="width: 15rem; height: 100%">
                        <img src="{{ asset('storage/file_gambar/' .$item->file_gambar) }}" class="card-img-top mx-auto" alt="Gambar Buku" style="height: 12rem; width: 10rem; display: block; margin: 0 auto;">
                        <div class="card-body d-flex flex-column justify-content-around" style="overflow: hidden;">
                            <h4 class="card-title fw-bold">{{ $item->judul }}</h4>
                            <p class="card-text">{{ $item->pengarang}}</p>
                            <p class="card-text">{{ $item->penerbit}}</p>
                            <a href="/detail/{{$item->idbuku}}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

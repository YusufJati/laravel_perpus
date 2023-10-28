@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')
    <!-- <h5 class="fw-normal"><a href="/" class="text-decoration-none text-dark">Dashboard</a></h5> -->
    <div class="d-flex">
        <p class="ms-auto">
            <a href="/" class="text-decoration-none">Dashboard</a>
            <a href="/detail" class="text-decoration-none text-muted"> / Detail Buku</a>
        </p>
    </div>

    {{-- isi content --}}
    <div class="container p-0">
        <div class="row">
            <div class="detail col-md-8">
                <!-- <h5 class="fw-normal">Detail Buku</h5> -->
                <div class="card mb-3" style="max-width: 100%; height: 360px;">
                    <div class="row g-0">
                        <div class="images col-md-4"> <!-- Kolom gambar diperbesar -->
                            <img src="{{ asset('storage/file_gambar/' .$buku->file_gambar) }}" class="img-fluid rounded-start" alt="..." style="height: 22.5rem; width: 15rem; margin: 5 auto;">
                        </div>
                        <div class="detail-book col-md-8"> <!-- Kolom detail buku -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $buku->judul }}</h5>
                                <p class="card-text"> {{ $buku->getRatingBuku->skor_rating ?? '-' }} <span class="starContainer"></span></p>
                                <li class="list-group-item">
                                    <table>
                                        <tr>
                                            <td>Stok</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $buku->stok_tersedia }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pengarang</td>
                                            <td>&nbsp;: </td>
                                            <td>{{ $buku->pengarang }}</td>
                                        </tr>
                                        <tr>
                                            <td>Penerbit</td>
                                            <td>&nbsp;:</td>
                                            <td>{{ $buku->penerbit }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td>&nbsp;:</td>
                                            <td>{{ $buku->getKategoriBuku->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>ISBN</td>
                                            <td>&nbsp;:</td>
                                            <td>{{ $buku->isbn }}</td>
                                        </tr>
                                        <tr>
                                            <td>Editor</td>
                                            <td>&nbsp;:</td>
                                            <td>{{ $buku->editor }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kota Terbit</td>
                                            <td>&nbsp;:</td>
                                            <td>{{ $buku->kota_terbit }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tahun</td>
                                            <td>&nbsp;:</td>
                                            <td>{{ $buku->tahun }}</td>
                                        </tr>
                                    </table>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="review-form col-md-4">
                <h5 class="fw-normal">Tambah Komentar</h5>
                <div class="content shadow p-3 mb-5 bg-light-subtle rounded">
                    @if (Auth::check())
                        <form action="{{ route('komentar.store') }}" method="POST">
                            @csrf
                            <!-- <div class="form-group">
                                <label for="noktp">noktp</label>
                                <input type="text" class="form-control" id="noktp" name="noktp" required>
                            </div> -->
                            <div class="form-group">
                                <label for="komentar">Komentar</label>
                                <textarea class="form-control" id="komentar" name="komentar" rows="3" required></textarea>
                            </div>
                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                        </form>
                    @else
                    <a href="{{route('login')}}" class="btn btn-warning">Silahkan Login</a>
                    @endif
                </div>
            </div>

            <div class="review col-md-8">
                <h5 class="fw-normal">Review Buku</h5>
                <div class="content shadow p-3 mb-5 bg-light-subtle rounded">
                    <div class="komen">
                        @foreach ($buku->getkomentarBuku as $komentar)
                        <li class="list-group-item">
                            <table>
                                <tr>
                                    <td><small>{{ $komentar->getAnggotaKomentar->nama }}</small></td>
                                </tr>
                                <tr>
                                    <td><small>{{ $komentar->komentar }}</small></td>
                                </tr>
                            </table>
                        </li>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            function generateStars(rating, container) {
                container.innerHTML = '';
        
                const maxRating = 10;
                const numFullStars = Math.floor(rating / 2);
                const hasHalfStar = rating % 2 !== 0;
                const numEmptyStars = maxRating / 2 - numFullStars - (hasHalfStar ? 1 : 0);
        
                for (let i = 0; i < numFullStars; i++) {
                    const starIcon = document.createElement('i');
                    starIcon.className = 'bi bi-star-fill';
                    container.appendChild(starIcon);
                }
        
                if (hasHalfStar) {
                    const halfStarIcon = document.createElement('i');
                    halfStarIcon.className = 'bi bi-star-half';
                    container.appendChild(halfStarIcon);
                }
        
                for (let i = 0; i < numEmptyStars; i++) {
                    const emptyStarIcon = document.createElement('i');
                    emptyStarIcon.className = 'bi bi-star';
                    container.appendChild(emptyStarIcon);
                }
            }

            const ratingContainer = document.querySelector('.starContainer');
            generateStars({{ $buku->getRatingBuku->skor_rating ?? 0 }}, ratingContainer);
        </script>

@endsection

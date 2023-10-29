@extends('layouts.mainlayout')

@section('title', 'Detail Buku')

@section('content')
    <div class="container">
        <div class="d-flex">
            <p class="ms-auto">
                <a href="/" class="text-decoration-none">Dashboard</a>
                <a href="/detail" class="text-decoration-none text-muted"> / Detail Buku</a>
            </p>
        </div>

        <div class="row">
            <div class="detail col-md-8">
                <div class="card mb-3" style="max-width: 100%; height: 360px;">
                    <div class="row g-0">
                        <div class="images col-md-4">
                            <img src="{{ asset('storage/file_gambar/' . $buku->file_gambar) }}" class="img-fluid rounded-start" alt="..." style="height: 22.5rem; width: 15rem; margin: 5 auto;">
                        </div>
                        <div class="detail-book col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $buku->judul }}</h5>
                                <p class="card-text">
                                    @if ($buku->getRatingBuku)
                                        <div class="starContainer"></div>
                                        @php
                                        $averageRating = $buku->averageRating();
                                        @endphp
                                        <span class="fw-bold">{{ number_format($averageRating, 1) }}</span>
                                    @else
                                        @php
                                        $averageRating = 0;
                                        @endphp
                                        Belum ada peringkat.
                                    @endif
                                    
                                </p>
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

            <div class="col-md-4 d-flex flex-column align-items-center">
                @if (Auth::check())
                <h5 class="fw-normal">Tambah Rating</h5>
                <div class="shadow d-flex w-100 p-3 mb-5 bg-light-subtle justify-center rounded">
                @if (Auth::check()) {{-- Memeriksa apakah pengguna telah login --}}
                    @php
                    $userRating = \App\Models\Rating_buku::where('noktp', Auth::user()->noktp)
                        ->where('idbuku', $buku->idbuku)
                        ->first();
                    @endphp
                    @if ($userRating)
                        <p class="fw-bold">Rating anda: {{ $userRating->skor_rating }}</p>
                    @else
                        <form action="{{ route('rating.store', ['idbuku' => $buku->idbuku]) }}" method="POST">
                            @csrf
                            <div class="mb-2 flex-row-reverse d-flex gap-2 flex-wrap-reverse">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input class="star-input" value="{{ 6 - $i }}" id="star-{{ $i }}" type="radio" name="rating"/>
                                    <label class="star-label" for="star-{{ $i }}"></label>
                                @endfor
                            </div>
                            <input type="hidden" name="idbuku" value="{{ $buku->idbuku }}">
                            <button type="submit" class="btn btn-primary mt-3">Submit Rating</button>
                        </form>
                    @endif
                @endif

                </div>

                <h5 class="fw-normal">Tambah Komentar</h5>
                <div class="content shadow p-3 mb-5 bg-light-subtle rounded w-100">
                    <form action="{{ route('komentar.store', ['idbuku' => $buku->idbuku]) }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="komentar">Komentar</label>
                            <textarea class="form-control" id="komentar" name="komentar" rows="2" required></textarea>
                        </div>
                        <input type="hidden" name="idbuku" value="{{ $buku->idbuku }}">
                        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                    </form>
                </div>
                @else
                    <div class="col-md-4 content shadow p-3 mb-5 bg-light-subtle rounded w-100">
                        <p>Sebelum Menilai dan Berkomentar, Anda harus login terlebih dahulu.</p>
                        <a href="{{ route('login') }}" class="btn btn-warning">Login di sini</a>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
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
    </div>

    <script>
        function generateStars(rating, container) {
            container.innerHTML = '';
            const maxRating = 5;
            const numFullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 !== 0;

            for (let i = 0; i < numFullStars; i++) {
                const starIcon = document.createElement('i');
                starIcon.className = 'bi bi-star-fill';
                starIcon.style.color = '#ffcc00';
                container.appendChild(starIcon);
            }

            if (hasHalfStar) {
                const halfStarIcon = document.createElement('i');
                halfStarIcon.className = 'bi bi-star-half';
                halfStarIcon.style.color = '#ffcc00';
                container.appendChild(halfStarIcon);
            }

            const numEmptyStars = maxRating - numFullStars - (hasHalfStar ? 1 : 0);
            for (let i = 0; i < numEmptyStars; i++) {
                const emptyStarIcon = document.createElement('i');
                emptyStarIcon.className = 'bi bi-star';
                emptyStarIcon.style.color = '#ffcc00';
                container.appendChild(emptyStarIcon);
            }
        }

        const ratingContainer = document.querySelector('.starContainer');
        const averageRating = {{ $averageRating }};
        generateStars(averageRating, ratingContainer);

    </script>
@endsection

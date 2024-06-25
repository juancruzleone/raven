<?php
/** @var \App\Models\Movie $movie */
?>
<div class="row mb-3">
    <div class="col-8">
        <dl>
            <dt>Fecha de Estreno</dt>
            <dd>{{ $movie->release_date }}</dd>
            <dt>Precio</dt>
            <dd>$ {{ $movie->price }}</dd>
            <dt>Clasificación</dt>
            <dd>{{ $movie->rating->name }} ({{ $movie->rating->abbreviation }})</dd>
            <dt>Géneros</dt>
            <dd>
                @forelse($movie->genres as $genre)
                    <span class="badge bg-secondary">{{ $genre->name }}</span>
                @empty
                    <i>Sin especificar</i>
                @endforelse
            </dd>
        </dl>
    </div>
    <div class="col-4">
        @if($movie->cover !== null)
            <img src="{{ asset('storage/' . $movie->cover) }}" alt="{{ $movie->cover_description }}" class="img-fluid">
        @else
            Acá iría una imagen de "no hay una imagen"
        @endif
    </div>
</div>

<h2>Sinopsis</h2>

<div>{{ $movie->synopsis }}</div>

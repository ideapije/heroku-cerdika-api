@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <small>Kepatuhan</small>
                    <h1 class="display-4">{{ $result ?? 'RENDAH' }}</h1>
                    <p class="lead">{{ $params['g'] === 'logbook' ? 'Logbook Kegiatan' : 'Kepatuhan minum obat' }} disubmit pada</p>
                    <p>{{ $dateSubmitted }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <ul class="list-group mb-3">
                @foreach ($submissions as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $item->question->text }}
                    @php
                        $color = 'warning';
                        if ($item->choice->id === 1) {
                            $color = 'primary';
                        }
                        if ($item->choice->id === 2) {
                            $color = 'danger';
                        }
                    @endphp
                    <span class="badge badge-{{ $color }} badge-pill">
                        {{ $item->choice->text }}
                    </span>
                </li>
                @endforeach
            </ul>
            <a href="{{ route('cerdika.logbook.index', $member) }}" class="btn btn-primary btn-lg btn-block">
                Lihat Kalender
            </a>
        </div>
    </div>
</div>
@endsection
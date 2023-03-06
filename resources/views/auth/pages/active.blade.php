@php
    use App\Helpers\Obn;
@endphp
@extends('auth.auth')
@section('content')
    <div class="panel panel-body active-form text-center">
        <img src="{{ Obn::get_logo() }}" alt="" class="img-responsive active-logo">
        <p><strong>{!!$msg!!}</strong></p>
    </div>
@endsection

@extends('layouts.frontend.app')

@section('content')
    @include('partials.frontend.reservations.form', ['step' => 1])
@endsection

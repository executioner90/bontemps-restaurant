@extends('layouts.frontend.app')

@section('content')
    <x-frontend.meals :meals="$meals"></x-frontend.meals>
@endsection

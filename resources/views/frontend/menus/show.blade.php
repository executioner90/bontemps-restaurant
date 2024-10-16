@extends('layouts.frontend.app')

@section('content')
    <meal-list :menu-id="{{ $menu->id }}" menu-name="{{ $menu->name  }}"></meal-list>
@endsection

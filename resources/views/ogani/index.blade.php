@extends('layouts.ogani-layout.app')
@section('title', 'Home')
@push('css')
    <style>
        .center {
            text-align: center;
        }
    </style>
@endpush

@section('content')
    @include('layouts.ogani-layout.partials.homeHero')
    @include('layouts.ogani-layout.partials.categoryImages')
    @include('layouts.ogani-layout.partials.latestProduct')
@endsection()

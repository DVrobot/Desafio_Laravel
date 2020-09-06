@extends('admin.layouts.app')
@section('content')
    @component('admin.components.create')
        @slot('title', 'Criar uma categoria')
        @slot('url', route('categories.store'))
        @slot('form')
            @include('admin.categories.form')
        @endslot
    @endcomponent
@endsection

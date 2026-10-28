@extends('layouts.app')
@section('content')
    <h3>Add Category</h3>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        @include('categories._form')
    </form>
@endsection
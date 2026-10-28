@extends('layouts.app')
@section('content')
    <h3>Edit Category</h3>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf @method('PUT')
        @include('categories._form')
    </form>
@endsection
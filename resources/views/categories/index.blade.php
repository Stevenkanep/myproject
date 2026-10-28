@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h3>Categories</h3>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th width="180">Actions</th>
        </tr>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this category?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No categories yet.</td>
            </tr>
        @endforelse
    </table>
@endsection
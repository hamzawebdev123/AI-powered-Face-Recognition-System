@extends('layout.app')
@section('content')
<div class="container mt-5">
    <h2>Add User</h2>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded bg-light">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save User</button>
    </form>
</div>

@endsection

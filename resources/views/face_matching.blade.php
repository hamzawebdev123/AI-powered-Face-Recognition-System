@extends('layout.app')
@section('content')
<div class="container mt-5">
    <h2>Scan Face</h2>
    <form action="{{ route('users.match') }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded bg-light">
        @csrf
        <div class="mb-3">
            <label>Upload Face Image</label>
            <input type="file" name="scan_image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Scan</button>
    </form>

    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
</div>

@endsection

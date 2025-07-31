@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2>Add User</h2>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded bg-light mb-5">
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
            <input type="file" name="image" id="imageInput" class="form-control" required onchange="previewImage(event)">
        </div>

        <div class="mb-3">
            <img id="preview" src="#" alt="Image Preview" class="img-thumbnail mt-2 d-none" style="max-width: 200px;">
        </div>

        <button type="submit" class="btn btn-primary">Save User</button>
    </form>

    <h3>All Users</h3>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <img src="{{ asset('images/' . $user->image) }}" width="80" class="img-thumbnail">
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection

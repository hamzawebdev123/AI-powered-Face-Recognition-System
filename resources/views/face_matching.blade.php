@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h2>Scan Face</h2>
    <form action="{{ route('users.match') }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded bg-light">
        @csrf
        <div class="mb-3">
            <label>Upload Face Image</label>
            <input type="file" name="scan_image" id="scanImageInput" class="form-control" required onchange="previewScanImage(event)">
        </div>

        <div class="mb-3">
            <img id="scanPreview" src="#" alt="Image Preview" class="img-thumbnail mt-2 d-none" style="max-width: 200px;">
        </div>

        <button type="submit" class="btn btn-success">Scan</button>
    </form>

    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
</div>

<!-- Image Preview Script -->
<script>
    function previewScanImage(event) {
        const input = event.target;
        const preview = document.getElementById('scanPreview');

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

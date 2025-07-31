@extends('layout.app')
@section('content')
@if($user)
<div class="container mt-5">
    <div class="card p-4">
        <h4>🎉 Match Found!</h4>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <img src="{{ asset('images/' . $user->image) }}" width="150" class="img-thumbnail">
    </div>
</div>
@endif

@endsection

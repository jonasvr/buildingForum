@extends('layouts.front')
@section('content')
<div class="card border-light bg-light">
<div class="card-header">Dashboard</div>
<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    You are logged in!
</div>
</div>
@endsection

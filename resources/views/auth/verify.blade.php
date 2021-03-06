@extends('layouts.app')
@section('content')
<div class="offset-2 col-md-8">
<div class="card bg-light">
    <div class="card-header">{{ __('Verify Your Email Address') }}</div>
    <div class="card-body">
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
        @endif
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
    </div>
</div>
</div>

@endsection

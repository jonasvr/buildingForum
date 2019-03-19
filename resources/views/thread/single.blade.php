@extends('layouts.front')
@section('heading','Thread')
@section('content')
<div class="card-body">
    @include('layouts.partials.success')
    <h4>{{$thread->subject}}</h4>
    <hr>
    <div class="thread-details">
        {!!$thread->thread!!}
    </div>
    <br>
    @if(auth()->user()->id == $thread->user_id)
    <div class="actions">
        <a href="{{route('threads.edit',$thread->id)}}" class="btn btn-info btn-xs"><i class="fas fa-pen"></i></a>
        {{--//delete form--}}
        <form action="{{route('threads.destroy',$thread->id)}}" method="POST" class="inline-it">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button class="btn btn-xs btn-danger" type="submit"><i class="fas fa-trash"></i></button>
        </form>
    </div>
    @endif
</div>
@endsection

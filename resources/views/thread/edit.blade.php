@extends('layouts.front')
@section('heading',"Edit Thread")
@section('content')
<div class="card-body">
    @include('layouts.partials.error')
    @include('layouts.partials.success')
    <form action="{{route('threads.update',$thread->id)}}" method="post" role="form" id="create-thread-form" class="needs-validation" novalidate>
        {{csrf_field()}}
        {{method_field('put')}}
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control border-0" name="subject" id="" placeholder="Input..." value="{{$thread->subject}}" >
        </div>
        <div class="form-group">
            <label for="thread">Thread</label>
            <textarea class="form-control border-0" name="thread" id="" placeholder="Input...">{{$thread->thread}}</textarea>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <textarea class="form-control border-0" name="type" id="" placeholder="Input...">{{$thread->type}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

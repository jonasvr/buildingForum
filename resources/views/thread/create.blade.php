@extends('layouts.front')
@section('heading',"Create Thread")
@section('content')
<div class="card-body">
    @include('layouts.partials.error')
    @include('layouts.partials.success')
    <form action="{{route('threads.store')}}" method="post" role="form" id="create-thread-form" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control border-0" name="subject" id="" placeholder="thread title" value="{{old('subject')}}" >
        </div>
        {{-- <div class="form-group">
            <label for="tag">Tags</label>
            <select name="tags[]" multiple id="tag"> --}}
                {{-- todo add from db--}}
                {{--  @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="form-group">
            <label for="thread">Thread</label>
            <textarea class="form-control border-0 markUp" name="thread" id="" placeholder="thread content..." rows="15">{{old('thread')}}</textarea>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <textarea class="form-control border-0" name="type" id="" placeholder="tag">{{old('type')}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
@section('js')
<script>tinymce.init({ selector:'.markUp',menubar:false });</script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>
<script>
$(function () {
$('#tag').selectize();
})
</script> --}}
@endsection

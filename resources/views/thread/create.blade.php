@extends('layouts.front')
@section('heading',"Create Thread")
@section('content')
<div class="card bg-light">
    <div class="card-body">
        @include('layouts.partials.error')
        @include('layouts.partials.success')
        <form action="{{route('threads.store')}}" method="post" role="form" id="create-thread-form" class="needs-validation" novalidate>
            {{csrf_field()}}
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control border-1" name="subject" id="" placeholder="thread title" value="{{old('subject')}}" >
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
                <textarea class="form-control border-1 markUp" name="thread" id="" placeholder="thread content..." rows="15">{{old('thread')}}</textarea>
            </div>
            <div class="form-group">
                    <label for="tag">Tags</label>
                    <select class="form-control  border-0" name="tags[]" multiple id="tag">
                       <option value="one">one</option>
                    <option value="two">two</option>
                    <option value="three">three</option>
                    <option value="four">four</option>
                    </select>

                {{-- <label for="tag">Tags</label>
                <select class="control-form" type="text" name="tag[]" multiple id="tag">


                    <option value="one">one</option>
                    <option value="two">two</option>
                    <option value="three">three</option>
                    <option value="four">four</option>

                </select> --}}
                {{-- <textarea class="form-control border-0" mulitple name="tag[]" id="" placeholder="tags">{{old('tag')}}</textarea> --}}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>tinymce.init({ selector:'.markUp',menubar:false });</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#tag').select2();
    });
</script>
@endsection

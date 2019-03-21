@extends('layouts.front')
@section('heading','Thread')
@section('extraInfo')
@include('thread.partials.threadTopicList')
@include('thread.partials.legend')
@endsection
@section('content')
<div class="card border-light ">
    @include('layouts.partials.success')
    <div class="card-header bg-info text-white">
        <div class="row">
            <div class="h4 col-md-6">{{$thread->subject}}</div>
            {{-- <div class="h5 text-right col-md-6">
                <a class="text-primary" href="{{ route('user_profile', $thread->user->name) }}">
                    {{$thread->user->name}}
                </a>
            </div> --}}
        </div>
    </div>
    <div class="card-body">
    <div class="row">
        <div class="thread-details col-md-12">
           <p>{{str_limit($thread->thread,100) }}
                    </p>

        </div>
        <div class="col-md-12 mt-3 text-sm">
            <hr>
                    Posted by <a href="{{route('user_profile',$thread->user->name)}}">{{$thread->user->name}}</a> {{$thread->created_at->diffForHumans()}}
        @can('update',$thread)
        <br>
            <div class="actions">
                <a href="{{route('threads.edit',$thread->id)}}" class="btn btn-xs btn-info btn-xs fas fa-xs fa-pen"></a>
                {{--//delete form--}}
                <form action="{{route('threads.destroy',$thread->id)}}" method="POST" class="inline-it">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-xs btn-danger fas fa-xs fa-trash" type="submit"></button>
                </form>
            </div>
        @endcan
        </div>
    </div>
    </div>
</div>
{{-- Awnser/comment --}}
@include('thread.partials.comment-list')
<div class="card border-light bg-light mt-3">
    <div class="card-body">
        <div class="comment-form">
            <form action="{{route('threadcomment.store',$thread->id)}}" method="post" role="form">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" class="form-control" name="body" id="" autocomplete="off" placeholder="Create Comment...">
                    <button type="submit" class="btn btn-primary">Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
function markAsSolution(threadId, solutionId,elem) {
var csrfToken='{{csrf_token()}}';
$.post('{{route('markAsSolution')}}', {solutionId: solutionId, threadId: threadId,_token:csrfToken}, function (data) {
$(elem).removeClass();
$(elem).addClass("btn btn-success btn-xs fas fa-xs fa-check")
$('.toMark').remove();
});
}
</script>
<script>
$('.add-reply-input').on('click', function (event) {
event.preventDefault();
$('#reply-input-'+$(this).val()).removeClass('d-none');
$(this).addClass('d-none');
});
</script>
<script type="text/javascript">
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>
<script>
function likeIt(commentId, elem) {
event.preventDefault();
var csrfToken='{{csrf_token()}}';
var likesCount=parseInt($('#'+commentId+"-count").text());
$.post('{{route('toggleLike')}}', {commentId: commentId,_token:csrfToken}, function (data) {
if(data.message==='liked'){
var classes = $(elem).attr('class');
classes = 'liked' +' ' +classes;
$(elem).attr('class', classes);
$('#'+commentId+"-count").text(likesCount+1);
}else{
$(elem).removeClass('liked');
$('#'+commentId+"-count").text(likesCount-1);
}
});
}
</script>
@endsection

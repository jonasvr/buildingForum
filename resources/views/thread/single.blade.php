@extends('layouts.front')
@section('heading','Thread')
@section('extraInfo')
@include('thread.partials.legend')
@endsection
@section('content')
<div class="card border-light bg-secondary text-white">
    <div class="card-body">
        @include('layouts.partials.success')
        <div class="row">
            <div class="h4 col-md-6">{{$thread->subject}}</div>
            <div class="h5 text-right col-md-6"> {{$thread->user->name}}</div>
        </div>
        <hr>
        <div class="row">
            <div class="thread-details col-md-12">
                {!!$thread->thread!!}
            </div>
            <br>
            @can('update',$thread)
            <div class="col-md-3 mt-3">
                <div class="actions">
                    <a href="{{route('threads.edit',$thread->id)}}" class="btn btn-xs btn-info btn-xs fas fa-xs fa-pen"></a>
                    {{--//delete form--}}
                    <form action="{{route('threads.destroy',$thread->id)}}" method="POST" class="inline-it">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-xs btn-danger fas fa-xs fa-trash" type="submit"></button>
                    </form>
                </div>
            </div>
            @endcan
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

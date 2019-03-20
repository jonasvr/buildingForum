@extends('layouts.front')
@section('heading','Thread')
@section('extraInfo','history comes here')
@section('content')
<div class="card border-light bg-light">
    <div class="card-body">
        @include('layouts.partials.success')
        <div class="row">
            <div class="h4 col-md-6">{{$thread->subject}}</div>
            <div class="h5 text-right col-md-6"> {{$thread->user->name}}</div>
        </div>
        <hr>
        <div class="row">
            <div class="thread-details col-md-10">
                {!!$thread->thread!!}
            </div>
            <br>
            @if(auth()->user()->id == $thread->user_id)
            <div class="col-md-2">
                <div class="actions  float-right">
                    <a href="{{route('threads.edit',$thread->id)}}" class="btn btn-xs btn-info btn-xs"><i class="fas fa-xs fa-pen"></i></a>
                    {{--//delete form--}}
                    <form action="{{route('threads.destroy',$thread->id)}}" method="POST" class="inline-it">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-xs btn-danger" type="submit"><i class="fas fa-xs fa-trash"></i></button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
{{-- Awnser/comment --}}
@if($thread->comments !== null)
<div class="comment-list">
    @foreach($thread->comments as $comment)
    <div class="card border-light bg-light mt-3" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <p class="lead">
                        @if(!empty($thread->solution))
                        @if($thread->solution == $comment->id)
                        <a class="btn btn-success btn-xs fas fa-xs fa-check" data-toggle="tooltip" data-placement="top" title="Marked as solution"></a>
                        @endif
                        @else
                        {{-- @can('update',$thread) --}}
                        <a class="btn btn-default btn-xs fas fa-xs fa-check toMark" onclick="markAsSolution('{{$thread->id}}','{{$comment->id}}',this)" data-toggle="tooltip" data-placement="top" title="Mark as solution"></a>
                        {{-- @endcan --}}
                        @endif
                        {{$comment->body}}
                    </p>
                </div>
                <div class="col-md-3">
                    @if(Auth::user()->id === $comment->user_id)
                    <div class="actions float-right">
                        <a class="btn btn-info btn-xs fas fa-xs fa-pen" data-toggle="modal" href="#{{$comment->id}}" data-target="#comment{{$comment->id}}"></a>
                        {{--//delete form--}}
                        <form action="{{route('comments.destroy',$comment->id)}}" method="POST" class="inline-it">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-xs btn-danger fas fa-xs fa-trash" type="submit"></button>
                        </form>
                    </div>
                    @else
                    <span class="font-weight-light float-right">{{$comment->user->name}}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('thread.partials.comment-edit-model')
    {{-- reply to comment --}}
    @if($comment->comments !== null)
    @foreach($comment->comments as $reply)
    <div class="card border-light bg-light mt-3" style="margin-left: 40px">
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="row pt-3">
                        <div class="col-md-9">
                            <p>{{$reply->body}}</p>
                        </div>
                        <div class="col-md-3">
                            @if(Auth::user()->id === $reply->user_id)
                            <div class="actions float-right">
                                <a class="btn btn-info btn-xs fas fa-xs fa-pen" data-toggle="modal" href="#{{$reply->id}}" data-target="#reply{{$reply->id}}"></a>
                                {{--//delete form--}}
                                <form action="{{route('comments.destroy',$reply->id)}}" method="POST" class="inline-it">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-xs btn-danger fas fa-xs fa-trash" type="submit"></button>
                                </form>
                            </div>
                            @else
                            <span class="font-weight-light float-right">{{$reply->user->name}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('thread.partials.reply-edit-model')
    @endforeach
    @endif
    <div class="mt-3">
        <button style="margin-left: 50px" type="button" class="btn btn-link add-reply-input" value="{{$comment->id}}">Reply...</button>
        <div style="margin-left: 50px" id="reply-input-{{$comment->id}}" class="reply-form d-none">
            <form action="{{route('replycomment.store',$comment->id)}}" method="post" role="form">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" class="form-control" autocomplete="off" name="body" id="" placeholder="Create Reply...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Reply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endif
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
console.log(data);
$(elem).removeClass();
$(elem).addClass("btn btn-success btn-xs fas fa-xs fa-check")
$('.toMark').remove();
});
}
</script>
<script>
$('.add-reply-input').on('click', function (event) {
event.preventDefault();
console.log($(this).val());
$('#reply-input-'+$(this).val()).removeClass('d-none');
$(this).addClass('d-none');
});
</script>
<script type="text/javascript">
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>
@endsection

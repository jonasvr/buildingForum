<div class="comment-page-header">
	<h4>Tags</h4>
</div>
<ul class="list-group">
	<a href="{{route('threads.index')}}" class="list-group-item">
		<span class="badge badge-secondary float-right">{{App\Thread::count()}}</span>
		All Threads
	</a>
	@foreach($tags as $tag)
	<a href="{{route('threads.index',['tags'=>$tag->id])}}" class="list-group-item">
		<span class="badge badge-secondary float-right">{{$tag->threads()->count()}}</span>
		{{$tag->name}}
	</a>
	@endforeach
</ul>

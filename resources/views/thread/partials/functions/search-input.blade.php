@auth
	<form method="get" action="{{route('threads.search')}}">

        <div class="form-group">
            <input type="text" name="query" class="form-control" placeholder="Search">
        </div>

    </form>
	@endauth

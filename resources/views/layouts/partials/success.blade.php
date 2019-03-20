@if(session('message'))
<div class="alert alert-success mt-2">
	<button type="button" class="close" data-dismiss="alert">×</button>
    {{session('message')}}
</div>
@endif

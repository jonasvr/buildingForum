<div class="modal fade" id="reply{{$reply->id}}" tabindex="-1" role="dialog" aria-labelledby="reply with id: {{$reply->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="reply-form">
                    <form action="{{route('comments.update',$reply->id)}}" method="post" role="form">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <legend>Edit reply</legend>
                        <div class="form-group">
                            <input type="text" class="form-control" name="body" id=""
                            autocomplete="off" value="{{$reply->body}}">
                        </div>
                        <button type="submit" class="btn btn-primary">edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

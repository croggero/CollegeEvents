@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>
                <div class="panel-body">
                    @foreach($comments as $comment)
                        <p>{{ $comment->comment }}</p>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Add Comment</div>
                <div class="panel-body">
                    <form id="addcomment" class="form-horizontal" role="form" method="POST" enctype='multipart/form-data' action="addcomment">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="comment" class="col-md-4 control-label">Comment</label>
                            <div class="col-md-6">
                                <textarea rows="5" class="form-control" name="comment" form="addcomment"></textarea>
                            </div>
                        </div>

                        <input id="event_id" type="hidden" class="form-control" name="event_id" value="{{ $event_id }}" required autofocus>
                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Comment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
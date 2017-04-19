@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Event</div>
                <div class="panel-body">
                @foreach ($events as $event)
                    <div class="panel-body" style="text-align:center;">
                        <div id="event">
                            <div style="text-align:center;">
                                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBorqxDcXjUOuSN8pmcIK4lsNMH3D_kW3U&callback=initMap"
                                type="text/javascript"></script> 
                                <div style="width: 100%; height: 200px;">
                                    {!! Mapper::render() !!}
                                </div>
                                <h2>{{ $event->name }}</h2>
                                <p>Description: {{ $event->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>
                <div class="panel-body">
                    @foreach($comments as $comment)
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <p><small>{{ $comment->name }}: </small>{{ $comment->comment }}</p>
                            </div>
                            <div class="col-md-2">
                            @if ($comment->user_id == Auth::id())
                                <form class="form-horizontal" role="form" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');" action="delcomment/{{ $event_id }}" style="text-align: center;">
                                    {{ csrf_field() }}
                                    <input id="comment_id" type="hidden" class="form-control" name="comment_id" value="{{ $comment->id }}" required autofocus>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            @endif
                            <small>{{ $comment->date }}</small>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    @endforeach
                    <form id="addcomment" class="form-horizontal" role="form" method="POST" enctype='multipart/form-data' action="addcomment/{{ $event_id }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="comment" class="col-md-4 control-label">Add Comment:</label>
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
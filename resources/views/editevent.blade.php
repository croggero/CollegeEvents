@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Event</div>
                <div class="panel-body">
                    <form id="editevent" class="form-horizontal" role="form" method="POST" enctype='multipart/form-data' action="updateevent">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="eventname" class="col-md-4 control-label">Event Name</label>
                            <div class="col-md-6">
                                <input id="eventname" type="text" class="form-control" name="eventname" value="{{ $event->name }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desc" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea rows="5" class="form-control" name="desc">{{ $event->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cat" class="col-md-4 control-label">Category</label>
                            <div class="col-md-6">
                            <select id="cat" type="textarea" class="form-control" name="cat" required>
                                @foreach ($cats as $cat)
                                    @if ($event->cat_id == $cat->id)
                                        <option id="cat" value="{{ $cat->id }}" selected>{{ $cat->cat_name }}</option>
                                    @else
                                        <option id="cat" value="{{ $cat->id }}" selected>{{ $cat->cat_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location" class="col-md-4 control-label">Location</label>
                            <div class="col-md-6">
                                <select id="loc" type="textarea" class="form-control" name="loc" required>
                                @foreach ($locs as $loc)
                                    @if( $event->location_id == $loc->id)
                                        <option id="loc" value="{{ $loc->id }}" selected>{{$loc->loc_name }}</option>
                                    @else
                                        <option id="loc" value="{{ $loc->id }}">{{$loc->loc_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time" class="col-md-4 control-label">Time</label>
                            <div class="col-md-6">
                                <input id="time" type="time" class="form-control" name="time" value="{{ $event->time }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="date" class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" value="{{ $event->date }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Event Image</label>
                            <div class="col-md-6">
                                <div>
                                <img src="{{ $event->img }}" style="border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 150px;"/>
                                </div>
                                {!! Form::file('image') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contactemail" class="col-md-4 control-label">Contact Email</label>
                            <div class="col-md-6">
                                <input id="contactemail" type="email" class="form-control" value="{{ $event->email }}" name="contactemail" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contactphone" class="col-md-4 control-label">Contact Phone<br><small>(xxx-xxx-xxxx)</small></label>
                            <div class="col-md-6">
                                <input id="contactphone" type="tel" value="{{ $event->phone }}" class="form-control" name="contactphone" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location" class="col-md-4 control-label">Event Type</label>
                            <div class="col-md-6">
                                <select id="permission" type="textarea" class="form-control" name="permission" required>
                                    @if ($event->permission == 1)
                                        <option id="permission" value="1" selected>Public Event</option>
                                        <option id="permission" value="2">University Event</option>
                                        <option id="permission" value="3">RSO Event</option>
                                    @elseif ($event->permission == 2)
                                        <option id="permission" value="1">Public Event</option>
                                        <option id="permission" value="2" selected>University Event</option>
                                        <option id="permission" value="3">RSO Event</option>
                                    @else
                                        <option id="permission" value="1">Public Event</option>
                                        <option id="permission" value="2">University Event</option>
                                        <option id="permission" value="3" selected>RSO Event</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <input id="eventid" type="hidden" class="form-control" name="eventid" value="{{ $event->id }}" required autofocus>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Event
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
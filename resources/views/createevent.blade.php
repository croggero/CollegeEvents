@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Event</div>
                <div class="panel-body">
                    <form id="createevent" class="form-horizontal" role="form" method="POST" action="createevent">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="eventname" class="col-md-4 control-label">Event Name</label>
                            <div class="col-md-6">
                                <input id="eventname" type="text" class="form-control" name="eventname" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desc" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea rows="5" class="form-control" name="desc" form="createevent"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cat" class="col-md-4 control-label">Category</label>
                            <div class="col-md-6">
                            <select id="cat" type="textarea" class="form-control" name="cat" required>
                                <option value="" data-id="" disabled selected> -- Please Select -- </option>
                                @foreach ($cats as $cat)
                                    <option id="cat" value="{{ $cat->id }}">{{$cat->cat_name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location" class="col-md-4 control-label">Location</label>
                            <div class="col-md-6">
                                <select id="loc" type="textarea" class="form-control" name="loc" required>
                                <option value="" data-id="" disabled selected> -- Please Select -- </option>
                                @foreach ($locs as $loc)
                                    <option id="loc" value="{{ $loc->id }}">{{$loc->loc_name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time" class="col-md-4 control-label">Time</label>
                            <div class="col-md-6">
                                <input id="time" type="time" class="form-control" name="time" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="date" class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contactemail" class="col-md-4 control-label">Contact Email</label>
                            <div class="col-md-6">
                                <input id="contactemail" type="email" class="form-control" placeholder="email@email.com" name="contactemail" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contactphone" class="col-md-4 control-label">Contact Phone<br><small>(xxx-xxx-xxxx)</small></label>
                            <div class="col-md-6">
                                <input id="contactphone" type="tel" pattern="^\d{4}-\d{3}-\d{4}$" placeholder="xxx-xxx-xxxx" class="form-control" name="contactphone" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create Event
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
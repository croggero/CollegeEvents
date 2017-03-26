@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body" style="text-align:center;">
                    @foreach ($unis as $uni)
                        @if ($uni->superadmin_id == Auth::id())
                        <p>You are a SuperAdmin of <b>{{ $uni->name }} ({{ $uni->initials }})</b></p>
                        @else   
                        <p>You are a part of <b>{{ $uni->name }} ({{ $uni->initials }})</b></p>
                        @endif
                    @endforeach
                    <h3>Your RSOs</h3>
                    @if (count($rsos) <= 0)
                    <p>You are not a part of any RSOs</p>
                    @else
                    <div class="" style="display:block;">
                    @foreach ($rsos as $rso)
                        <div>
                            <div class="col-md-6" style="display:inline-block;">
                                {{ $rso->name }}
                                @if ($rso->admin_id == Auth::id())
                                 (Admin)
                                @endif
                            </div>
                            <div class="col-md-2" style="display:inline-block;">
                                @if ($rso->admin_id == Auth::id())
                                <form class="form-horizontal" role="form" method="POST" action="rsojoined">
                                    <input id="name" type="hidden" class="form-control" name="id" value="{{ $rso->id }}" required autofocus>
                                    <button type="submit" class="btn btn-default">Create Event</button>
                                <form>
                                @endif
                            </div>
                            <div class="col-md-2" style="display:inline-block;">
                                <form class="form-horizontal" role="form" method="POST" action="rsojoined">
                                    <input id="name" type="hidden" class="form-control" name="id" value="{{ $rso->id }}" required autofocus>
                                    <button type="submit" class="btn btn-danger">Leave</button>
                                <form>
                            </div>
                        </div>
                        <br /><br />
                    @endforeach
                    </div>
                    @endif
                    <br>
                    <div class="col-md-8 col-md-offset-2" style="display:block;">
                        <a class="btn btn-default" href="/joinrso">Join a RSO</a>
                        <a class="btn btn-default" href="/startrso">Start a RSO</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Events</div>
                <div class="panel-body" style="text-align:center;">
                    
                    @foreach ($events as $event)
                    <div id="event">
                        <div style="width: 100%; height:200px; overflow: hidden;">
                            <img src="{{ $event->img }}" style="width: 100%;">
                        </div>
                        <div style="text-align:center;">
                            <h2>{{ $event->name }}</h2>
                            <p>Description: {{ $event->description}}</p>
                            <div class="col-md-6">
                                <h6>Location: {{ $event->loc_name }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6>Category: {{ $event->cat_name }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6>Date: {{ $event->date }}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6>Time: {{ $event->time }}</h6>
                            </div> 
                            <h5>Contact</h5><p>Phone: {{ $event->phone }} &nbsp;  Email:{{ $event->email }}</p>
                        </div>
                        <div>
                            <a class="btn btn-default" href="/joinrso">Add Event to Calendar</a>
                            <a class="btn btn-default" href="/startrso">View on Maps</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

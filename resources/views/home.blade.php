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
                    @if (!empty($rsos))
                    @if (count($rsos) <= 0)
                    <p>You are not a part of any RSOs</p>
                    @else
                    <div class="" style="display:block;">
                    @foreach ($rsos as $rso)
                        @if ($rso->active == 1)
                        <div class="col-md-12" style="margin: 2px 0px; padding: 5px 0px; background-color: rgb(110, 234, 183); border-radius: 2px;">
                        @else
                        <div class="col-md-12" style="margin: 2px 0px; padding: 5px 0px; background-color: rgb(236, 221, 221); border-radius: 2px;">
                        @endif
                            <div class="col-md-6" style="display:inline-block;">
                                {{ $rso->name }}
                                @if ($rso->admin_id == Auth::id())
                                 (Admin) 
                                @endif
                                @if ($rso->active == 0)
                                    is not Active
                                @else
                                    is Active
                                @endif
                            </div>
                            <div class="col-md-2" style="display:inline-block;">
                                @if (($rso->admin_id == Auth::id()) and ($rso->active == 1))
                                <form class="form-horizontal" role="form" method="POST" action="createevent">
                                    {{ csrf_field() }}
                                    <input id="id" type="hidden" class="form-control" name="id" value="{{ $rso->id }}" required autofocus>
                                    <button type="submit" class="btn btn-default">Create Event</button>
                                </form>
                                @endif
                            </div>
                            <div class="col-md-2" style="display:inline-block;">
                                @if ($rso->admin_id == Auth::id())
                                <form class="form-horizontal" role="form" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $rso->name }}?');" action="deleteRso">
                                    {{ csrf_field() }}
                                    <input id="rso_id" type="hidden" class="form-control" name="id" value="{{ $rso->id }}" required autofocus>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                                @else
                                <form class="form-horizontal" role="form" method="POST" action="leaveRso">
                                    {{ csrf_field() }}
                                    <input id="rso_id" type="hidden" class="form-control" name="id" value="{{ $rso->id }}" required autofocus>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                                @endif
                            </div>
                        </div>
                        <br /><br />
                    @endforeach
                    
                    </div>
                    @endif
                    @endif
                    <br>
                    <div class="col-md-8 col-md-offset-2" style="display:block;">
                        <a class="btn btn-default" href="/joinrso">Join a RSO</a>
                        <a class="btn btn-default" href="/createrso">Create a RSO</a>
                        @if (!empty($rsos))
                        @if ($uni->superadmin_id == Auth::id())
                        <a class="btn btn-default" href="/createloc">Create University Location</a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
             @if ($uni->superadmin_id == Auth::id())
                <div class="panel panel-default">
                    <div class="panel-heading">Approve Events</div> 
                    <div class="panel-body" style="text-align:center;">
                        @foreach ($events as $event)
                            @if ($event->approved == 0 and $uni->id == $event->uni_id)
                                <div class="col-md-6" style="display:inline-block;">{{ $event->name }}</div>
                                <div class="col-md-6" style="display:inline-block;">
                                    <form class="form-horizontal" role="form" method="POST" action="approveevent">
                                        {{ csrf_field() }}
                                        <input id="eventid" type="hidden" class="form-control" name="id" value="{{ $event->id }}" required autofocus>
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
             @endif
            <div class="panel panel-default">
                <div class="panel-heading">Events</div>    
                    @foreach ($events as $event)
                    @if (($event->permission == 2 and $uni->id == $event->uni_id) or ($event->permission == 1 or $event->permission == 3) and ($event->approved == 1))
                    <div class="panel-body" style="text-align:center;">
                        <div id="event">
                            <div style="width: 100%; height:200px; overflow: hidden;">
                                <img src="{{ $event->img }}" style="width: 100%;">
                            </div>
                            <div style="text-align:center;">
                                <h2>{{ $event->name }}</h2>
                                <p>Description: {{ $event->description}}</p>
                                @foreach($numGoing as $num)
                                    @if ($num->event_id == $event->id)
                                        <p>Number of people attending: {{ $num->attending }}<p>
                                    @endif
                                @endforeach
                                <div class="row" style="margin: 0px 10px; background-color: rgb(245, 245, 245); border-radius: 2px;">
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <h5>{{ $event->uni_name }}</h5>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <h5>RSO: {{ $event->rso_name }}</h5>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <h5>Event Type:
                                            @if ( $event->permission == 1 )
                                                Public Event
                                            @elseif ( $event->permission == 2 )
                                                University Event
                                            @elseif ( $event->permission == 3 )
                                                RSO Event
                                            @endif
                                        </h5>
                                    </div>
                                </div>
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
                                <h5>Contact Info:</h5><p>Phone: <a href="tel:{{ $event->phone }}">{{ $event->phone }}</a> &nbsp;  Email: <a href="mailto:{{ $event->email }}">{{ $event->email }}</a></p>
                                
                            </div>
                        <div>
                        @if ($event->admin_id == Auth::id())
                            <?php  $going = 0;
                            foreach($userGoing as $ugoing) {
                                if ($ugoing->event_id == $event->id and $ugoing->user_id == Auth::id()) {
                                    $going = 1;
                                }
                            } ?>
                            @if ($going == 1)
                                <div class="col-xs-6 col-sm-3 col-md-3" style="display:inline-block;">
                                    <form class="form-horizontal" role="form" method="POST" action="leaveevent">
                                        {{ csrf_field() }}
                                        <input id="event_id" type="hidden" class="form-control" name="event_id" value="{{ $event->id }}" required autofocus>
                                        <button type="submit" class="joined btn btn-success"><span>Joined <i class="fa fa-check" aria-hidden="true"></i><span></button>
                                    </form>
                                </div>
                            @else
                                <div class="col-xs-6 col-sm-3 col-md-3" style="display:inline-block;">
                                    <form class="form-horizontal" role="form" method="POST" action="joinevent">
                                        {{ csrf_field() }}
                                        <input id="event_id" type="hidden" class="form-control" name="event_id" value="{{ $event->id }}" required autofocus>
                                        <button type="submit" class="btn btn-success">Join</button>
                                    </form>
                                </div>
                            @endif
                            <div class="col-xs-6 col-sm-3 col-md-3" style="display:inline-block;">
                                <a class="btn btn-default" href="/info/{{ $event->id }}">More Info</a>
                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-3" style="display:inline-block;">
                                <form class="form-horizontal" role="form" method="POST" action="editevent/{{ $event->id }}">
                                    {{ csrf_field() }}
                                    <input id="event_id" type="hidden" class="form-control" name="id" value="{{ $event->id }}" required autofocus>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-3" style="display:inline-block;">
                                <form class="form-horizontal" role="form" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $event->name }}?');" action="deleteevent">
                                    {{ csrf_field() }}
                                    <input id="event_id" type="hidden" class="form-control" name="id" value="{{ $event->id }}" required autofocus>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                            @else
                            <?php  $going = 0;
                            foreach($userGoing as $ugoing) {
                                if ($ugoing->event_id == $event->id and $ugoing->user_id == Auth::id()) {
                                    $going = 1;
                                }
                            } ?>
                            @if ($going == 1)
                                <div class="col-xs-6 col-sm-6 col-md-6" style="display:inline-block;">
                                    <form class="form-horizontal" role="form" method="POST" action="leaveevent">
                                        {{ csrf_field() }}
                                        <input id="event_id" type="hidden" class="form-control" name="event_id" value="{{ $event->id }}" required autofocus>
                                        <button type="submit" class="btn btn-success joined"><span>Joined <i class="fa fa-check" aria-hidden="true"></i></span></button>
                                    </form>
                                </div>
                            @else
                                <div class="col-xs-6 col-sm-6 col-md-6" style="display:inline-block;">
                                    <form class="form-horizontal" role="form" method="POST" action="joinevent">
                                        {{ csrf_field() }}
                                        <input id="event_id" type="hidden" class="form-control" name="event_id" value="{{ $event->id }}" required autofocus>
                                        <button type="submit" class="btn btn-success">Join</button>
                                    </form>
                                </div>
                            @endif
                            <div class="col-xs-6 col-sm-6 col-md-6" style="display:inline-block;">
                                <form class="form-horizontal" role="form" method="POST" action="info">
                                    {{ csrf_field() }}
                                    <input id="event_id" type="hidden" class="form-control" name="event_id" value="{{ $event->id }}" required autofocus>
                                    <button type="submit" class="btn btn-default">More Info</button>
                                </form>
                            </div>
                            @endif    
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

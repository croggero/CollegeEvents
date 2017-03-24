@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body" style="text-align:center;">
                    @foreach ($unis as $uni)   
                        <p>You are a part of <b>{{ $uni->name }} ({{ $uni->initials }})</b></p>
                    @endforeach
                    <h3>Your RSOs</h3>
                    @if (count($rsos) <= 0)
                    <p>You are not a part of any RSOs</p>
                    @else
                    @foreach ($rsos as $rso)
                        <li>{{ $rso->name }}</li>
                    @endforeach
                    @endif
                    <a class="btn btn-default" href="/joinrso">Join a RSO</a>
                    <a class="btn btn-default" href="/startrso">Start a RSO</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Events</div>
                <div class="panel-body" style="text-align:center;">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

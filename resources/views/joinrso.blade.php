@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Join a RSO</div>
                <div class="panel-body">
                    @foreach ($rsos as $rso)
                    <form class="form-horizontal" role="form" method="POST" action="rsojoined">
                        {{ csrf_field() }}
                        <div style="text-align:center;">
                            <div class="col-md-8 col-md-offset-2" style="display:inline-block;">
                            <span>{{ $rso->name }}</span>
                            </div>
                            <div style="display:inline-block;">
                            <input id="name" type="hidden" class="form-control" name="id" value="{{ $rso->id }}" required autofocus>
                            <button type="submit" class="btn btn-primary">Join</button>
                            </div>
                            <p></p>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
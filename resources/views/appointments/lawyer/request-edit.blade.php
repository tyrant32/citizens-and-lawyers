@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Appointment</div>

                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('lawyer.request.appointment.update',$appointment->id) }}">

                            <input type="hidden" name="_method" value="PUT">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">

                                <label for="user_id" class="col-md-4 control-label">Citizen</label>

                                <div class="col-md-6">

                                    <select name="user_id" id="user_id" class="form-control" disabled>
                                        <option value="">{{$appointment->user->name}}</option>
                                    </select>

                                    @if ($errors->has('user_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">

                                <label for="status_id" class="col-md-4 control-label">Status</label>

                                <div class="col-md-6">

                                    <select name="status_id" id="status_id" class="form-control">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}">{{$status->title}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('status_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status_id') }}</strong>
                                        </span>
                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">

                                <label for="time" class="col-md-4 control-label">Time</label>

                                <div class="col-md-6">

                                    <input type="text" id="time" name="time" value="{{ $appointment->time }}"/>

                                    @if ($errors->has('time'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('time') }}</strong>
                                        </span>
                                    @endif

                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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

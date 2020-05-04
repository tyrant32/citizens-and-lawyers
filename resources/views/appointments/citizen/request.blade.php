@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Request Appointment</div>

                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('citizen.request.appointment.create') }}">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('lawyer_id') ? ' has-error' : '' }}">

                                <label for="lawyer_id" class="col-md-4 control-label">Lawyer</label>

                                <div class="col-md-6">

                                    <select name="lawyer_id" id="lawyer_id" class="form-control">
                                        @foreach($lawyers as $lawyer)
                                            <option value="{{ $lawyer->id }}">{{$lawyer->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('lawyer_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lawyer_id') }}</strong>
                                        </span>
                                    @endif

                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">

                                <label for="time" class="col-md-4 control-label">Time</label>

                                <div class="col-md-6">

                                    <input type="text" id="time" name="time"/>

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
                                        Request
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

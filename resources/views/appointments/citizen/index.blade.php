@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Appointments Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ session('status') }}</strong>
                            </div>
                        @endif

                        <p>
                            <a href="{{ route('citizen.request.appointment') }}" class="btn btn-success">Request Appointment</a>
                        </p>

                        <div class="table-responsive">

                            <table id="appointments-list" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Lawyer</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Lawyer</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th>Actions</th>
                                </tr>
                                </tfoot>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var routeEdit = '{{ url('/' . Auth::user()->role->slug . '/appointment/') }}';
        var routeDelete = '{{ url('/' . Auth::user()->role->slug . '/appointment/') }}';
    </script>

@endsection

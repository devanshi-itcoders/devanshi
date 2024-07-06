@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>

            <div class="pull-right">
                @can('user-create')
                    <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create New
                        User</a>
                @endcan

            </div>
        </div>
    </div>
    <div class="panel panel-default search-box-panel">
        <div class="panel-body">
            <div class="row">
                {!! Form::open(['route' => 'users.index', 'method' => 'GET', 'class' => '']) !!}
                <div class="col-xs-12">
                    <label for="">Search by criteria</label>
                    <hr>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="form-group">
                        <label for="search">Search:</label>
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Search By Name,Phone"
                            value="{{ $filter }}">
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="form-group">
                        <label for="search">Role:</label>
                        {!! Form::select('role', array_merge(['' => 'Select Role'], $roles), [$roleFilter], ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <button type="submit" class="btn btn-default search-btn">Search</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="table-responsive record-listing-page">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">@sortablelink('name', 'Name')</th>
                    <th rowspan="2">@sortablelink('email', 'Email/Phone')</th>
                    <th colspan="3">Visits</th>
                    <th rowspan="2">Status</th>
                    <th rowspan="2">Roles</th>
                    <th rowspan="2" width="150px">Action</th>
                </tr>
                <tr>
                    <th>@sortablelink('no_assign_visit', 'Assign')</th>
                    <th>@sortablelink('no_success_visit', 'Success')</th>
                    <th>@sortablelink('no_failed_visit', 'Failed')</th>

                </tr>
            </thead>
            @if (count($data) <= 0)
                <tr class="no-record-found">
                    <td colspan="10">{{ __('No any record found.') }}</td>
                </tr>
            @endif
            @foreach ($data as $key => $user)
                <tr class="{{ $user->status == 'INACTIVE' ? 'bg-danger' : '' }}">
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }} / {{ $user->phone }}</td>
                    <td>{{ $user->no_assign_visit }}</td>
                    <td>{{ $user->no_success_visit }}</td>
                    <td>{{ $user->no_failed_visit }}</td>
                    <td>{{ $user->status }}</td>
                    <td>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>

                    <td>
                        <a class="btn btn-info" href="{{ route('users.show', $user->id) }}"><i class="fas fa-eye"></i></a>
                        @can('user-edit')
                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}"><i
                                    class="fas fa-edit"></i></a>
                        @endcan

                        @can('user-delete')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}

                            {!! Form::button('<i class="fas fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger delete',
                                'id' => 'delete',
                            ]) !!}

                            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'id' => 'delete']) !!} --}}

                            {!! Form::close() !!}
                        @endcan

                    </td>

                </tr>
            @endforeach

        </table>
    </div>
    {{ $data->links('vendor.pagination.custom') }}

    {{-- {!! $data->appends(Request::except('page'))->render() !!} --}}
    {{-- {!! $data->render() !!} --}}

    <p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>
@endsection

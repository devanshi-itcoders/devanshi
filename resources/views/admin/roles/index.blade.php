@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Role Management</h2>
            </div>

            <div class="pull-right">
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create New
                        Role</a>
                @endcan
            </div>
        </div>
    </div>
    <div class="panel panel-default search-box-panel">
        <div class="panel-body">
            <div class="row">
                {!! Form::open(['route' => 'roles.index', 'method' => 'GET', 'class' => '']) !!}
                <div class="col-xs-12">
                    <label for="">Search by criteria</label>
                    <hr>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="form-group">
                        <label for="search">Search:</label>
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Search By Name"
                            value="{{ $filter }}">
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
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th width="180px">Action</th>
            </tr>
            @if (count($roles) <= 0)
                <tr class="no-record-found">
                    <td colspan="10">{{ __('No any record found.') }}</td>
                </tr>
            @endif
            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->created_at ? $role->created_at->format('jS M, Y') : '-' }}</td>
                    <td>{{ $role->updated_at ? $role->updated_at->format('jS M, Y') : '-' }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}"><i class="fas fa-eye"></i></a>
                        @can('role-edit')
                            <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}"><i
                                    class="fas fa-edit"></i></a>
                        @endcan

                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                            {!! Form::button('<i class="fas fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger delete',
                                'id' => 'delete',
                            ]) !!}
                            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    {{ $roles->links('vendor.pagination.custom') }}

    <p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>
@endsection

    @extends('layouts.app')
    @section('content')
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>{{ 'Configuration Management' }}</h2>
                </div>

                <div class="pull-right">
                    @can('role-create')
                        <a class="btn btn-success" href="{{ route('configurations.create') }}"><i
                                class="fas fa-plus"></i>&nbsp;&nbsp;{{ 'Create New Configuration' }}</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="panel panel-default search-box-panel">
            <div class="panel-body">
                <div class="row">
                    {!! Form::open(['route' => 'configurations.index', 'method' => 'GET', 'class' => '']) !!}
                    <div class="col-xs-12">
                        <label for="">{{ __('Search by criteria') }}</label>
                        <hr>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="form-group">
                            <label for="search">{{ _('Search:') }}</label>
                            <input type="text" class="form-control" id="search" name="search"
                                placeholder="Search By Key,Value" value="{{ $searchInput }}">
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
                    <th>{{ _('No') }}</th>
                    <th>@sortablelink('configkey','Config Key')</th>
                    <th>@sortablelink('configvalue','Config Value')</th>
                    <th>{{ _('Status') }}</th>
                    <th>{{ _('Action') }}</th>
                </tr>
                <tbody>
                    @if (count($configurationListArr) <= 0)
                        <tr class="no-record-found">
                            <td colspan="10">{{ __('No any record found.') }}</td>
                        </tr>
                    @endif
                    @foreach ($configurationListArr as $item)
                        <tr>
                            <input type="hidden" class="ser_delete_val" value="{{ $item->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->configkey }}</td>
                            <td>{{ $item->configvalue }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <ul class="list-unstyled d-flex">
                                    <a class="btn btn-primary"
                                        href="{{ route('configurations.edit', ['configuration' => $item->id]) }}"><i
                                            class="fas fa-edit"></i></a>

                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['configurations.destroy', ['configuration' => $item->id]],
                                        'style' => 'display:inline',
                                    ]) !!}
                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger delete',
                                        'id' => 'delete',
                                    ]) !!}
                                    {!! Form::close() !!}
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $configurationListArr->links('vendor.pagination.custom') }}

        <p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>
    @endsection

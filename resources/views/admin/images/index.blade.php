@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __('Images Management') }}</h2>
            </div>

            <div class="pull-right">
                @can('user-create')
                    <a class="btn btn-success" href="{{ route('images.create') }}"><i class="fas fa-plus"></i>&nbsp;&nbsp;
                        {{ __('Create New Images') }}</a>
                @endcan

            </div>
        </div>
    </div>
    <div class="panel panel-default search-box-panel">
        <div class="panel-body">
            <div class="row">
                {!! Form::open(['route' => 'images.index', 'method' => 'GET', 'class' => '']) !!}
                <div class="col-xs-12">
                    <label for="">Search by criteria</label>
                    <hr>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="form-group">
                        <label for="search">{{ __('Search') }}:</label>
                        <input type="text" class="form-control" id="filter" name="filter"
                            placeholder="Search By Title" value="{{$filter}}">
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="form-group">
                        <label for="">Status</label>
                        {!! Form::select(
                            'status',
                            array_merge([
                                '' => 'Select Status',
                                'ACTIVE' => 'ACTIVE',
                                'INACTIVE' => 'INACTIVE',
                            ]),
                            [$status],
                            ['class' => 'form-control status'],
                        ) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <button type="submit" class="btn btn-default search-btn">{{ __('Search') }}</button>
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
            <tr>
                <th>{{ __('No') }}</th>
                <th>@sortablelink('title', 'Title')</th>
                {{-- <th>{{ __('Image') }}</th> --}}
                <th>{{ __('Status') }}</th>
                <th>{{__('Created At')}}</th>
                <th>{{__('Updated At')}}</th>
                <th width="200px">{{ __('Action') }}</th>
            </tr>
            </tr>
            @if (count($data) <= 0)
                <tr class="no-record-found">
                    <td colspan="10">{{ __('No any record found.') }}</td>
                </tr>
            @endif
            @foreach ($data as $key => $image)
                <tr class="{{ $image->status == 'INACTIVE' ? 'bg-danger' : '' }}">
                    <td>{{ ++$i }}</td>
                    <td>{{ $image->title }}</td>
                    {{-- <td><img src="/files/images/{{ $image->id }}/{{ $image->image }}" alt="image" width="100px" height="100px"> </td> --}}
                    <td>{{ $image->status }}</td>
                    <td>{{ $image->created_at ? $image->created_at->format('jS M, Y') : '-' }}</td>
                    <td>{{ $image->updated_at ? $image->updated_at->format('jS M, Y') : '-' }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('images.show', $image->id) }}"><i class="fas fa-eye"></i></a>
                        @can('user-edit')
                            <a class="btn btn-primary" href="{{ route('images.edit', $image->id) }}"><i
                                    class="fas fa-edit"></i></a>
                        @endcan

                        @can('user-delete')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['images.destroy', $image->id], 'style' => 'display:inline']) !!}

                            {!! Form::button('<i class="fas fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger delete',
                                'id' => 'delete',
                            ]) !!}
                            {!! Form::close() !!}
                        @endcan
                        <a target="_blank" class="btn btn-primary" href="{{ route('image', $image->image) }}">
                            <i class="fas fa-light fa-link"></i></a>
                    </td>

                </tr>
            @endforeach
        </table>
    </div>

    {{ $data->links('vendor.pagination.custom') }}

    <p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>
@endsection

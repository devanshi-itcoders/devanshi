@extends('layouts.app')
@section('content')
    @php
        $previousURL = url()->previous() == url()->current() ? route('pages.index') : url()->previous();
    @endphp
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __('Edit Page') }}</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ $previousURL }}"> <i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($page, ['method' => 'PATCH', 'route' => ['pages.update', $page->id]]) !!}
    {!! Form::hidden('previous_url', $previousURL) !!}

    @include('admin.pages.form', ['hasCreate' => false])

    {!! Form::close() !!}


    <p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>

@endsection

@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __('Create Configuration') }}</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary"
                    href="{{ url()->previous() == url()->current() ? route('configurations.index') : url()->previous() }}">
                    <i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</a>
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



    {!! Form::open(['route' => 'configurations.store', 'method' => 'POST']) !!}

    @include('admin.configurations.form', ['hasCreate' => true])

    {!! Form::close() !!}


    <p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>

@endsection

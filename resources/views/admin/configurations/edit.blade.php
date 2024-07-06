{{-- <x-admin-layout>
    <div class="container">
        <div class="row m-1">
            <div class="col-md-12 mt-4">

                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                {{__('Edit Configuration')}}
                                </div>
                                <div>
                                    <a class="btn btn-primary" href={{ route('configurations.index') }}>
                                {{__('Back')}}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                              @include('admin.configurations.form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-admin-layout> --}}
@extends('layouts.app')
@section('content')
    @php
        $previousURL = url()->previous() == url()->current() ? route('configurations.index') : url()->previous();
    @endphp
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{__('Edit Configuration')}}</h2>
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

{{-- 
    {!! Form::model($configurationQuery, ['method' => 'PATCH', 'route' => ['configurations.store', $configurationQuery->id]]) !!}
    {!! Form::hidden('previous_url', $previousURL) !!}

    @include('admin.configurations.form', ['hasCreate' => false])

    {!! Form::close() !!} --}}

    <div class="card-body">
        @include('admin.configurations.form')
      </div>
    <p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>

@endsection


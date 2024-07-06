@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{__('Create New Page')}}</h2>
        </div>

        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url()->previous() == url()->current() ? route('pages.index') : url()->previous() }}"> <i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</a>
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



{!! Form::open(array('route' => 'pages.store','method'=>'POST')) !!}

@include('admin.pages.form', ['hasCreate'=>true])

{!! Form::close() !!}


<p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>

@endsection

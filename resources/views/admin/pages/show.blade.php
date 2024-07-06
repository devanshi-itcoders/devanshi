@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __(' Show Page') }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary"
                    href="{{ url()->previous() == url()->current() ? route('pages.index') : url()->previous() }}"> <i
                        class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</a>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th class="w-155">{{__('Title')}}</th>
                        <td>{{ $page->title }}</td>
                    </tr>
                    <tr>
                        <th class="w-155">{{__('Slug')}}</th>
                        <td>{{ $page->slug }}</td>
                    </tr>
                    <tr>
                        <th class="w-155">{{__('Short Description')}}</th>
                        <td>{{ $page->short_description }}</td>
                    </tr>
                  
                </table>
            </div>
            <div class="col-sm-12 col-md-6">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th class="w-155">{{__('Status')}}</th>
                        <td>{{ $page->status }}</td>
                    </tr>
                    <tr>
                        <th class="w-155">{{__('Created At')}}</th>
                        <td>{{ $page->created_at }}</td>
                    </tr>
                    <tr>
                        <th class="w-155">{{__('Updated At')}}</th>
                        <td>{{ $page->updated_at }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-12 col-md-12">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th class="w-155">{{__('Description')}}</th>
                        <td>{!!$page->description!!}</td>
                    </tr>
                   
                </table>
            </div>
        </div>
    </div>

    <p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>
@endsection


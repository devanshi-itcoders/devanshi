@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __(' Show Image') }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary"
                    href="{{ url()->previous() == url()->current() ? route('images.index') : url()->previous() }}"> <i
                        class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</a>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th class="w-155">{{ __('Title') }}</th>
                        <td>{{ $image->title }}</td>
                    </tr>
                    <tr>
                        <th class="w-155">{{ __('Button Text') }}</th>
                        <td>{{ $image->btn_text }}</td>
                    </tr>
                    <tr>
                        <th class="w-155">{{ __('Button Link') }}</th>
                        <td>{{ $image->btn_link }}</td>
                    </tr>
                    <tr>
                        <th class="w-155">{{ __('Description') }}</th>
                        <td>{{ $image->description }}</td>
                    </tr>

                </table>
                <div class="row check-box">
                    <div class="col-md-6">
                        @if ($image->is_pages === 0)
                            <i class="fa fa-window-close closeBtn"></i>
                        @else
                            <i class="fa fa-check-square"></i>
                        @endif
                        <label for="">{{ __('Is Pages?') }}</label>
                    </div>
                    <div class="col-md-6">
                        @if ($image->is_home_slider === 0)
                            <i class="fa fa-window-close closeBtn"></i>
                        @else
                            <i class="fa fa-check-square"></i>
                        @endif
                        <label for="">{{ __('Is Home Slider?') }}</label>
                    </div>
                    <div class="col-md-6">
                        @if ($image->is_daily_darshan === 0)
                            <i class="fa fa-window-close closeBtn"></i>
                        @else
                            <i class="fa fa-check-square"></i>
                        @endif
                        <label for="">{{ __('Is Daily Darshan?') }}</label>
                    </div>
                    <div class="col-md-6">
                        @if ($image->is_gallery === 0)
                            <i class="fa fa-window-close closeBtn"></i>
                        @else
                            <i class="fa fa-check-square"></i>
                        @endif
                        <label for="">{{ __('Is Gallary?') }}</label>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-6">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th class="w-155">{{ __('Image') }}</th>
                        <td><img src="/files/images/{{ $image->id }}/{{ $image->image }}" alt="image"
                                width="100px"></td>
                    </tr>
                    <tr>
                        <th class="w-155">{{ __('Status') }}</th>
                        <td>{{ $image->status }}</td>
                    </tr>
                    <tr>
                        <th class="w-155">{{ __('Created At') }}</th>
                        <td>{{ $image->created_at }}</td>
                    </tr>
                    <tr>
                        <th class="w-155">{{ __('Updated At') }}</th>
                        <td>{{ $image->updated_at }}</td>
                    </tr>
                </table>


            </div>

        </div>
    </div>

    <p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>
@endsection

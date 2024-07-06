@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header-custom">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container card-menu">
        <div class="row g-4 mt-15">
            @if (Auth()->user()->can('user-list'))
                <div class="col-lg-2 col-sm-4 col-xs-6">
                    <div class="card custom-card ">
                        <div class="card-content">
                            <a class="anchor" target="__blank" href="{{ route('users.index') }}">
                                <i class="fas fa-users icon"></i>
                                <h2 class="card-title">{{__('Users')}}</h2>
                                <p class="card-description">{{ $total_users }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth()->user()->can('role-list'))
                <div class="col-lg-2 col-sm-4 col-xs-6">
                    <div class="card custom-card">
                        <div class="card-content">
                            <a class="anchor" target="__blank" href="{{ route('roles.index') }}">
                                {{-- <i class="fas fa-cog icon icon"></i> --}}
                                <i class="fa-solid fa-user-secret icon"></i>                               
                                <h2 class="card-title"> {{__('Roles')}}</h2>
                                <p class="card-description">{{ $total_roles }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-2 col-sm-4 col-xs-6">
                <div class="card custom-card">
                    <div class="card-content">
                        <a class="anchor" target="__blank" href="{{ route('pages.index') }}">
                            <i class="fa-solid fa-pager icon"></i>
                            <h2 class="card-title"> {{__('Pages')}}</h2>
                            <p class="card-description">{{ $total_pages }}</p>
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-2 col-sm-4 col-xs-6">
                <div class="card custom-card">
                    <div class="card-content">
                        <a class="anchor" target="__blank" href="{{ route('ima.index') }}">
                            <i class="fa-solid fa-pager icon"></i>
                            <h2 class="card-title"> {{__('Images')}}</h2>
                            <p class="card-description">{{ $total_pages }}</p>
                        </a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    
@endsection

@php
    $selectedYear = '';
    if (!empty(Session::get('master_filter'))) {
        $selectedYear = Session::get('master_filter');
    } else {
        $selectedYear = date('Y');
    }
@endphp
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @if (Auth()->user()->can('dashboard'))
                <a class="navbar-brand" href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
            @else
                <a class="navbar-brand" href="{{ route('users.show', Auth::id()) }}">{{ env('APP_NAME') }}</a>
            @endif

        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @guest
                    <li class="active">
                        <a href="{{ route('main') }}">
                            <i class="fas fa-home"></i>Home
                        </a>
                    </li>
                @else
                    @if (Auth()->user()->can('dashboard'))
                        <li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"><a
                                href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif

                @endguest
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li>
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="masterFilterYear">

                        <select name="year" class="form-control" id="masterFilterYear">
                            {{-- <option value="" >2023</option> --}}
                            @for ($year = date('Y'); $year >= env('YEAR', 2017); $year--)
                                <option @if ($year == $selectedYear) selected @endif value="{{ $year }}">
                                    {{ $year }}</option>
                            @endfor
                        </select>
                    </li>

                    @if (Auth()->user()->can('user-list'))
                        <li
                            class="{{ Route::currentRouteName() == 'users.index' ||
                            Route::currentRouteName() == 'users.edit' ||
                            Route::currentRouteName() == 'users.create' ||
                            Route::currentRouteName() == 'users.show'
                                ? 'active'
                                : '' }}">
                            <a class="nav-link " href="{{ route('users.index') }}">{{ __('Manage Users') }}</a>
                        </li>
                    @endif
                    @if (Auth()->user()->can('role-list'))
                        <li
                            class="{{ Route::currentRouteName() == 'roles.index' ||
                            Route::currentRouteName() == 'roles.edit' ||
                            Route::currentRouteName() == 'roles.create' ||
                            Route::currentRouteName() == 'roles.show'
                                ? 'active'
                                : '' }}">
                            <a class="nav-link" href="{{ route('roles.index') }}">{{ __('Manage Role') }}</a>
                        </li>
                    @endif
                    <li
                        class="{{ Route::currentRouteName() == 'configurations.index' ||
                        Route::currentRouteName() == 'configurations.edit' ||
                        Route::currentRouteName() == 'configurations.create' ||
                        Route::currentRouteName() == 'configurations.show'
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('configurations.index') }}">{{ __('Configuration') }}</a>
                    </li>
                    <li
                        class="{{ Route::currentRouteName() == 'pages.index' ||
                        Route::currentRouteName() == 'pages.create' ||
                        Route::currentRouteName() == 'pages.edit' ||
                        Route::currentRouteName() == 'pages.show'
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('pages.index') }}">{{ __('Pages') }}</a>
                    </li>

                    <li
                        class="{{ Route::currentRouteName() == 'images.index' ||
                        Route::currentRouteName() == 'images.create' ||
                        Route::currentRouteName() == 'images.edit' ||
                        Route::currentRouteName() == 'images.show'
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('images.index') }}">{{ __('Images') }}</a>
                    </li>
                    
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.show', Auth::id()) }}">Profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">

                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
@if ($selectedYear != date('Y'))
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <span class="label label-warning">New records will be create in new year ({{ date('Y') }})
                    only</span>
            </div>
        </div>
    </div>
@endif

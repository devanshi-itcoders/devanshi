@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary"
                    href="{{ url()->previous() == url()->current() ? route('users.index') : url()->previous() }}"> <i
                        class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</a>
            </div>
            <div class="pull-right">
                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                    data-whatever="">Change Password</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Roles</th>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-12 col-md-6">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th>Created At</th>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated At</th>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form action="{{ route('update-password') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="card-title text-center">Change password</h3>
                    </div>
                    <div class="modal-body">
                        <div class="card login-form">
                            <div class="card-body">
                                <div class="card-text">
                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="oldPassoword">Your Old password</label>
                                        <input type="text" id="oldPassoword"
                                            name="oldPassoword"class="form-control form-control-sm" required>
                                        @error('oldPassoword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword">New password</label>
                                        <input type="password" id="newPassword" name="newPassword"
                                            class="form-control form-control-sm" required>
                                        @error('newPassword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword">Confirm New password</label>
                                        <input type="password" id="confirmPassword" name="confirmPassword"
                                            class="form-control form-control-sm" required>
                                        @error('confirmPassword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ">Save Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <p class="text-center text-primary"><small>by Jerry Berrelleza</small></p>
@endsection
@if (session('error'))
    @section('script')
        <script type="text/javascript">
            $(document).ready(function() {
                $(function() {
                    $('#exampleModal').modal({
                        show: true
                    });
                });
            });
        </script>
    @endsection
@endif

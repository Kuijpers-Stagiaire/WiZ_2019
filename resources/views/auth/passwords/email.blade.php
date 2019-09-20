@extends('layouts.app')

@section('content')
<div class="bg">
    <div class="layer">
        <div class="modal-dialog Boxlogin">
            <div class="modal-content">
                <div class="modal-heading">
                    <h2 class="text-center">Reset wachtwoord</h2>
                </div>
                <hr class="hr-login" />
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">

                            <input id="email" type="email" placeholder="E-Mail adres" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group">

                            <button type="submit" class="btn btn-lg">
                                {{ __('Send Password Reset Link') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('main-content')

<div class="col-lg-4 mx-auto">

    <div class="auth-form-light text-left p-5">

        <div class="brand-logo">
            <img src="{{asset('/images/cabecera_web_eicbi-01.png')}}">
        </div>

        <h4>{{ trans('auth.wellcome') }}</h4>
        <h6 class="font-weight-light">{{ trans('auth.signInTo') }}.</h6>

        <form class="pt-3" method="POST" action="{{ route('login') }}">

            {{ csrf_field() }}

            <div class="form-group">

                <input name="email" type="email" value="{{ old('email') }}" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ trans('auth.email') }}">
                
                @if ($errors->has('email'))
                    <span class="help-block">
                            <code>{{ $errors->first('email') }}</code>
                    </span>
                @endif

            </div>

            <div class="form-group">

                <input id="password" type="password" name="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ trans('auth.pass') }}">
                
                @if ($errors->has('password'))
                    <span class="help-block">
                            <code>{{ $errors->first('password') }}</code>
                    </span>
                @endif
                
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">{{ trans('auth.signin') }}</button>
            </div>

            <div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check col-12">
                <label class="form-check-label text-muted">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input">
                    {{ trans('auth.remenber') }}
                </label>
                </div>
            </div>

            <div class="text-center mt-4 font-weight-light">
                <a href="{{ route('password.request') }}" class="auth-link text-black">{{ trans('auth.forgottenpass') }}</a>
            </div>

            <div class="text-center mt-4 font-weight-light">
                {{ trans('auth.dontcount') }} <a href="{{ route('register') }}" class="text-primary">{{ trans('auth.singuphere') }}</a>
            </div>

        </form>

    </div>

</div>

@endsection

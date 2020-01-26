@extends('users::layouts.master')

@section('main-content')

    <div class="col-lg-6 mx-auto">

        <div id="sign-up-form" class="auth-form-light text-left p-5">

            <div class="brand-logo">
                <img src="{{asset('/images/cabecera_web_eicbi-01.png')}}">
            </div>

            <h4>{{ trans('auth.signUpForm') }}</h4>
            <h6 class="font-weight-light">{{ trans('app.users.msnByCourse') }}</h6>

            @include('users::partials/forms/sign_up_form')

        </div>

    </div>

@endsection
@extends('users::layouts.master')

@section('main-content')

<div class="col-lg-6 mx-auto">

    <div class="auth-form-light text-left p-5">

        <div class="brand-logo">
            <img src="{{asset('/images/cabecera_web_eicbi-01.png')}}">
        </div>

        <h4>{{ trans('app.users.newOk') }}</h4>
        <p class="font-weight-light">{!! trans('app.users.userOkMsn') !!}</p>

        <a href="{{ route('home') }}" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">{{ trans('app.continue') }}</a>
        
    </div>

</div>

@endsection
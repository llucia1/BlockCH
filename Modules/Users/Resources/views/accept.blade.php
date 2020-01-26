@extends('layouts.app')

@section('main-content')

    <div class="col-lg-6 mx-auto">

        <div class="auth-form-light text-left p-5">

            <div class="brand-logo">
                <img src="{{asset('/images/cabecera_web_eicbi-01.png')}}">
            </div>

            <h4>{{ trans('app.resultBuy.acceptedTitle') }}</h4>
            <p class="font-weight-light">{{trans('app.resultBuy.acceptedMsn')}}</p>
            
            <div class="mt-3">
                <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="{{ route('login') }}">{{trans('app.resultBuy.acceptedBtn')}}</a>
            </div>
            
        </div>

    </div>

@endsection
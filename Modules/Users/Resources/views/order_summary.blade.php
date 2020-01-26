@extends('layouts.app')

@section('main-content')

    <div class="col-lg-6 mx-auto">

        <div class="auth-form-light text-left p-5">

            <div class="brand-logo">
                <img src="{{asset('/images/cabecera_web_eicbi-01.png')}}">
            </div>

            <h4>{{ trans('app.users.orderSummary') }}</h4>
            <h6 class="font-weight-light">{{ trans('app.users.msnOrderSummary') }}</h6>

            @include('users::partials.miscellaneous.order')

        </div>

    </div>

@endsection
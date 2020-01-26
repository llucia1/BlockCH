@extends('referrals::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item" aria-current="page">{{ trans('app.referrals.referrals') }}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.edit') }}</li>
    
@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div id="form-data" class="card-body">

                    <h4 class="card-title">{{ trans('app.edit') }} {{ trans('app.referrals.referred') }}</h4>

                    @include('referrals::partials/forms/main_form')

                </div>

            </div>
        
        </div>

    </div>

@stop

@extends('support::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.support.support') }}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.create') }} Ticket</li>

@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div id="form-support" class="card-body">

                    <h4 class="card-title">{{ trans('app.create') }} Ticket</h4>

                    @include('support::partials.forms.main_form')

                </div>

            </div>
        
        </div>

    </div>

@stop
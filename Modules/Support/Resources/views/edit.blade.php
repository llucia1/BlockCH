@extends('support::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.support.support') }}</li>
    <li class="breadcrumb-item active" aria-current="page">Ticket</li>

@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div id="form-data" class="card-body">

                    <h4 class="card-title">Ticket nº {{ $id }}</h4>

                    @include('support::partials.miscellaneous.time_line')

                </div>

            </div>
        
        </div>

    </div>

@stop
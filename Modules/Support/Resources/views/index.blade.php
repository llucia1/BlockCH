@extends('support::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.support.support') }}</li>

@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div id="table-data" class="card-body">
                    
                    <h4 class="card-title">{{ trans('app.listOf') }} Tickets</h4>
                    <p class="card-description float-left">
                        <a href="{{ route('support.create') }}" class="btn btn-primary btn-fw"><i class="mdi mdi-plus"></i>{{ trans('app.create') }}</a>
                        <button type="button" class="btn btn-gradient-dark btn-fw">{{ trans('app.support.ticketsOpen') }}</button>
                        <button type="button" class="btn btn-gradient-light btn-fw">{{ trans('app.support.ticketsClosed') }}</button>
                    </p>

                    <div class="form-group col-md-4 float-right">
                        <input v-model="searchParam" @keyup="getDataBySearchParam" name="searchParam" class="form-control rounded-0 py-2" type="search" value="" placeholder="{{ trans('app.search') }}..." id="searchParam">
                    </div>

                    <template v-if="preloader">
                        <div id="content-preloader">
                            <p>
                                <img src="{{asset('images/Eclipse-0.4s-108px.svg')}}" alt="preloader" class=""><br/>
                                <span>{{ trans('app.loadData') }}</span> 
                            </p>
                        </div>
                    </template>

                    @include('support::partials.tables.index_table')

                </div>

            </div>

        </div>

    </div>

@stop
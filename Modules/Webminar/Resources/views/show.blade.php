@extends('webminar::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.webminar.webminar') }}</li>

@stop

@section('main-content')
    
    <div class="page-header">

        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-at"></i>                 
            </span>
            {{ trans('app.webminar.webminar') }}
        </h3>

    </div>

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">
            
                @if ( count($webminars) > 0 )
                <!--Accordion wrapper-->
                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                    @foreach ($webminars as $key => $webminar)

                  <!-- Accordion card -->
                  <div class="card">

                  <div class="card-body">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingOne1">
                      <a data-toggle="collapse" data-parent="#accordionEx" href="#{{$key}}" aria-expanded="true"
                        aria-controls="{{$key}}">
                        <h5 class="mb-0">
                          {{$webminar->start}} {{$webminar->name}}
                        </h5>
                      </a>
                    </div>
                    
                    <div id="{{$key}}" class="collapse" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                      <div class="card-body">
                        <p>Fecha: {{$webminar->start}}</p>
                        <p>Hora: {{$webminar->start_hour[0].$webminar->start_hour[1]}}:{{$webminar->start_hour[2].$webminar->start_hour[3]}}</p>
                        <p><a target="_blank" class="btn btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="{{$webminar->url}}">Ir al Webminar</a></p>
                        <p>{{$webminar->text}}</p>
                      </div>
                    </div>

                    </div>

                  </div>

                  @endforeach

                </div>

                @else
                    
                    <div class="card-body">

                        <span v-else class="d-flex align-items-center purchase-popup col-12">

                            {!! trans('app.webminar.noDataShow') !!}
                           
                        </span>

                    </div>

                @endif

            </div>

        </div>

    </div>

@stop
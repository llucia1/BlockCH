@extends('mycredits::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.mycredits.mycredits') }}</li>

@stop

@section('main-content')
    <div class="row">

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
            <div class="card-body">
                <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                <h4 class="font-weight-normal mb-3">Total de créditos disponibles
                <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h1 class="mb-5">{{Auth::user()->credits}}</h1>
                <!--<h6 class="card-text">Increased by 60%</h6>-->
            </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-dark card-img-holder text-white">
            <div class="card-body">
                <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                <h4 class="font-weight-normal mb-3">Total de créditos obtenidos
                <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h1 class="mb-5">{{$totalCreditsGot}}</h1>
                <!--<h6 class="card-text">Increased by 60%</h6>-->
            </div>
            </div>
        </div>

        <div class="col-12 grid-margin stretch-card">

            <div class="card">
                
                <div id="table-data" class="card-body">

                    <h4 class="card-title">{{ trans('app.mycredits.mycredits') }}</h4>
                    
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

                    @include('mycredits::partials/tables/index_table')

                </div>

            </div>

        </div>

    </div>
@stop

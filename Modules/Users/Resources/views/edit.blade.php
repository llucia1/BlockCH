@extends('users::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item" aria-current="page">{{ trans('app.users.users') }}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.edit') }}</li>
    
@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div id="form-data" class="card-body">

                    <h4 class="card-title">{{ trans('app.edit') }} {{ trans('app.users.user') }}</h4>

                    @include('users::partials/forms/main_form')

                </div>

            </div>
        
        </div>

    </div>

    @if ( $user->roles[0]->name == 'User' || $user->roles[0]->name == 'Curtomer' )

        <div class="row">

            <div class="col-12 grid-margin stretch-card">

                <div class="card">

                    <div id="course-collection" class="card-body">

                        <h4 class="card-title">{{ trans('app.courses.courses') }}</h4>

                        <p class="card-description float-right"><button @click="showModalLinkCoruse()" class="btn btn-primary btn-fw"><i class="mdi mdi-link"></i> {{ trans('app.link') }}</button></p>

                        <template v-if="preloader">
                            <div id="content-preloader">
                                <p>
                                    <img src="{{asset('images/Eclipse-0.4s-108px.svg')}}" alt="preloader" class=""><br/>
                                    <span>{{ trans('app.loadData') }}</span> 
                                </p>
                            </div>
                        </template>

                        <input type="hidden" id="iduser" name="iduser" value="{{$user->id}}">

                        @include('users::partials.tables.courses_table')
                        @include('users::partials.modals.add_course_modal')
                    </div>

                </div>
            
            </div>

        </div>

    @endif

@stop

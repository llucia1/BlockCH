@extends('courses::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item" aria-current="page">{{ trans('app.courses.courses') }}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.courses.myCourses') }}</li>
    
@stop

@section('main-content')
    
    <div class="page-header">

        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-school"></i>                 
            </span>
            {{ trans('app.courses.myCourses') }}
        </h3>

    </div>

    <div class="row">

        @foreach ($courses as $course)

            <div class="col-md-3 grid-margin stretch-card">

                <div class="card">

                    <div style="padding:0;" class="card-header">

                        <img width="100%" src="https://cnnespanol2.files.wordpress.com/2018/09/180619225021-cnnmoney-bitcoin-full-169.jpg?quality=100&strip=info&w=1024&strip=info" />

                    </div>

                    <div class="card-body">

                        <h4 class="card-title"><a href="{{ route('courses.showcourse',$course->course->id) }}">{{ $course->course->name }}</a></h4>
                        <p class="card-description">
                            {{$course->course->short_description}}
                        </p>
                    </div>

                </div>

            </div>

        @endforeach
        
    </div>

@stop

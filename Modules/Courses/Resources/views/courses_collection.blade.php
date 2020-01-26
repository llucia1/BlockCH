@extends('courses::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item" aria-current="page">{{ trans('app.courses.courses') }}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.listOf') }} {{ trans('app.courses.courses') }}</li>
    
@stop

@section('main-content')
    
    <div class="page-header">

        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-school"></i>                 
            </span>
            {{ trans('app.listOf') }} {{ trans('app.courses.courses') }}
        </h3>

    </div>

    <div class="row">

        @foreach ($courses as $course)

            <div class="col-3 grid-margin stretch-card">

                <div class="card">

                    <div style="padding:0;" class="card-header">

                        <img width="100%" src="https://cnnespanol2.files.wordpress.com/2018/09/180619225021-cnnmoney-bitcoin-full-169.jpg?quality=100&strip=info&w=1024&strip=info" />

                    </div>

                    <div class="card-body">

                        <h4 class="card-title"><a href="{{ route('courses.showcourse',$course->id) }}">{{ $course->name }}</a></h4>
                        <p class="card-description">
                            {{$course->short_description}}
                        </p>
                        <h5><strong>{{$course->amount}}€</strong></h5>

                        <form action="{{ route('newbuysotre') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="course_id" id="course_id" value="{{$course->id}}">
                            <input type="hidden" name="name" id="name" value="{{$user->name}}">
                            <input type="hidden" name="first_name" id="first_name" value="{{$user->first_name}}">
                            <input type="hidden" name="last_name" id="last_name" value="{{$user->last_name}}">
                            <input type="hidden" name="email" id="email" value="{{$user->email}}">
                            <input type="hidden" name="password" id="password" value="{{$user->password}}">
                            <input type="hidden" name="country" id="country" value="{{$user->country}}">
                            <input type="hidden" name="city" id="city" value="{{$user->city}}">
                            <input type="hidden" name="address" id="address" value="{{$user->address}}">
                            <input type="hidden" name="zip" id="zip" value="{{$user->zip}}">
                            <input type="hidden" name="telephone" id="telephone" value="{{$user->telephone}}">
                            <input type="hidden" name="prefix" id="prefix" value="{{$user->prefix}}">
                            
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">{{ trans('app.buy') }}</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        @endforeach
        
    </div>

@stop

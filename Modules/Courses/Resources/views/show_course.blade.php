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
            {{$course->name}}
        </h3>

    </div>

    <div class="row">

    @foreach ($course->chapters as $key => $chapter)

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div style="padding:16px;" class="card-body">

                    <h4 class="card-title"><a href="#"  data-toggle="modal" data-target="#modulo{{$key + 1}}">Módulo {{$key + 1}}</a></h4>
                    <p style="margin-bottom:0;" class="card-description">
                        {{$chapter->name}}
                    </p>

                </div>

            </div>

        </div>

        <!-- The Modal -->
        <div class="modal" id="modulo{{$key + 1}}">
            <div style="max-width: 700px;" class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Módulo {{$key + 1}} | {{$chapter->name}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    @isset($chapter->video)
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$chapter->video}}?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    @endisset
                    
                    <div style="border: 1px solid #727272;" class="alert alert-secondary">
                        {{ trans('app.courses.chapterAttachedFile') }}<br/>
                        <a href="{{asset('/documents/'.$chapter->attached)}}" target="_blank" class="alert-link">{{$chapter->name}}.pdf</a>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>

                </div>
            </div>
        </div>

    @endforeach
        
@stop

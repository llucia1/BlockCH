@extends('videos::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item" aria-current="page">{{ trans('app.videos.videos') }}</li>
    
@stop

@section('main-content')

    <div class="page-header">

        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-video"></i>                 
            </span>
            {{ trans('app.videos.videos') }}
        </h3>

    </div>

    <div class="row">

            @foreach ($videos as $video)

                <div class="col-4 grid-margin stretch-card">

                    <div class="card">

                        <div style="padding:0;" class="card-header">

                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$video->code}}?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                        </div>

                        <div class="card-body">

                            <h4 class="card-title"><a href="#" data-toggle="modal" data-target="#video{{$video->id}}">{{ $video->name }}</a></h4>
                        
                        </div>

                    </div>

                </div>

                <!-- The Modal -->
                <div class="modal" id="video{{$video->id}}">

                    <div style="max-width: 700px;" class="modal-dialog">

                        <div class="modal-content">
                               
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">{{$video->name}}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$video->code}}?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

    </div>

@stop
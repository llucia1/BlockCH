@extends('courses::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item" aria-current="page">{{ trans('app.courses.courses') }}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('app.edit') }}</li>
    
@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div id="form-data" class="card-body">

                    <h4 class="card-title">{{ trans('app.edit') }} {{ trans('app.courses.course') }}</h4>

                    @include('courses::partials/forms/main_form')

                </div>

            </div>
        
        </div>

        <div class="col-12 grid-margin stretch-card">

            <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">

            <div id="chapters" class="card">
                @include('courses::partials.tables.chapters_table')
                @include('courses::partials.modals.chapter_modal')
            </div>
            
        </div>

    </div>

@stop

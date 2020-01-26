@extends('blockchain::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item" aria-current="page">Blockchain</li>
    <li class="breadcrumb-item active" aria-current="page">Bloque</li>
    
@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">Block</h4>

                    <p class="card-description">

                        {{$block->data}}

                    </p>

                </div>

            </div>

        </div>

    </div>

@stop
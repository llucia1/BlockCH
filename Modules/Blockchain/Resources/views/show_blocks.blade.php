@extends('blockchain::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item" aria-current="page">Blockchain</li>
    <li class="breadcrumb-item active" aria-current="page">Chain</li>
    
@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div id="table-data" class="card-body">

                    <h4 class="card-title">Blocks</h4>

                    @include('blockchain::partials.tables.blocks_table')

                </div>

            </div>

        </div>

    </div>

@stop
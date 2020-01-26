@extends('blockchain::layouts.master')

@section('breadcrumb') 

    <li class="breadcrumb-item active" aria-current="page">Blockchain</li>

@stop

@section('main-content')

    <div class="row">

        <div class="col-12 grid-margin stretch-card">

            <div class="card">

                <div id="table-data" class="card-body">

                    <h4 class="card-title">Chains</h4>

                    <p class="card-description float-left">
                        <a href="{{ route('blockchain.create') }}" class="btn btn-primary btn-fw"><i class="mdi mdi-plus"></i>Nuevo bloque</a>
                    </p>

                    @include('blockchain::partials.tables.index_table')

                </div>

            </div>

        </div>

    </div>

@stop
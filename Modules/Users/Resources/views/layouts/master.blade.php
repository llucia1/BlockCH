@extends('layouts.app')

@section('meta') 

<meta name="module-url" content="api/{{ Request::segment(1) }}">
<meta name="method" content="{{ Request::segment(2) }}">

@stop

@section('js')

    <script src="{{asset('/js/users.js')}}"></script>
    {{-- template for the modal component --}}
    <script type="text/x-template" id="modal-template">

        <transition name="modal">

            <div class="modal-mask">

                <div class="modal-wrapper">

                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">default header</slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">default body</slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                                <button class="modal-default-button btn btn-block btn-primary btn-lg" @click="$emit('close')">OK</button>
                            </slot>
                        </div>

                    </div>

                </div>

            </div>

        </transition>

    </script>
    
@stop


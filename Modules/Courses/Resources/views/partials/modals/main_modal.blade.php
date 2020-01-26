<template v-if="showModal">

    <modal v-if="showModal" @close="showModal = false">
           
            <h3 v-if="errorCode != null" slot="header">Error</h3>
    
            @if (Request::segment(2) == 'create')
    
                <h3 v-else slot="header">{{ trans('app.courses.newOk') }}</h3>
    
            @elseif (Request::segment(2) == 'edit')
    
                <h3 v-else slot="header">{{ trans('app.courses.editOk') }}</h3>
    
            @endif
    
        <p slot="body">
    
            <span v-if="errorCode != null">
                <strong v-if="errorCode.data.errors.name != undefined" class="danger" >@{{errorCode.data.errors.name[0]}}</strong>
            </span>
            
            @if (Request::segment(2) == 'create')
    
                <span v-else>
                    
                    <a href="{{ route('courses.create') }}" class="modal-default-button btn btn-block btn-primary btn-lg">
                        {{ trans('app.courses.modalNew') }}
                    </a>
    
                    <a :href="urlEdit" class="modal-default-button btn btn-block btn-primary btn-lg">
                        {{ trans('app.courses.modalEdit') }}
                    </a>
    
                    <a href="{{ route('courses') }}" class="modal-default-button btn btn-block btn-primary btn-lg">
                        {{ trans('app.returnList') }}
                    </a>
    
                </span>
    
            @elseif (Request::segment(2) == 'edit')
                <span v-else>
                    {{ trans('app.dataUpdatedSuccessfully') }}
                </span>
            @endif
            
        </p>
    
        @if (Request::segment(2) == 'create')
            <span v-if="errorCode == null" slot="footer"></span>
        @endif
    
    </modal>
    
</template>
    
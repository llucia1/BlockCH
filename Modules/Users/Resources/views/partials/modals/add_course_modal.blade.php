<template v-if="showModal">

<modal v-if="showModal" @close="showModal = false">
       
    <h3 slot="header">{{ trans('app.courses.selectCourse') }}</h3>

    @include('users::partials.forms.courses_select_form')
    
    <button slot="footer" style="width: 100%;" @click="setData" type="button" class="modal-default-button btn  btn-primary btn-lg"><i aria-hidden="true" class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>

    <button slot="footer" style="width: 100%;" class="modal-default-button btn btn-danger btn-lg btn-lg" @click="showModal = false"><i class="fa fa-times" aria-hidden="true"></i> {{ trans('app.close') }}</button>

            
</modal>

</template>

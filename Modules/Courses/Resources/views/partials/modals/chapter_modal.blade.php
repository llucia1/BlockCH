<template v-if="showModal">

    <modal v-if="showModal" @close="showModal = false">
            
        <h3 slot="header">{{ trans('app.courses.newChapter') }}</h3>

        @include('courses::partials.forms.chapter_form')
        
        <button style="width: 100%;" slot="footer" @click="setData" type="button" class="btn btn-success btn-fw"><i aria-hidden="true" class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>

        <button style="width: 100%;" slot="footer"  class="btn btn-danger btn-fw" @click="showModal = false"><i class="fa fa-times" aria-hidden="true"></i> {{ trans('app.close') }}</button>
                
    </modal>

</template>
        
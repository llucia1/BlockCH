<form ref="formMain" class="forms-sample">

    <input type="hidden" name="item_id" id="item_id" value="{{ $course->id ?? 0 }}">

<div class="form-group" :class="{'has-error': errors.has('name') }">
    <label>{{ trans('app.courses.course') }}</label>
    <input class="form-control" v-validate="'required'" data-vv-as="{{ trans('app.courses.course') }}" v-model="formFields.name" name="name" id="name" type="text">
    <span class="alert-danger" v-text="errors.first('name')"></span>
</div>

<div class="form-group" :class="{'has-error': errors.has('amount') }">
    <label>{{ trans('app.amount') }}</label>
    <input class="form-control" v-validate="'required|decimal:2'" data-vv-as="{{ trans('app.amount') }}" v-model="formFields.amount" name="amount" id="amount" type="text">
    <span class="alert-danger" v-text="errors.first('amount')"></span>
</div>

<hr/>

<div class="form-group">
    <label>{{ trans('app.courses.chaptertext') }}</label>
    <textarea class="form-control" rows="5" name="short_description" id="short_description" v-model="formFields.short_description"></textarea>
</div>

<hr/>

<div v-if="method != 'show'" class="form-group">

    <template>
        <a v-if="method == 'edit'" href="{{ route('courses') }}" type="button" class="btn btn-primary btn-fw">
            <i class="mdi mdi-keyboard-backspace"></i> {{ trans('app.back') }}
        </a>

        <button v-if="preloader" type="button" class="btn btn-default m-b-10 m-l-5"><i class="mdi mdi-autorenew " aria-hidden="true"></i> {{ trans('app.savingData') }}</button>
        <button v-else @click="setData" type="button" class="btn btn-success btn-fw">
            <i class="mdi mdi-content-save"></i> {{ trans('app.save') }}
        </button>
    </template>
    
</div>

</form>

@include('courses::partials/modals/main_modal')
<form ref="form-support" class="forms-sample">

    <input type="hidden" name="support_id" id="support_id" value="{{ $support->id ?? 0 }}">

    <div class="form-group" :class="{'has-error': errors.has('subject') }">
        <label>{{ trans('app.support.subject') }}</label>
        <input class="form-control" v-validate="'required'" data-vv-as="{{ trans('app.support.subject') }}" v-model="subject" name="subject" id="subject" type="text">
        <span class="alert-danger" v-text="errors.first('subject')"></span>
    </div>

    <div class="form-group">
        <label>{{ trans('app.support.text') }}</label>
        <vue-editor name="text" id="text" v-model="editor"></vue-editor>
    </div>

    <div class="form-group">

        <button v-if="preloader" type="button" class="btn btn-default m-b-10 m-l-5"><i class="mdi mdi-autorenew " aria-hidden="true"></i> {{ trans('app.savingData') }}</button>
        <button v-else @click="setData" type="button" class="btn btn-success btn-fw">
            <i class="mdi mdi-content-save"></i> {{ trans('app.save') }}
        </button>

    </div>

</form>
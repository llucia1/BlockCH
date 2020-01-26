<form ref="formMain" class="forms-sample">

        <input type="hidden" name="item_id" id="item_id" value="{{ $referral->id ?? 0 }}">

    <div class="form-group" :class="{'has-error': errors.has('url') }">
        <label>{{ trans('app.referrals.referred') }}</label>
        <input class="form-control" v-validate="'required|url: require_protocol: true'" data-vv-as="{{ trans('app.referrals.referred') }}" v-model="formFields.url" name="url" id="url" type="text">
        <span class="alert-danger" v-text="errors.first('url')"></span>
    </div>

    <hr/>
    <div v-if="method != 'show'" class="form-group">

        <template>
            <button v-if="method == 'edit'" type="button" class="btn btn-primary btn-fw">
                <i class="mdi mdi-keyboard-backspace"></i> {{ trans('app.back') }}
            </button>

            <button v-if="preloader" type="button" class="btn btn-default m-b-10 m-l-5"><i class="mdi mdi-autorenew " aria-hidden="true"></i> {{ trans('app.savingData') }}</button>
            <button v-else @click="setData" type="button" class="btn btn-success btn-fw">
                <i class="mdi mdi-content-save"></i> {{ trans('app.save') }}
            </button>
        </template>
        
    </div>

</form>

@include('referrals::partials/modals/main_modal')
<form style="margin-top: 35px;" ref="signUpForm" class="forms-sample">

    @isset($courseId)
        <input  type="hidden" name="course_id"  id="course_id" value="{{$courseId}}" />
    @endisset
    
    <input  type="hidden" name="referral"  id="referral" v-model="referral" value="{{$referral}}" />
    
    <div class="form-group" :class="{'has-error': errors.has('name') }">
        <label>{{ trans('app.user') }}</label>
        <input class="form-control" v-validate="'required|alpha_spaces'" data-vv-as="{{ trans('app.user') }}" v-model="formFields.name" name="name" id="name" type="text">
        <span class="alert-danger" v-text="errors.first('name')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('first_name') }">
        <label>{{ trans('app.firstName') }}</label>
        <input class="form-control" v-validate="'required|alpha_spaces'" data-vv-as="{{ trans('app.firstName') }}" v-model="formFields.first_name" name="first_name" id="first_name" type="text">
        <span class="alert-danger" v-text="errors.first('first_name')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('last_name') }">
        <label>{{ trans('app.lastName') }}</label>
        <input class="form-control" v-validate="'required|alpha_spaces'" data-vv-as="{{ trans('app.lastName') }}" v-model="formFields.last_name" name="last_name" id="last_name" type="text">
        <span class="alert-danger" v-text="errors.first('last_name')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('email') }">
        <label>Email</label>
        <input class="form-control form-control-lg" v-validate="'required|email'" data-vv-as="Email" v-model="formFields.email" name="email" id="email" type="text">
        <span class="alert-danger" v-text="errors.first('email')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('password') }">
        <label>{{ trans('app.password') }}</label>
        <input ref="pw_confirm" name="password" id="password" type="password" data-vv-as="{{ trans('app.password') }}" v-validate="'required|min:8|confirmed:pw_confirm'" class="form-control form-control-lg">
        <span class="alert-danger" v-text="errors.first('password')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('rpassword') }">
        <label>{{ trans('app.repeat') }} {{ trans('app.password') }}</label>
        <input name="rpassword" type="password" data-vv-as="{{ trans('app.repeat') }} {{ trans('app.password') }}" v-validate="'required|min:8|confirmed:pw_confirm'" class="form-control form-control-lg">
        <span class="alert-danger" v-text="errors.first('rpassword')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('country') }">
        <label>{{ trans('app.country') }}</label>
        <select name="country" data-vv-as="{{ trans('app.country') }}" v-model="formFields.country" class="form-control form-control-lg" id="country">
            <option value=""></option>
            @foreach($countries as $country)
                    <option value="{{ $country->name }}">{{ $country->name }}</option>
            @endforeach
        </select>
        <span class="alert-danger" v-text="errors.first('video_category_id')"></span>
    </div>

    <div class="form-group">
        <label>{{ trans('app.city') }}</label>
        <input class="form-control form-control-lg" data-vv-as="{{ trans('app.city') }}" v-model="formFields.city" name="city" id="city" type="text">
    </div>

    <div class="form-group" :class="{'has-error': errors.has('address') }">
        <label>{{ trans('app.address') }}</label>
        <input class="form-control form-control-lg" data-vv-as="{{ trans('app.address') }}" v-model="formFields.address" name="address" id="address" type="text">
        <span class="alert-danger" v-text="errors.first('address')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('zip') }">
        <label>{{ trans('app.zip') }}</label>
        <input class="form-control form-control-lg" data-vv-as="{{ trans('app.zip') }}" v-mask="{mask: '99999', autoUnmask: true}" v-validate="'numeric|min:5|max:5'" v-model="formFields.zip" name="zip" id="zip" type="text">
        <span class="alert-danger" v-text="errors.first('zip')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('prefix') }">
        <label>{{ trans('app.prefix') }}</label>
        <input class="form-control form-control-lg" data-vv-as="{{ trans('app.prefix') }}" v-validate="'numeric'" v-model="formFields.prefix" name="prefix" id="prefix" type="text">
        <span class="alert-danger" v-text="errors.first('prefix')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('telephone') }">
        <label>{{ trans('app.telephone') }}</label>
        <input class="form-control form-control-lg" v-mask="{mask: '999 999 999', autoUnmask: true}" v-validate="'numeric|min:9|max:9'" data-vv-as="{{ trans('app.telephone') }}" v-model="formFields.telephone" name="telephone" id="telephone" type="text">
        <span class="alert-danger" v-text="errors.first('telephone')"></span>
    </div>
    
    <template v-if="preloader">
        <div class="mt-3">
            <button type="button" class="btn btn-block btn-gradient-light btn-lg font-weight-medium auth-form-btn"><i class="mdi mdi-reload"></i>{{ trans('app.loadData') }}</button>
        </div>
    </template>

    <template v-else>
        <div class="mt-3">
            @isset($courseId)
                <button @click="setData" type="button" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">{{ trans('app.continue') }}</button>
            @else
                <button @click="setRegister" type="button" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">{{ trans('app.continue') }}</button>
            @endisset
        </div>
    </template>

    <template v-if="errorCode != null">
        <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> @{{errorCode.data.errors.email[0]}}
        </div>
    </template>
    
</form>
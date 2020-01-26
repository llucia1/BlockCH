<form ref="formMain" class="forms-sample">

    <input type="hidden" name="item_id" id="item_id" value="{{ $user->id ?? 0 }}">

    <div class="form-group" :class="{'has-error': errors.has('name') }">
        <label>{{ trans('app.user') }}</label>
        <input class="form-control" v-validate="'required'" data-vv-as="{{ trans('app.user') }}" v-model="formFields.name" name="name" id="name" type="text">
        <span class="alert-danger" v-text="errors.first('name')"></span>
    </div>

    @if (Auth::User()->isA('User'))

    <div class="form-group">
        <label>{{ trans('app.users.firstName') }}</label>
        <input class="form-control" v-model="formFields.first_name" name="first_name" id="first_name" type="text">
    </div>

    <div class="form-group" :class="{'has-error': errors.has('last_name') }">
        <label>{{ trans('app.users.lastName') }}</label>
        <input class="form-control" data-vv-as="{{ trans('app.users.lastName') }}" v-model="formFields.last_name" name="last_name" id="last_name" type="text">
        <span class="alert-danger" v-text="errors.first('last_name')"></span>
    </div>

    @endif

    <div class="form-group" :class="{'has-error': errors.has('email') }">
        <label>{{ trans('app.email') }}</label>
        <input v-validate="'required|email'" data-vv-as="{{ trans('app.email') }}" class="form-control" v-model="formFields.email" name="email" id="email" type="text">
        <span class="alert-danger" v-text="errors.first('email')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('password') }">
        <label >{{ trans('app.password') }}</label>
        <div class="input-group">
            <input v-if="method == 'create'" v-validate="'required|min:8'" data-vv-as="{{ trans('app.password') }}" v-model="password" class="form-control" name="password" id="password" type="password">
            <input v-else v-validate="'min:8'" data-vv-as="{{ trans('app.password') }}" v-model="password" class="form-control" name="password" id="password" type="password">
            <button @click="togglePass" type="button" class="btn btn-inverse-dark btn-icon">
                <i id="pass-ico" class="mdi mdi-eye"></i>
            </button>
        </div>
        <span class="alert-danger" v-text="errors.first('password')"></span>
    </div>

    <div class="form-group">
        <button @click="generatePass" type="button" class="btn btn-dark btn-fw">{{ trans('app.generatePassword') }}</button>
    </div>

    @if (Auth::User()->isA('Admin'))

    <div class="form-group" :class="{'has-error': errors.has('rol') }">
        <label>{{ trans('app.roles.rol') }}</label>
        <select name="rol" data-vv-as="{{ trans('app.roles.rol') }}" v-validate="'required'" v-model="rol" class="form-control" id="video_category_id">
            <option value=""></option>
            @foreach(\App\Helpers\App::ROLES as $rol)
                    <option value="{{ $rol }}">{{ $rol }}</option>
            @endforeach
        </select>
        <span class="alert-danger" v-text="errors.first('video_category_id')"></span>
    </div>

    @endif

    @if (Auth::User()->isA('Admin'))

    <template v-if="method == 'edit'">
        <div class="form-group">
            <label>{{ trans('app.state') }}</label>
            <select name="deleted_at" v-model="formFields.deleted_at" class="form-control" id="deleted_at">
                <option :value="null">{{ trans('app.able') }}</option>
                <option :value="!null">{{ trans('app.disable') }}</option>
            </select>
        </div>
    </template>

    @endif

    @include('users::partials.forms.user_data_form')

    <hr/>
    <div v-if="method != 'show'" class="form-group">

        <template>
            
            @if (Auth::User()->isA('Admin'))

            <button v-if="method == 'edit'" type="button" class="btn btn-primary btn-fw">
                <i class="mdi mdi-keyboard-backspace"></i> {{ trans('app.back') }}
            </button>

            @endif

            <button v-if="preloader" type="button" class="btn btn-default m-b-10 m-l-5"><i class="mdi mdi-autorenew " aria-hidden="true"></i> {{ trans('app.savingData') }}</button>
            <button v-else @click="setData" type="button" class="btn btn-success btn-fw">
                <i class="mdi mdi-content-save"></i> {{ trans('app.save') }}
            </button>
        </template>
        
    </div>

</form>

@include('users::partials/modals/main_modal')
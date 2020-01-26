<template v-if="rol == 'Customer' || rol == 'User' || method == 'edit'">

    <h4 class="card-title">{{ trans('app.users.userData') }}</h4>

    <div class="form-group" :class="{'has-error': errors.has('country') }">
        <label>{{ trans('app.country') }}</label>
        <select @change="getPrefix" name="country" data-vv-as="{{ trans('app.country') }}" v-model="formFields.country" class="form-control" id="country">
            <option value=""></option>
            @foreach($countries as $country)

                    @isset( $user )
                        <option @if( $user->country == $country->name ) selected @endif value="{{ $country->name }}">{{ $country->name }}</option>
                    @else
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endisset

            @endforeach
        </select>
        <span class="alert-danger" v-text="errors.first('video_category_id')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('city') }">
        <label>{{ trans('app.city') }}</label>
        <input class="form-control" data-vv-as="{{ trans('app.city') }}" v-model="formFields.city" name="city" id="city" type="text">
        <span class="alert-danger" v-text="errors.first('city')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('address') }">
        <label>{{ trans('app.address') }}</label>
        <input class="form-control" data-vv-as="{{ trans('app.address') }}" v-model="formFields.address" name="address" id="address" type="text">
        <span class="alert-danger" v-text="errors.first('address')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('prefix') }">
        <label>{{ trans('app.prefix') }}</label>
        <input class="form-control" data-vv-as="{{ trans('app.prefix') }}" v-model="formFields.prefix" name="prefix" id="prefix" type="text">
        <span class="alert-danger" v-text="errors.first('prefix')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('telephone') }">
        <label>{{ trans('app.telephone') }}</label>
        <input class="form-control" v-mask="{mask: '999 999 999', autoUnmask: true}" v-validate="'numeric|min:9|max:9'" data-vv-as="{{ trans('app.telephone') }}" v-model="formFields.telephone" name="telephone" id="telephone" type="text">
        <span class="alert-danger" v-text="errors.first('telephone')"></span>
    </div>

</template>

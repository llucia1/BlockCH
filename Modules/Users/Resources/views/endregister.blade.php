@extends('layouts.app')

@section('main-content')

    <div class="col-lg-6 mx-auto">

        <div class="auth-form-light text-left p-5">

            <div class="brand-logo">
                <img src="{{asset('/images/logo.svg')}}">
            </div>

            <h4>{{ trans('auth.wellcome') }}</h4>
            <h6 class="font-weight-light">{{ trans('app.endYourRegister') }}.</h6>

            <form class="pt-3" method="POST" action="{{ route('login') }}">

                {{ csrf_field() }}

                <div class="form-group">
                    <label>{{ trans('app.name') }}</label>
                    <input name="name" type="name" value="{{ old('name') }}" class="form-control form-control-lg">
                </div>

                <div class="form-group">
                    <label>{{ trans('app.password') }}</label>
                    <input name="password" type="password" value="{{ old('password') }}" class="form-control form-control-lg">
                </div>

                <div class="form-group">
                    <label>{{ trans('app.repeat') }} {{ trans('app.password') }}</label>
                    <input name="rpassword" type="password" value="{{ old('rpassword') }}" class="form-control form-control-lg">
                </div>

                <div class="form-group" :class="{'has-error': errors.has('card_number') }">
                    <label>{{ trans('app.cardNumber') }}</label>
                    <input class="form-control form-control-lg" v-mask="{mask: '9999 9999 9999 9999', autoUnmask: true}" v-validate="'numeric|min:16|max:16'" data-vv-as="{{ trans('app.cardNumber') }}" v-model="formFields.card_number" name="card_number" id="card_number" type="text">
                    <span class="alert-danger" v-text="errors.first('card_number')"></span>
                </div>

                <div class="form-group" :class="{'has-error': errors.has('country') }">
                    <label>{{ trans('app.country') }}</label>
                    <select @change="getPrefix" name="country" data-vv-as="{{ trans('app.country') }}" v-model="formFields.country" class="form-control form-control-lg" id="country">
                        <option value=""></option>
                        @foreach($countries as $country)
                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    <span class="alert-danger" v-text="errors.first('video_category_id')"></span>
                </div>

                <div class="form-group" :class="{'has-error': errors.has('city') }">
                    <label>{{ trans('app.city') }}</label>
                    <input class="form-control form-control-lg" data-vv-as="{{ trans('app.city') }}" v-model="formFields.city" name="city" id="city" type="text">
                    <span class="alert-danger" v-text="errors.first('city')"></span>
                </div>
            
                <div class="form-group" :class="{'has-error': errors.has('address') }">
                    <label>{{ trans('app.address') }}</label>
                    <input class="form-control form-control-lg" data-vv-as="{{ trans('app.address') }}" v-model="formFields.address" name="address" id="address" type="text">
                    <span class="alert-danger" v-text="errors.first('address')"></span>
                </div>
            
                <div class="form-group" :class="{'has-error': errors.has('prefix') }">
                    <label>{{ trans('app.prefix') }}</label>
                    <input class="form-control form-control-lg" data-vv-as="{{ trans('app.prefix') }}" v-model="formFields.prefix" name="prefix" id="prefix" type="text">
                    <span class="alert-danger" v-text="errors.first('prefix')"></span>
                </div>
            
                <div class="form-group" :class="{'has-error': errors.has('telephone') }">
                    <label>{{ trans('app.telephone') }}</label>
                    <input class="form-control form-control-lg" v-mask="{mask: '999 999 999', autoUnmask: true}" v-validate="'numeric|min:9|max:9'" data-vv-as="{{ trans('app.telephone') }}" v-model="formFields.telephone" name="telephone" id="telephone" type="text">
                    <span class="alert-danger" v-text="errors.first('telephone')"></span>
                </div>

            </form>

        </div>

    </div>

@endsection
<form ref="formMain" class="forms-sample">

    <input type="hidden" name="item_id" id="item_id" value="{{ $video->id ?? 0 }}">

    <div class="form-group" :class="{'has-error': errors.has('video_category_id') }">
        <label>{{ trans('app.category') }}</label>
        <select name="video_category_id" data-vv-as="{{ trans('app.category') }}" v-validate="'required'" v-model="formFields.video_category_id" class="form-control" id="video_category_id">
            <option value=""></option>
            @foreach ($videosCategories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
            
        </select>
        <span class="alert-danger" v-text="errors.first('video_category_id')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('name') }">
        <label>{{ trans('app.name') }}</label>
        <input class="form-control" v-validate="'required'" data-vv-as="{{ trans('app.name') }}" v-model="formFields.name" name="name" id="name" type="text">
        <span class="alert-danger" v-text="errors.first('name')"></span>
    </div>

    <div class="form-group" :class="{'has-error': errors.has('code') }">
        <label>{{ trans('app.videos.code') }}</label>
        <input class="form-control" v-validate="'required'" data-vv-as="{{ trans('app.videos.code') }}" v-model="formFields.code" name="code" id="name" type="text">
        <span class="alert-danger" v-text="errors.first('code')"></span>
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

@include('videos::partials.modals.main_modal')
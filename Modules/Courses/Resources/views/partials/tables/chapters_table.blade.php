<template v-if="preloader">
    <div id="content-preloader">
        <p>
            <img src="{{asset('images/Eclipse-0.4s-108px.svg')}}" alt="preloader" class=""><br/>
            <span>{{ trans('app.loadData') }}</span> 
        </p>
    </div>
</template>
    
<section class="p-3">

    <h4>{{ trans('app.courses.chaptersList') }}</h4>
    <hr/>

    <div id="table-chapters" class="card-body">
        
        <p class="card-description">
            <a @click="showForm(0)" class="btn btn-primary btn-fw"><i class="fa fa-plus"></i> {{ trans('app.create') }}</a>
        </p>

        <template v-if="!preloader">

            <div v-if="chaptersData.length > 0" class="table">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('app.courses.chapter') }}</th>
                            <th>{{ trans('app.createdAt') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="row in chaptersData">
                            <th scope="row" v-text="row.id"></th>
                            <td v-text="row.name"></td>
                            <td v-text="row.created_at"></td>
                            <td style="text-align: center;" class="color-primary"><button @click="showForm(row.id)" type="button" class="btn btn-default m-b-10">{{ trans('app.edit') }}</button></td>
                            <td style="text-align: center;" class="color-primary"><button @click="deleteData(row.id)" type="button" class="btn btn-default m-b-10">{{ trans('app.delete') }}</button></td>
                        </tr>

                    </tbody>

                </table>

            </div>

            <div v-else class="alert alert-secondary">

                {!! trans('app.noDataShow') !!}
                
            </div>

        </template>
    
    </div>
        
</section>
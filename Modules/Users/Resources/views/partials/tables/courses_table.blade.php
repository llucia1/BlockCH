<template v-if="!preloader">

    <div v-if="courses.length > 0">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>#</th>
                    <th>Curso</th>
                    <th>Alta</th>
                    <th></th>
                </tr>

            </thead>

            <tbody>
                            
                <tr v-for="course in courses">
                    <th scope="row" v-text="course.id"></th>
                    <th v-text="course.course.name"></th>
                    <th v-text="course.created_at"></th>
                    <th>
                        <button type="button" class="btn btn-danger btn-fw" @click="deleteCoruse(course.id)">{{ trans('app.delete') }}</button>
                    </th>
                </tr>

            </tbody>

        </table>

    </div>

    <div v-else class="d-flex align-items-center purchase-popup col-12">

        {!! trans('app.noDataShow') !!}
        
    </div>

</template>
<form ref="formCoursesSelect" slot="body">
    <div class="form-group">
        <label for="exampleSelectGender">{{ trans('app.courses.courses') }}</label>
        <select v-model="courseSelected" class="form-control" id="exampleSelectGender">
            <option v-for="courseSelect in optSelectCourses" v-text="courseSelect.name" :value="courseSelect.id"></option>
        </select>
    </div>
</form>
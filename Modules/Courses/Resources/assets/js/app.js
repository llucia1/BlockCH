import VeeValidate from 'vee-validate';

const VueValidationEs = require('vee-validate/dist/locale/es');

const config = {
    locale: 'es',
    events: 'blur',
    dictionary: {
        es: VueValidationEs

    }
};
const SITE_URL = document.head.querySelector('meta[name="site-url"]').content;
const MODULE_URL = document.head.querySelector('meta[name="module-url"]').content;
const METHOD = document.head.querySelector('meta[name="method"]').content;
const COURSE_ID = document.querySelector('#course_id').value;

Vue.use(VeeValidate,config);

Vue.component('modal', {template: '#modal-template'});
//text editor for vue
import { VueEditor } from "vue2-editor";

/**
 * ---componente para el Listado de practicas---
 * @param preloader -- booleano que muestra u oculta el preload
 * @param chaptersData -- almacena el listado de Prácticas del candidato
 * @param errorCode -- recolecta errores
 * @param showModal -- booleano que muestra y oculta el modal
 * @param formFields -- Datos del formulario
 * @param selectedFile -- contien la img seleccionada
 * @param editor -- almacena el contenido del editor de texto

*/
if (document.querySelector('#chapters')) {

    var chapters = new Vue({

        el: '#chapters',
        components: {VueEditor},
        data: {

            preloader: false,
            chaptersData: [],
            chapterData: [],
            errorCode: null,
            erroValidate: false,
            showModal: false,
            formFields: [],
            selectedFile: null,
            editor: null,
        },
        methods: {

            setData : function() {

                //Url, consulta
                let url = SITE_URL + '/' + MODULE_URL + '/chapter/store/'+ COURSE_ID;
                this.erroValidate = false;
                this.errorCode = null;
                //si id > 0 sobreescribimos url
                if( this.formFields.course_id > 0 )
                    url = SITE_URL + '/' + MODULE_URL + '/chapter/update/'+ this.formFields.id;
                //capturamos todos los campos de formulario
                const formData = new FormData(this.$refs['formChapter']);
                const data = {};
                
                for (let [key, val] of formData.entries()) {

                    Object.assign(data, { [key]: val })
                }
                //pasamos manualmente el texto del editor
                Object.assign(data, { 'text': this.editor });
                console.log(data);
                //validamos el formulario
               this.$validator.validateAll().then(() => {

                   if ( !this.errors.any() ) {
                       //mostramos el preloader
                       this.preloader = true;
                       //enviamos los datos para el create or update
                       axios.post(url,data).then((response) => {
                           //subimos la img si esta es dinstinta de null
                           if( this.selectedFile != null )
                               this._uploadFile(response.data.id);
                           //ocultamos modal y preloader
                           this.showModal = false;
                           //retrasamos la carga de datos
                           this.timeout = setTimeout( () => {
                               //recargamos la tabla
                               this._loadData();
                           }, 500);

                       }).catch(error => {

                           this.errorCode = error.response;
                           this.preloader = false;
                       });

                   }else{

                       this.erroValidate = true;
                   }
               });
                
            },
            showForm(id) {
                //cargamos la url para la consulta
                let url = SITE_URL + '/' + MODULE_URL + '/chapter/edit/' + id;
                //realizamos la consulta
                axios.get(url).then((response) => {

                    let data = response.data;
                    this.chapterData = data;
                    this.formFields = data;
                    this.editor = this.formFields.text;
                    this.showModal = true;

                }).catch(error => {

                    this.errorCode = error.response;
                });

            },
            onFileChanged (event) {
                this.selectedFile = event.target.files[0];
            },
            _uploadFile(id){
                let url = SITE_URL + '/' + MODULE_URL + '/chapter/set_file/' + id;
                const formData = new FormData();
                formData.append('attached', this.selectedFile, this.selectedFile.name);
                
                axios.post(url, formData).then((response) => {
                    
                   //console.log(response.data);
                   this.formFields.image = response.data.image;
    
                }).catch(error => {
                
                    this.errorCode = error.response;

                });
            },
            //método que borra el item seleccionado desde su id
            deleteData : function(id) {
                //url del método
                let url = SITE_URL + '/' + MODULE_URL + '/chapter/delete/' + id;

                this.preloader = true;
                this.errorCode = null;

                axios.delete(url).then((response) => {

                    this.preloader = false;
                    this._loadData();

                }).catch(error => {

                    this.errorCode = error.response;
                    this.preloader = false;
                });
                
            },
            _loadData(){
                //Url, consulta y carga la lista de capítulos del curso
                let url = SITE_URL + '/' + MODULE_URL + '/chapters/' + COURSE_ID;
                this.preloader = true;

                axios.get(url).then((response) => {

                    this.preloader = false;
                    //pasamos los datos de la consulta
                    this.chaptersData = response.data;

                }).catch(error => {

                    this.errorCode = error.response;
                    this.preloader = false;
                });
            }
        },
        mounted() {
            this._loadData();
        },
    });

}

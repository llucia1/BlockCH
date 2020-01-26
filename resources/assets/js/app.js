
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');
//Vuejs Dialog Plugin
import VuejsDialog from "vuejs-dialog";
import VuejsDialogMixin from "vuejs-dialog/dist/vuejs-dialog-mixin.min.js";
import 'vuejs-dialog/dist/vuejs-dialog.min.css';

Vue.use(VuejsDialog, {
    html: true, 
    loader: false,
    okText: 'Continuar',
    cancelText: 'Cancelar',
    animation: 'bounce'
});
//VeeValidate para lña validación de campos
import VeeValidate from 'vee-validate';
const VueValidationEs = require('vee-validate/dist/locale/es');
const config = {
    locale: 'es',
    events: 'blur',
    dictionary: { es: VueValidationEs }
};
Vue.use(VeeValidate,config);
//Modal component
Vue.component('modal', {template: '#modal-template'});
//vue mask
const VueInputMask = require('vue-inputmask').default;
 Vue.use(VueInputMask);
 //clipBoard
import Clipboard from 'v-clipboard'
Vue.use(Clipboard)
//alert mini
import VueSweetalert2 from 'vue-sweetalert2';
const options = {
  confirmButtonColor: '#41b882',
  cancelButtonColor: '#ff7674'
}
Vue.use(VueSweetalert2, options)
//constantes con las URL de la app
const SITE_URL = document.head.querySelector('meta[name="site-url"]').content;
const MODULE_URL = document.head.querySelector('meta[name="module-url"]').content;
const METHOD = document.head.querySelector('meta[name="method"]').content;
/**
 * ---componente la tabla con listados de candidates---
*/
if (document.querySelector('#table-data')) {
   
    var table_managers = new Vue({

        el: '#table-data',
        data: {

            preloader: false,
            errorCode: null,
            showModal: false,
            rows: [],
            editUrl: '',
            deleteUrl: '',
            showUrl: '',
            pageItem: null,
            searchParam:'',
            timeout: null,
            siteUrl: SITE_URL,
        },
        methods: {
            clipboardSuccessHandler ({ value, event }) {
                console.log('success', value)
                this.$swal('Copia realizada con éxtio!!!');
            },
           
            clipboardErrorHandler ({ value, event }) {
                console.log('error', value)
                this.$swal('Problemas al copiar');
            },
            //método para la búsqueda
            getDataBySearchParam : function() {

                if (this.timeout != null) {
                    clearTimeout(this.timeout);
                }

                this.timeout = setTimeout( () => {
                    this.timeout = null;

                    let url = this.searchParam ? '/'+MODULE_URL+'/search/' + this.searchParam : '/'+MODULE_URL;
                    //si el parametro es vacío loadData sin param
                    url != '' ?  this._loadData(url) : this._loadData();
                }, 500);

            },
            //metodo para la paginación
            getDataByPage : function(page) {

                let url = '/'+MODULE_URL+'?page=' + page;
                this._loadData(url);
            },
             //metodo para la confirmación de acciones
             confirmationDialog : function(text,url=null) {

                this.$dialog.confirm(text)
                .then(function (dialog) {

                    location.href =url;

                })
                .catch(function () {

                    console.log('Clicked on cancel');

                });
            },
            disabledButton(id){

                this.preloader = true;
                let url = '/'+MODULE_URL+'/disabled/' + id;

                axios.post(SITE_URL + url).then((response) => {

                    this.preloader = false;
                    this.rows.data[ id - 1 ].deleted_at = response.data.deleted_at;

                }).catch(error => {

                    this.errorCode = error.response;
                    this.preloader = false;
                });
            },
            //limpia la url para los btn edit y delete
            _clearModuleUrl(moduleUrl){

                let module = moduleUrl.split('/');
                (module.length > 1) ? module = module[1] : module = module[0];
                return module;
            },
            //metodo para la confirmación de acciones
            confirmationDialog : function(text,url=null) {

                this.$dialog.confirm(text)
                .then(function (dialog) {

                    location.href =url;

                })
                .catch(function () {

                    console.log('Clicked on cancel');

                });
            },
            //metodo que carga la tabla al inicio de la página
            _loadData(urlPage = null) {
                //url del método
                this.preloader = true; 
                let url = '/'+MODULE_URL;
                //si urlPage es distintao de null sobreescribimos url
                if( urlPage != null)
                    url = urlPage;

                axios.get(SITE_URL + url).then((response) => {

                    this.preloader = false;
                    this.rows = response.data;
                    //this.pageItem = this._getPageItem(response.data);
                    this.editUrl = SITE_URL + '/'+this._clearModuleUrl(MODULE_URL)+'/edit/';
                    this.deleteUrl = SITE_URL + '/'+this._clearModuleUrl(MODULE_URL)+'/delete/';
                    this.showUrl = SITE_URL + '/'+this._clearModuleUrl(MODULE_URL)+'/show/';
                    
                }).catch(error => {

                    this.errorCode = error.response;
                    this.preloader = false;
                    this.showModal = true;
                });
            },
        },
        mounted() {
            this._loadData();
        },
    });

}

/**
 * ---componente para interactuar con los formularios---
*/
if (document.querySelector('#form-data')) {

    var form_data = new Vue({

        el: '#form-data',
        data: {

            password: null,
            rol: null,
            preloader: false,
            errorCode: null,
            showModal: false,
            urlEdit: null,
            formFields: [],
            itemId: document.querySelector('#item_id').value,
            method: METHOD,
            erroValidate: false,
        },
        methods: {

            setData : function() {
                //url del método
                let url = '/'+MODULE_URL+'/store';
                //si el id > 0 sobreescribimos la url
                if( this.itemId > 0 )
                    url = '/'+MODULE_URL+'/update/' + this.itemId;
                //capturamos todos los campos de formulario
                const formData = new FormData(this.$refs['formMain']);
                const data = {};
                //recorremos y creamos el objeto data
                for (let [key, val] of formData.entries()) {

                    Object.assign(data, { [key]: val })
                }
                //comprobamos si la variable password es distinto de null
                //en ese caso lo añadimos al data
                if(this.password != null)
                    Object.assign(data, { 'password': this.password })

                //realizamos la consulta
                this.$validator.validateAll().then(() => {

                    if ( !this.errors.any() ) {

                        this.preloader = true;
                        this.errorCode = null;
                        this.erroValidate = false;

                        axios.post(SITE_URL + url,data).then((response) => {

                            this.preloader = false;
                            this.showModal = true;
                            this.urlEdit = SITE_URL + '/'+this._clearModuleUrl(MODULE_URL)+'/edit/' + response.data.id;

                        }).catch(error => {

                            this.errorCode = error.response;
                            this.preloader = false;
                            this.showModal = true;
                            
                        });

                    }else{

                        this.erroValidate = true;
                    }

                });

            },
            generatePass : function() {
                
                //longitud de la contraseña, lista de caracteres y almacen pass generado
                let long = 8;
                let characters = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
                let _pass =  '';
                //recorremos mediant loop hasta long y generamos la contraseña de forma aleatria
                for ( let i = 0; i<long; i++ ) {
                    _pass += characters.charAt(Math.floor(Math.random()*characters.length));
                }
                //pasamos al los campos correspondientes el pass generado
                this.password = _pass;
            },
            togglePass() {

                var passEle = document.getElementById('password');
                var passIcoEle = document.getElementById('pass-ico');
                var open = 'mdi-eye';
                var closed = 'mdi-eye-off';
                if ( passEle.type == 'password' ) {
                    passEle.type = 'text';
                    passIcoEle.classList.remove(open);
                    passIcoEle.className += ' ' + closed;
                } else {
                    passEle.type = 'password';
                    passIcoEle.classList.remove(closed);
                    passIcoEle.className += ' ' + open;
                }
            },
            getPrefix(){
                //url del método
                let url = '/countries/getPrefix';
                const data = {'country': this.formFields.country};

                axios.post(SITE_URL + url,data).then((response) => {

                    this.formFields.prefix = response.data.prefix;

                }).catch(error => {

                    this.errorCode = error.response;
                    
                });
                
            },
            _loadData() {

                //consultamos y cargamos formFields con los datos devueltos 
                axios.get(SITE_URL + '/'+this._clearModuleUrl(MODULE_URL)+'/edit/'+ this.itemId).then((response) => {

                    let data = response.data;
                    this.formFields = data;
                    
                }).catch(error => {

                    this.errorCode = error.response;
                });
  
            },
            //limpia la url para los btn edit y delete
            _clearModuleUrl(moduleUrl){

                let module = moduleUrl.split('/');
                (module.length > 1) ? module = module[1] : module = module[0];
                return module;
            },
        },
        mounted() {this._loadData();},

    });

}
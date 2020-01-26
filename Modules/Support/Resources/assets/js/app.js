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
const SUPPORT_ID = document.querySelector('#support_id').value;

Vue.use(VeeValidate,config);

Vue.component('modal', {template: '#modal-template'});
//text editor for vue
import { VueEditor } from "vue2-editor";

if (document.querySelector('#form-support')) {

    var form_support = new Vue({
        el: '#form-support',
        components: {VueEditor},
        data: {

            preloader: false,
            errorCode: null,
            erroValidate: false,
            editor: null,
            subject: null,
        },
        methods: {

            setData : function() {

                //url del método
                let url = '/api/support/store';
                const data = {};
                //asignamos los datos de texto
                Object.assign(data, { 'text': this.editor });
                Object.assign(data, { 'subject': this.subject });

                this.$validator.validateAll().then(() => {

                    if ( !this.errors.any() ) {

                        this.preloader = true;
                        this.errorCode = null;
                        this.erroValidate = false;
      
                        axios.post(SITE_URL + url,data).then((response) => {

                            this.preloader = false;
                            //this.urlEdit = SITE_URL + '/courses/edit/' + response.data.id;
                            //console.log(response.data);
                        }).catch(error => {

                            this.errorCode = error.response;
                            this.preloader = false;
                        });

                    }else{

                        this.erroValidate = true;
                    }

                });

            }
        },

    });
}
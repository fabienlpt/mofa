import './styles/app.css';

import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';

createApp({
    compilerOptions: {
        delimiters: ['${', '}']
    },
    data() {
        return {
            show: false,
            count: 0,
            timeout: null,
            submit: false,
            fetchResult: async () => {
                const value = this.$refs.input.value;
                if (value?.length &&this.submit) {
                    window.location.href = `/${ value }`;
                }
                this.submit= false;
            }
        }
    },
    mounted() {
        if(localStorage.count) this.count = localStorage.count;
    },
    watch:{
        count(newCount) {
            localStorage.count = newCount;
        }
    },
    methods: {
        updateInput() {
             clearTimeout(this.timeout);
             this.timeout = setTimeout(this.fetchResult, 500);
        },
        checkSubmit() {
           this.updateInput();
           this.submit= true;
        },
        onDelete(id) {
           var result = confirm('Êtes vous sur de vouloir supprimer cet article ?');
           if(result) {
               window.location.href = `/delete/${ id }`;
           }
        }
    }
}).mount('#app');
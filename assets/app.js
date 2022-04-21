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
        
    }
}).mount('#app');
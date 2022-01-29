require('./bootstrap');

import InputFile from "./components/InputFile";

window.Vue = require('vue').default;

const app = new Vue({
    el: '#app',
    components: {
        InputFile
    }
})

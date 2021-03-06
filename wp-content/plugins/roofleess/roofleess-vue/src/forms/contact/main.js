require('../../../node_modules/vuetify/src/stylus/app.styl')

import Vue from 'vue'
import {
    Vuetify,
    VApp,
    VForm,
    VTextField,
    VBtn,
    VIcon,
    VGrid,
    VTextarea,
    VProgressCircular,
    VAlert,
} from 'vuetify'

import App from './App.vue'

Vue.use(Vuetify, {
    components: {
        VApp,
        VForm,
        VTextField,
        VBtn,
        VIcon,
        VGrid,
        VTextarea,
        VProgressCircular,
        VAlert
    }
})

new Vue({
    el: '#app',
    render: h => h(App)
})

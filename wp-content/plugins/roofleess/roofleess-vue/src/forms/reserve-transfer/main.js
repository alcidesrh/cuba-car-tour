require('../../../node_modules/vuetify/src/stylus/app.styl')

import Vue from 'vue'
import {
    Vuetify,
    VApp,
    VForm,
    VTextField,
    VSelect,
    VCheckbox,
    VBtn,
    VIcon,
    VGrid,
    VMenu,
    VDatePicker,
    VTimePicker,
    VDialog,
    VTextarea,
    VList,
    VSubheader,
    VDivider,
    VProgressCircular,
    VImg,
    VAlert
} from 'vuetify'

import App from './App.vue'

Vue.use(Vuetify, {
    components: {
        VApp,
        VForm,
        VTextField,
        VSelect,
        VCheckbox,
        VBtn,
        VIcon,
        VGrid,
        VMenu,
        VDatePicker,
        VTimePicker,
        VDialog,
        VTextarea,
        VList,
        VSubheader,
        VDivider,
        VProgressCircular,
        VImg,
        VAlert
    },
})

new Vue({
    el: '#app',
    render: h => h(App)
})

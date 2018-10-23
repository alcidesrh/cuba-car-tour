<template>
    <v-app>
        <v-container>
            <v-progress-circular v-show="load"
                                 :rotate="360"
                                 :size="100"
                                 :width="15"
                                 :value="value"
                                 color="teal"
            >
                {{ value }}
            </v-progress-circular>
            <v-alert v-show="contact.sent" class="center-form mt-3"
                    :value="true"
                    color="success"
                    icon="check_circle"
            >
                Your message was received. Thank you for give us a feedback.
            </v-alert>
            <v-alert v-show="contact.error" class="center-form mt-3"
                    :value="true"
                    type="error"
            >
                There was an error receiving your request. Please try again. Thank you.
            </v-alert>
            <v-form id="contact-form" v-show="!contact.sent" ref="form" v-model="valid" lazy-validation v-bind:style="{ opacity: opacity, padding: '10px'}"
                    class="center-form mt-3" >
                <v-layout row wrap>
                    <v-flex xs12>
                        What type of service do you want to give a testimony?
                        <v-radio-group v-model="typeService" :column="false">
                            <v-radio
                                    label="Havana Tour"
                                    value="tour_list"
                            ></v-radio>
                            <v-radio
                                    label="Day Tour"
                                    value="day_tour_list"
                            ></v-radio>
                            <v-radio
                                    label="Transfer"
                                    value="transfer_list"
                            ></v-radio>
                            <v-radio
                                    label="Rent Car"
                                    value="rent_car"
                            ></v-radio>
                        </v-radio-group>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-select
                                v-model="contact.tour"
                                :items="tours"
                                :rules="fieldRules"
                                item-text="post_title"
                                item-value="ID"
                                label="Select target"
                                prepend-icon="accessible"
                                required
                                :disabled="!typeService"
                        >
                            <template slot="selection" slot-scope="data">
                                <div style="width: 100%">
                                    <img height="60" v-bind:src="data.item.img"/>
                                    <label class="pl-2 d-inline">{{ data.item.post_title }}</label>
                                </div>
                            </template>
                            <template slot="item" slot-scope="data">
                                <template v-if="typeof data.item !== 'object'">
                                    No data available
                                </template>
                                <template v-else>
                                        <img height="60" v-bind:src="data.item.img" class="py-2"/>
                                        <label class="pl-2">{{ data.item.post_title }}</label>
                                </template>
                            </template>
                        </v-select>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-text-field
                                :disabled="!contact.tour"
                                v-model="contact.name"
                                label="Full name"
                                prepend-icon="person"
                                required
                                :rules="fieldRules"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <input type="file" style="display: none" id="photo" @change="photoProccess" ref="photo">
                        <img v-show="img" :src="img" style="max-width: 100px" />
                        <v-btn small color="primary" @click="uploadPhoto" class="d-inline">Add Photo</v-btn>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-rating
                                v-model="contact.rating"
                                background-color="orange lighten-3"
                                color="orange"
                                medium
                        ></v-rating>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-textarea
                                :disabled="!contact.tour"
                                v-model="contact.note"
                                label="Note"
                                prepend-icon="note"
                                hint="Hint text"
                                required
                                :rules="fieldRules"
                        ></v-textarea>
                    </v-flex>
                </v-layout>
                <v-layout row wrap mt-3>
                    <v-flex xs12>
                        <v-btn block color="green" dark @click="submit">Send</v-btn>
                    </v-flex>
                </v-layout>
            </v-form>

        </v-container>
    </v-app>
</template>

<script>
    import axios from 'axios'

    export default {
        data: () => ({
            valid: true,
            opacity: 1,
            load: false,
            name: '',
            typeService: false,
            tours: {},
            contact: {},
            img: false,
            interval: {},
            value: 0,
            fieldRules: [
                v => !!v || 'This filed is required',
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ]
        }),

        methods: {
            photoProccess(){
                let $this = this;
                let reader  = new FileReader();
                let file = this.$refs.photo.files[0];

                reader.onloadend = function () {
                    $this.img = reader.result;
                    $this.contact.img.src = reader.result;
                }

                if (this.$refs.photo.files.length) {
                    reader.readAsDataURL(file); //reads the data as a URL
                    this.contact.img = {'name': file.name, 'type': file.type};
                } else {
                    this.img = "";
                    this.contact.img = {};
                }
            },
            initLoad() {
                this.load = true;
                this.opacity = 0.5;
                this.interval = setInterval(() => {
                    if (this.value < 100) {
                        if (this.value < 90) {
                            this.value += 10
                        }
                        else {
                            this.value += 1
                        }
                    }
                }, 1000)
            },
            stopLoad() {
                this.load = false;
                clearInterval(this.interval)
                this.opacity = 1;
                this.value = 0;
            },
            submit() {
                this.contact.error = false;
                if (this.$refs.form.validate()) {
                    this.contact.type = this.typeService;
                    this.$vuetify.goTo('body', {0: 500});
                    let $this = this;
                    this.initLoad();
                    var data = new FormData();
                    data.append('action', 'feedback');
                    data.append('feedback', JSON.stringify(this.contact));
                    axios.post(params.ajax_url, data).then(function (response) {
                        $this.stopLoad();
                        if(response.data == 'success')
                        $this.contact.sent = true;
                        else
                            $this.contact.error = true;
                    }).catch(function (error) {
                            $this.stopLoad();
                        });
                }
                else
                    this.$vuetify.goTo('#contact-form', {duration: 500});
            },
            clear() {
                this.$refs.form.reset()
            },
            uploadPhoto(){
                jQuery('#photo').click();
            }
        },
        watch:{
            typeService(val){
                this.contact = {};
                let $this = this;
                this.initLoad();
                axios.get(params.ajax_url, {
                    params: {
                        action: val
                    }
                }).then(function (response) {
                    $this.tours = response.data;
                    $this.stopLoad();
                })
                    .catch(function (error) {
                        $this.stopLoad();
                    });
            }
        },
        created() {

        }
    }
</script>
<style>
    .v-progress-circular {
        position: absolute;
        top: 150px;
        left: 50%;
        margin-left: -50px;
    }
    .price-select {
        float: right;
        position: absolute;
        right: 20px;
        font-size: 15px;
    }
    .center-form {
        /*width: fit-content;*/
        margin: auto;
        max-width: 600px;
    }

    .page-header {
        margin-bottom: 0px !important;
    }
</style>
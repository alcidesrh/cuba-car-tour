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
                Your message was received. We will put in contact with you as soon as posible, keep checking your email inbox for confirmation of your reseve. Thank you.
            </v-alert>
            <v-alert v-show="contact.error" class="center-form mt-3"
                    :value="true"
                    type="error"
            >
                There was an error receiving your request. Please try again. Thank you.
            </v-alert>
            <v-form id="contact-form" v-show="!contact.sent" ref="form" v-model="valid" lazy-validation v-bind:style="{ opacity: opacity, minWidth: '400px'}"
                    class="center-form mt-3" >
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-text-field
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
                        <v-text-field
                                v-model="contact.email"
                                prepend-icon="email"
                                :rules="emailRules"
                                label="E-mail"
                                required
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-text-field
                                v-model="contact.phone"
                                label="Phone (not obligated)"
                                prepend-icon="phone"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-textarea
                                v-model="contact.note"
                                label="Note"
                                prepend-icon="note"
                                hint="Hint text"
                        ></v-textarea>
                    </v-flex>
                </v-layout>
                <v-layout row wrap mt-3>
                    <v-flex xs12>
                        <v-btn block color="green" dark @click="submit">contact</v-btn>
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

            contact: {},
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
                    this.$vuetify.goTo('#contact-form', {0: 500});
                    let $this = this;
                    this.initLoad();
                    var data = new FormData();
                    data.append('action', 'contact');
                    data.append('contact', JSON.stringify(this.contact));
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

    .center-form {
        margin: auto;
        max-width: 600px;
    }

    .page-header {
        margin-bottom: 0px !important;
    }
</style>
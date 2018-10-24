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
            <v-alert v-show="reserve.sent" class="center-form mt-3"
                     :value="true"
                     color="success"
                     icon="check_circle"
            >
                Your message was received. We will put in contact with you as soon as posible, keep checking your email inbox for confirmation of your reseve. Thank you.
            </v-alert>
            <v-alert v-show="reserve.error" class="center-form mt-3"
                     :value="true"
                     type="error"
            >
                There was an error receiving your request. Please try again. Thank you.
            </v-alert>
            <v-form id="reserve-form" v-show="!reserve.sent" ref="form" v-model="valid" lazy-validation
                    class="center-form mt-3">
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-text-field
                                v-model="reserve.name"
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
                                v-model="reserve.email"
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
                                v-model="reserve.phone"
                                label="Phone (not obligated)"
                                prepend-icon="phone"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-textarea
                                v-model="reserve.note"
                                label="Make a customize request"
                                prepend-icon="note"
                                hint="Hint text"
                                rows="5"
                        ></v-textarea>
                    </v-flex>
                </v-layout>
                <v-layout row wrap mt-3>
                    <v-flex xs12>
                        <v-btn block color="green" dark @click="submit">send request</v-btn>
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
            opacity: 0.5,
            load: false,
            reserve: {},
            interval: {},
            value: 0,
            fieldRules: [
                v => !!v || 'This filed is required',
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            select: null,
            items: [],
            headers: [
                {
                    text: '',
                    align: 'left',
                    sortable: false,
                    value: 'name'
                },
                {text: 'Price', value: 'price', align: 'left', sortable: false}
            ],
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
                this.reserve.error = false;
                if (this.$refs.form.validate()) {
                    this.$vuetify.goTo('#reserve-form', {0: 500});
                    let $this = this;
                    this.initLoad();
                    var data = new FormData();
                    data.append('action', 'contact');
                    data.append('reserve', JSON.stringify(this.reserve));
                    axios.post(params.ajax_url, data).then(function (response) {
                        $this.stopLoad();
                        if(response.data == 'success')
                            $this.reserve.sent = true;
                        else
                            $this.reserve.error = true;
                    }).catch(function (error) {
                        $this.stopLoad();
                    });
                }
                else
                    this.$vuetify.goTo('#reserve-form', {duration: 500});
            },
            clear() {
                this.$refs.form.reset()
            },
        },
        created() {
            this.reserve.category = params.category;
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

    .v-list--three-line .v-list__tile {
        height: 100%;
    }

    .center-form {
        margin: auto;
        max-width: 600px;
    }

    .page-header {
        margin-bottom: 0px !important;
    }
</style>
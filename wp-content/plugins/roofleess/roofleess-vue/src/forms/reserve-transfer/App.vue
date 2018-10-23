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
            <v-form v-if="customize" id="reserve-form" v-show="!reserve.sent" ref="form" v-model="valid" lazy-validation
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
                                label="Note"
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
            <v-form v-if="!customize"id="reserve-form" v-show="!reserve.sent" ref="form" v-model="valid" lazy-validation v-bind:style="{ opacity: opacity}"
                    class="center-form mt-3">
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-select
                                v-model="reserve.tour"
                                :items="tours"
                                :rules="fieldRules"
                                item-text="post_title"
                                item-value="ID"
                                label="Select transfer"
                                prepend-icon="accessible"
                                required
                                @change="selectTransfer()"
                        >
                        </v-select>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-select
                                v-model="reserve.car"
                                :items="cars"
                                :rules="fieldRules"
                                label="Select car"
                                item-text="post_title"
                                item-value="id"
                                prepend-icon="directions_car"
                                required
                                @change="selectCar"
                        >
                            <template slot="selection" slot-scope="data">
                                <div style="width: 100%">
                                    <label class="pl-2 d-inline">{{ data.item.post_title }}</label><strong
                                        class="price-select">price: {{data.item.price}} cuc</strong>
                                </div>
                            </template>
                            <template slot="item" slot-scope="data">
                                <template v-if="typeof data.item !== 'object'">
                                    No data available
                                </template>
                                <template v-else>
                                    <label class="pl-2">{{ data.item.post_title }}</label><strong class="price-select">price:
                                    {{data.item.price}} cuc</strong>
                                </template>
                            </template>
                        </v-select>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12 sm6>
                        <v-menu
                                ref="date_picker"
                                :close-on-content-click="false"
                                v-model="date_picker"
                                :nudge-right="40"
                                :return-value.sync="reserve.date"
                                lazy
                                transition="scale-transition"
                                offset-y
                                full-width
                                min-width="290px"
                        >
                            <v-text-field
                                    slot="activator"
                                    v-model="reserve.date"
                                    label="Start tour day"
                                    prepend-icon="event"
                                    readonly
                                    required
                                    :rules="fieldRules"
                            ></v-text-field>
                            <v-date-picker v-model="reserve.date"
                                           @input="$refs.date_picker.save(reserve.date)"></v-date-picker>

                        </v-menu>
                    </v-flex>
                    <v-flex xs12 sm6>
                        <v-menu
                                ref="time_picker"
                                :close-on-content-click="false"
                                v-model="time_picker"
                                :nudge-right="40"
                                :return-value.sync="reserve.time"
                                lazy
                                transition="scale-transition"
                                offset-y
                                full-width
                                max-width="290px"
                                min-width="290px"
                        >
                            <v-text-field
                                    slot="activator"
                                    v-model="reserve.time"
                                    label="Start transfer time"
                                    prepend-icon="access_time"
                                    readonly
                                    required
                                    :rules="fieldRules"
                            ></v-text-field>
                            <v-time-picker
                                    v-if="time_picker"
                                    v-model="reserve.time"
                                    full-width
                                    @change="$refs.time_picker.save(reserve.time)"
                            ></v-time-picker>
                        </v-menu>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-text-field
                                v-model="reserve.location"
                                label="Pick up location"
                                prepend-icon="location_on"
                                required
                                :rules="fieldRules"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-text-field
                                v-model="reserve.number"
                                label="Number of tourists"
                                prepend-icon="group"
                                :rules="fieldRules"
                                v-on:keyup="reserve.number = (validNumber(reserve.number, $event)?reserve.number:'')"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
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
                                label="Note"
                                prepend-icon="note"
                                hint="Hint text"
                                rows="1"
                        ></v-textarea>
                    </v-flex>
                </v-layout>
                <v-layout row wrap mt-3 v-show="items.length">
                    <v-flex xs12>
                        <v-list>
                            <template v-for="(item, index) in items">
                                <v-subheader left class="mb-3"
                                             v-if="index == 0"
                                >
                                    <label>Resume</label>
                                </v-subheader>

                                <v-list-tile class="my-2"
                                             :key="item.ID"
                                             avatar
                                             ripple
                                             @click=""
                                >
                                    <v-list-tile-content class="pl-2">
                                        <v-list-tile-title>
                                            {{item.post_title}}
                                        </v-list-tile-title>
                                        <v-list-tile-sub-title v-html="item.post_content"></v-list-tile-sub-title>
                                    </v-list-tile-content>
                                    <v-list-tile-action v-show="item.price">
                                        {{item.price}} cuc
                                    </v-list-tile-action>

                                </v-list-tile>
                                <v-divider></v-divider>
                                <v-list-tile class="my-2" v-if="index == items.length - 1"
                                             key="totaltopay"
                                             avatar
                                             ripple
                                >
                                    <v-list-tile-action>
                                        <v-list-tile-avatar size="60" tile>

                                        </v-list-tile-avatar>
                                    </v-list-tile-action>
                                    <v-list-tile-content class="pl-2">
                                        <v-list-tile-title>

                                        </v-list-tile-title>
                                        <v-list-tile-sub-title></v-list-tile-sub-title>
                                    </v-list-tile-content>
                                    <v-list-tile-action>
                                        <strong>Total: {{total()}} cuc</strong>
                                    </v-list-tile-action>

                                </v-list-tile>
                            </template>
                        </v-list>
                    </v-flex>
                </v-layout>
                <v-layout row wrap mt-3>
                    <v-flex xs12>
                        <v-btn block color="green" dark @click="submit">Reserve</v-btn>
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
            name: '',
            tours: [],
            tour: {},
            cars: [],
            customize: false,
            reserve: {date: null, time: null},
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
            date_picker: null,
            time_picker: null,
        }),

        methods: {
            selectTransfer() {
                if (!params.tour_id)
                    this.initLoad();
                else
                    params.tour_id = false;
                this.items = this.tours.filter(item => item.ID == this.reserve.tour);
                this.tour = this.items[0];
                this.cars = [{
                    'post_title': 'Sedan',
                    'price': parseInt(this.tour.price_per_sedan),
                    'id': 1,
                    'img': '/img/sedan.png'
                }, {
                    'post_title': 'Convertible',
                    'price': parseInt(this.tour.price_per_convertible),
                    'id': 2,
                    'img': '/img/convertible-icon.png'
                }];
                this.stopLoad();
            },
            selectCar() {
                this.updateResumen();
            },
            updateResumen() {
                this.items = [this.tour];
                this.items.push(...this.cars.filter(item => item.id == this.reserve.car));
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
            total() {
                let total = 0;
                this.items.filter(item => {
                    if(item.price)total = total + parseFloat(item.price)
                });
                this.reserve.total = total;
                return total
            },
            submit() {
                this.reserve.error = false;
                if (this.$refs.form.validate()) {
                    this.$vuetify.goTo('#reserve-form', {0: 500});
                    let $this = this;
                    this.initLoad();
                    var data = new FormData();
                    data.append('action', 'reserve_transfer');
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
            validNumber(val, event) {
                return !((event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 96 || event.keyCode > 105)) && (event.keyCode != 8 && event.keyCode != 46 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 13)) ? true : false;
            }
        },
        created() {
            if(params.customize){
                this.customize = true;
                return;
            }
            let $this = this;
            this.initLoad();
            axios.get(params.ajax_url, {
                params: {
                    action: 'transfer_list'
                }
            }).then(function (response) {
                $this.tours = response.data;
                if (params.tour_id) {
                    $this.reserve.tour = parseInt(params.tour_id);
                }
            })
                .catch(function (error) {
                    $this.stopLoad();
                });

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

    .price-select {
        float: right;
        position: absolute;
        right: 20px;
        font-size: 15px;
    }

    .center-form {
        margin: auto;
        max-width: 600px;
    }

    .page-header {
        margin-bottom: 0px !important;
    }
</style>
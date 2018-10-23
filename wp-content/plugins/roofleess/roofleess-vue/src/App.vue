<template>
  <v-form ref="form" v-model="valid" lazy-validation>
    <v-menu
            ref="menu2"
            :close-on-content-click="false"
            v-model="menu2"
            :nudge-right="40"
            :return-value.sync="date"
            lazy
            transition="scale-transition"
            offset-y
            full-width
            min-width="290px"
    >
      <v-text-field
              slot="activator"
              v-model="date"
              label="Picker without buttons"
              prepend-icon="event"
              readonly
      ></v-text-field>
      <v-date-picker v-model="date" @input="$refs.menu2.save(date)"></v-date-picker>

    </v-menu>
    <v-text-field
            v-model="name"
            :rules="fieldRules"
            label="Name"
            required
    ></v-text-field>
    <v-text-field
            v-model="email"
            :rules="emailRules"
            label="E-mail"
            required
    ></v-text-field>
    <v-select
            v-model="select"
            :items="items"
            :rules="fieldRules"
            label="Item"
            required
    ></v-select>
    <v-checkbox
            v-model="checkbox"
            :rules="[v => !!v || 'You must agree to continue!']"
            label="Do you agree?"
            required
    ></v-checkbox>

    <v-btn
            :disabled="!valid"
            @click="submit"
    >
      submit
    </v-btn>
    <v-btn @click="clear">clear</v-btn>
  </v-form>
</template>

<script>
    import axios from 'axios'

    export default {
        data: () => ({
            valid: true,
            name: '',
            fieldRules: [
                v => !!v || 'This filed is required',
            ],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            select: null,
            items: [
                'Item 1',
                'Item 2',
                'Item 3',
                'Item 4'
            ],
            checkbox: false,
            date: null,
            menu: false,
            modal: false,
            menu2: false
        }),

        methods: {
            submit () {
                if (this.$refs.form.validate()) {
                    // Native form submission is not yet supported
                    axios.post('/api/submit', {
                        name: this.name,
                        email: this.email,
                        select: this.select,
                        checkbox: this.checkbox
                    })
                }
            },
            clear () {
                this.$refs.form.reset()
            }
        }
    }
</script>
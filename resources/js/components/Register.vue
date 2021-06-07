<template>

    <!--    this is the login form with bootstrap -->
    <div class="container">
        <div class="row">
            <div class="col-8">
                <input type="email" placeholder="email" v-model="email" />
                <input type="email" placeholder="emailVerify" v-model="emailVerify" />
                <input type="password" placeholder="password" v-model="password" />
                <input type="password" placeholder="passwordVerify" v-model="passwordVerify" />
                <input type="text" placeholder="phonenumber" v-model="phonenumber" />
                <input type="text" placeholder="firstName" v-model="firstName" />
                <input type="text" placeholder="lastName" v-model="lastName" />
                <button :disabled="email != emailVerify && email.length > 6" @click="register">Login</button>

            </div>
        </div>
    </div>

</template>

<script>
export default {
    data: () => ({
        email: '',
        password: '',
        emailVerify: '',
        passwordVerify: '',
        phonenumber: '',
        firstName: '',
        lastName: '',

    }),

    mounted() {

    },

    methods: {
        register() {
            axios.post('/api/user', {
                'email': this.email,
                'password': this.password,
                'phonenumber': this.phonenumber,
                'first_name': this.firstName,
                'last_name': this.lastName,

            }).then(result=>{
                console.log(result)
            })
        }
    },

    created() {

    }


}
</script>

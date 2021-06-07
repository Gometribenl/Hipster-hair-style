<template>

<!--    this is the login form with bootstrap -->
    <div class="container">
        <div class="row">
            <div class="col-8">
                    <input type="email" placeholder="email" v-model="email" />
                    <input type="password" placeholder="password" v-model="password" />
                    <button @click="login">Login</button>
                <button @click="getUser">getuser</button>


            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data: () => ({
            email: '',
            password: '',

        }),

        mounted() {

        },

        methods: {
            login() {
                axios.post('/api/user/login', {
                    'email': this.email,
                    'password': this.password
                }).then(result=>{
                    console.log(result)
                })
            },
            getUser() {
                axios.get('/api/user2').then(result=>{
                    console.log(result)
                })
            }
        },

        created() {

        }


    }
</script>

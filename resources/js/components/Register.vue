<template>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <form action="/user" method="POST">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="text" placeholder="voornaam" name="first_name" v-model="credentials.first_name"/>
                    <input type="text" placeholder="achternaam" name="last_name" v-model="credentials.last_name"/>
                    <input type="tel" placeholder="telefoonnummer" name="phonenumber" v-model="credentials.phonenumber"/>
                    <input type="email" placeholder="email" name="email" v-model="credentials.email"/>
                    <input type="password" placeholder="password" name="password" v-model="credentials.password"/>
                    <input type="submit" value="verzend"/>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            credentials: {
                email: '',
                password: '',
                first_name: '',
                last_name: '',
                phonenumber: '',
            },
        }),

        mounted() {

        },

        methods: {

        },

        created() {

        }

    }
</script>

</script>

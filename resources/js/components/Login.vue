<template>

<!--    this is the login form with bootstrap -->
    <div class="container">
        <div class="row">
            <div class="col-8">
                <form action="/user/login" method="POST">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="email" placeholder="email" name="email" />
                    <input type="password" placeholder="password" name="password" />
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
            email: '',
            password: '',

        }),

        mounted() {

        },

        methods: {

        },

        created() {

        }


    }
</script>

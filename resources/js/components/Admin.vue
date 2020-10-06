<template>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <form action="products" method="POST">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="text" placeholder="title" name="title" />
                    <input type="text" placeholder="desc" name="desc" />
                    <input type="number" placeholder="instock" name="instock"/>
                    <input type="decimal" placeholder="price" name="price"/>
                    <label for="tax"></label>
                    <select name="tax" id="tax">
                        <option v-bind:value="tax.id" v-for="tax in taxes">{{tax.tax}}</option>
                    </select>
                    <input type="submit" value="verzend"/>
                </form>
            </div>
        </div>
        <div class="row">
            <form action="tax" method="POST">
                <input type="hidden" name="_token" :value="csrf">
                <input type="text" placeholder="tax" name="tax" />
                <input type="submit" value="verzend"/>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            taxes: [],
            tax: '',
            products: [],
            product: '',
            productsInCart: [],
        }),

        methods: {

            getTaxes() {
                axios.get('/tax').then(({ data }) => {

                    this.taxes= data;
                }).catch((error)  => {
                    console.error(error)
                })
            },
            getProducts () {
                axios.get('/products').then(({ data }) => {
                    this.products= data;
                }).catch((error)  => {
                    console.error(error)
                })
            },
        },

        created() {
            this.getTaxes()
            this.getProducts()
        }


    }
</script>

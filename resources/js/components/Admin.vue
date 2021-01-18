<template>
    <div class="container">
        <div class="row">
            <div class="col-8">
                    <input type="text" placeholder="title" v-model="title"/>
                    <input type="text" placeholder="desc" v-model="desc"/>
                    <input type="number" placeholder="instock" v-model="instock"/>
                    <input type="decimal" placeholder="price" v-model="price"/>
                    <label for="tax"></label>
                    <select name="tax" id="tax">
                        <option v-bind:value="tax.id" v-for="tax in taxes">{{tax.tax}}</option>
                    </select>
                    <button @click="postProduct">Verzenden</button>
            </div>
        </div>
        <!--        make tax form-->
        <div class="row">
                <input type="text" placeholder="tax" v-model="tax"/>
                <button @click="postTax">Verzenden</button>
        </div>
    </div>
</template>

<script>
    export default {

        data: () => ({
            // data needed to display taxes
            taxes: [],
            tax: '',
            title: '',
            desc: '',
            instock: '',
            price: '',
            products: [],
        }),
// functions
        methods: {
            postTax() {
              axios.post('/api/tax', {'tax':this.tax}).then(res=>{
                  this.taxes = res.data
              })
            },
            postProduct() {
                axios.post('/api/products', {'title':this.title, 'desc':this.desc, 'price':this.price, 'instock':this.instock}).then(res=>{
                    this.products = res.data
                })
            },
            getTaxes() {
                axios.get('/api/tax').then(({data}) => {

                    this.taxes = data;
                }).catch((error) => {
                    console.error(error)
                })
            },
        },
// starts when site is loaded
        created() {
            this.getTaxes()
        }


    }
</script>

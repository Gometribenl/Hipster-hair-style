<template>
    <div class="container">
        <div class="row">
            <div class="col-8">
                    <input type="text" placeholder="title" v-model="title"/>
                    <input type="text" placeholder="desc" v-model="desc"/>
                    <input type="number" placeholder="instock" v-model="instock"/>
                    <input type="decimal" placeholder="price" v-model="price"/>
                    <label for="tax"></label>
                    <select name="tax" id="tax" v-model="mytax">
                        <option >Geen</option>

                        <option  v-for="tax in taxes" :value="tax.id">{{tax.tax}}</option>
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
            mytax: 'Geen',
            tax:'',
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
              }).catch((error) => {
                  console.error(error)
                })
            },
            postProduct() {
                axios.post('/api/products', {'title':this.title, 'desc':this.desc, 'price':this.price, 'instock':this.instock, 'tax':this.mytax}).then(res=>{
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

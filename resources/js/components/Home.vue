<template>
   <div class="container">
       <div class="row">
        <p>test</p>
           <form action="products" method="POST">
               <input type="hidden" name="_token" :value="csrf">
               <input type="text" placeholder="title" name="title" />
               <input type="text" placeholder="desc" name="desc" />
               <input type="text" placeholder="instock" name="instock"/>
               <label for="tax"></label>
               <select name="tax" id="tax">
                   <option v-bind:value="tax.id" v-for="tax in taxes">{{tax.tax}}</option>
               </select>
                   <input type="submit" value="verzend"/>
           </form>
       </div>
       <div class="row">
           <form action="tax" method="POST">
               <input type="hidden" name="_token" :value="csrf">
               <input type="text" placeholder="tax" name="tax" />
               <input type="submit" value="verzend"/>
           </form>
       </div>

       <div class="row">
           <div class="col-6" v-for="product in products">
               <h5>{{product.title}}</h5>
               <p>{{product.desc}}</p>
               <p>{{product.instock}}</p>

           </div>
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
        }),

        methods: {
            getTaxes() {
                axios.get('/tax').then(({ data }) => {
                    console.log(data)
                    this.taxes= data;
            }).catch((error)  => {
                    console.error(error)
                })
            },

            getProducts () {
                axios.get('/products').then(({ data }) => {
                    console.log(data)
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

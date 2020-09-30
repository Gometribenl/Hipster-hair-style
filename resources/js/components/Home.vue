<template>
   <div class="container">
       <div class="row">
           <div class="col-8">
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
           <div class="col-4">
               <div v-for="cart in productsInCart">
                   <p>
                       <span class="cat">{{cart}}</span>
                   </p>
               </div>
           </div>
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
               <p>{{product.price}}</p>
               <button @click="persist(product.title)">add to cart</button>

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
            productsInCart: [],
        }),

        mounted() {
            if (localStorage.getItem('cart')) {
                this.productsInCart = localStorage.getItem('cart')
            }
        },

        methods: {
            persist(id) {
                this.productsInCart.push(id);
                localStorage.setItem('cart', this.productsInCart);
            },

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

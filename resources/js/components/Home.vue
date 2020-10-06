<template>
   <div class="container">
       <div class="row">
           <div class="col-4">
               <div v-for="product in productsInCart">
                   <p>
                       <span class="cat">{{product.title}} <button @click="removeToCart(product)">remove</button></span>
                   </p>
               </div>
               <button @click="handlePayment">Bestellen</button>
           </div>
       </div>


       <div class="row">
           <div class="col-6" v-for="product in products">
               <h5>{{product.title}}</h5>
               <p>Description: {{product.desc}}</p>
               <p>Stock: {{product.instock}}</p>
               <p>€{{product.price}}</p>
               <button @click="addToCart(product)">add to cart</button>

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
            if (sessionStorage.getItem('cart')) {
                this.productsInCart = JSON.parse(sessionStorage.getItem('cart'))
            }
        },

        methods: {
            addToCart (id) {
                this.productsInCart.push(id);
                sessionStorage.setItem('cart', JSON.stringify(this.productsInCart))
            },
            removeToCart (id) {
                this.productsInCart.splice(id, 1);
                sessionStorage.setItem('cart', JSON.stringify(this.productsInCart))
            },

            getTaxes() {
                axios.get('/tax').then(({ data }) => {

                    this.taxes= data;
            }).catch((error)  => {
                    console.error(error)
                })
            },
            handlePayment () {
                let total = 0;

                if(this.productsInCart) {
                    for (let i = 0; i < this.productsInCart.length; i++) {
                        let price = this.productsInCart[i].price * 1;
                        total = total + price
                }}

                    total = total.toFixed(2);
                    window.location.assign('http://4346e579fbc8.ngrok.io/order/payment/' + total.toString());
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

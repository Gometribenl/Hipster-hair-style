<template>
   <div class="container">
       <div class="row">
           <div class="col-4">
<!--               shows products in cart -->
               <div v-for="product in productsInCart">
                   <p>
                       <span class="cat">{{product.title}} <button @click="removeToCart(product)">remove</button></span>
                   </p>
               </div>
<!--               adds to cart -->
               <button @click="handlePayment">Bestellen</button>
           </div>
       </div>

<!--shows products with details-->
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
            // data needed to display products
            products: [],
            product: '',
            // data needed to display products in cart
            productsInCart: [],
        }),

        mounted() {
            // checks if products are in a session
            if (sessionStorage.getItem('cart')) {
                this.productsInCart = JSON.parse(sessionStorage.getItem('cart'))
            }
        },

        methods: {
            // adds products to cart and session
            addToCart (id) {
                this.productsInCart.push(id);
                sessionStorage.setItem('cart', JSON.stringify(this.productsInCart))
            },
            // removes product from cart and session
            removeToCart (id) {
                this.productsInCart.splice(id, 1);
                sessionStorage.setItem('cart', JSON.stringify(this.productsInCart))
            },
            // handles payment front-end
            handlePayment () {
                let total = 0;

                if(this.productsInCart) {
                    for (let i = 0; i < this.productsInCart.length; i++) {
                        let price = this.productsInCart[i].price * 1;
                        total = total + price
                }}

                    total = total.toFixed(2);
                    window.location.assign('http://a89ca10556f8.ngrok.io/order/payment/' + total.toString());
            },
            // gets products from database
            getProducts () {
                axios.get('/api/products').then(({ data }) => {
                    this.products= data;
                }).catch((error)  => {
                    console.error(error)
                })
            },
        },

        created() {
            // starts function when site is loaded
            this.getProducts()
        }


    }
</script>

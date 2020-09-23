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
                   <option v-for="tax in taxes">{{tax.tax}}</option>
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
   </div>
</template>

<script>
    export default {
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            taxes: [],
            tax: ''
        }),

        methods: {
            getTaxes() {
                axios.get('/tax').then(({ data }) => {
                    console.log(data)
                    this.taxes= data;
            }).catch((error)  => {
                    console.error(error)
                })
            }
        },

        created() {
            this.getTaxes()
        }


    }
</script>

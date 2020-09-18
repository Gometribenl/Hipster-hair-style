<template>
    <div>
        <Header></Header>
        <main>
            <router-view></router-view>
        </main>
        <Footer></Footer>
    </div>
</template>

<script>
    import Footer from './Footer'
    import Header from './Header'

    export default {
        components: { Footer, Header}
    }
</script>

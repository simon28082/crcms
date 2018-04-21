<template>
    <div id="main">
        <vHeader></vHeader>
        <vNav></vNav>
        <div class="main-cont">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import vHeader from './public/header.vue'
    import vNav from './public/nav.vue'
    export default {
        name: 'index',
        components:{
            vHeader,
            vNav
        },
        methods: {

        }
    }
</script>
<style>
</style>
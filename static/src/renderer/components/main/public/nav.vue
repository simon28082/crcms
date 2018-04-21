<template>
    <div class="nav">
        <div class="nav-list">
            <ul>
                <li>
                    <router-link class="avatar" to="/index/user">
                        <img src="../../../../../static/images/avatar.jpg" alt="">
                    </router-link>
                </li>
                <li>
                    <router-link to="/index/classification">
                        <Icon size="24" type="bowtie"></Icon>
                        <span>分类</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/index/modules">
                        <Icon size="24" type="planet"></Icon>
                        <span>模块</span>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'public-nav',
        methods: {

        }
    }
</script>
<style>
</style>
<template>
    <div class="classification">
        <div class="classification-menu">
            <div class="head">
                <span>模块</span>
                <router-link to="/index/modules/add"><Icon type="plus"></Icon></router-link>
            </div>
            <div class="list">
                <div class="list-item">
                    <ul>
                        <li>
                            <router-link to="/index/modules/list">
                                <i class="iconfont icon-gifts"></i>
                                <span>所有模块(12)</span>
                            </router-link>
                        </li>
                        <li>
                            <a href="">
                                <i class="iconfont icon-office"></i>
                                <span>分类模块(2)</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="iconfont icon-lights"></i>
                                <span>新闻模块(2)</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="iconfont icon-box"></i>
                                <span>文章模块(2)</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="list-item">
                    <ul>
                        <li>
                            <a href="">
                                <i class="iconfont icon-survey"></i>
                                <span>关注模块(0)</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="iconfont icon-favorites"></i>
                                <span>收藏模块(2)</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="list-item">
                    <ul>
                        <li>
                            <a href="">
                                <i class="iconfont icon-process"></i>
                                <span>模块广场(10)</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="classification-cont">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>

    export default {
        name: 'modules',
        data(){
            return {

            }
        },
        methods: {

        },
        created(){

        }
    }
</script>
<style>
</style>
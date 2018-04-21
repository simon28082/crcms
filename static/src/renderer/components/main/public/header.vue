<template>
    <header class="header">
        <div class="head-left">
            <router-link to="/index" class="logo"><img src="../../../../../static/images/basic/logo.png" alt=""></router-link>
            <div class="search">
                <input type="text" placeholder="Search..." />
            </div>
            <div class="fast-link">
                <router-link to="">企业版</router-link>
                <router-link to="">会员</router-link>
                <router-link to="">IDE</router-link>
                <router-link to="">CI</router-link>
                <router-link to="">冒泡</router-link>
            </div>
        </div>
        <div class="head-center">
            <span class="user">ZhangChaosheng</span>
        </div>
        <div class="head-right">
            <div class="right-item">
                <Dropdown>
                    <a href="javascript:void(0)">
                        <Icon type="plus" size="18"></Icon>
                    </a>
                    <DropdownMenu slot="list">
                        <DropdownItem>驴打滚</DropdownItem>
                        <DropdownItem>炸酱面</DropdownItem>
                        <DropdownItem>豆汁儿</DropdownItem>
                        <DropdownItem>冰糖葫芦</DropdownItem>
                        <DropdownItem>北京烤鸭</DropdownItem>
                    </DropdownMenu>
                </Dropdown>
            </div>
            <div class="right-item">
                <Dropdown>
                    <a href="javascript:void(0)">
                        <Icon type="ios-bell" size="20"></Icon>
                    </a>
                    <DropdownMenu slot="list">
                        <DropdownItem>驴打滚</DropdownItem>
                        <DropdownItem>炸酱面</DropdownItem>
                        <DropdownItem>豆汁儿</DropdownItem>
                        <DropdownItem>冰糖葫芦</DropdownItem>
                        <DropdownItem>北京烤鸭</DropdownItem>
                    </DropdownMenu>
                </Dropdown>
            </div>
            <div class="right-item">
                <Dropdown>
                    <a href="javascript:void(0)">
                        <Icon type="heart" size="18"></Icon>
                    </a>
                    <DropdownMenu slot="list">
                        <DropdownItem>驴打滚</DropdownItem>
                        <DropdownItem>炸酱面</DropdownItem>
                        <DropdownItem>豆汁儿</DropdownItem>
                        <DropdownItem>冰糖葫芦</DropdownItem>
                        <DropdownItem>北京烤鸭</DropdownItem>
                    </DropdownMenu>
                </Dropdown>
            </div>
            <div class="right-item avatar-item">
                <Dropdown>
                    <a class="avatar-item-head" href="javascript:void(0)">
                        <img src="../../../../../static/images/avatar.jpg" alt="">
                        <Icon type="ios-arrow-down" size="18"></Icon>
                    </a>
                    <DropdownMenu slot="list">
                        <DropdownItem>驴打滚</DropdownItem>
                        <DropdownItem>炸酱面</DropdownItem>
                        <DropdownItem>豆汁儿</DropdownItem>
                        <DropdownItem>冰糖葫芦</DropdownItem>
                        <DropdownItem>北京烤鸭</DropdownItem>
                    </DropdownMenu>
                </Dropdown>
            </div>
        </div>
    </header>
</template>
<script>
    export default {
        name: 'public-header',
        methods: {

        }
    }
</script>
<style>
</style>
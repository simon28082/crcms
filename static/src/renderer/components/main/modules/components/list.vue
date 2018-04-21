<template>
    <div class="module-list-cont">
        <div class="head">
            <span class="name">所有模块</span>
            <div class="handle"></div>
        </div>
        <div class="search">
            <div class="search-left">
                <a class="active" href="">开启</a>
                <a href="">隐藏</a>
                <a href="">禁止</a>
            </div>
            <div class="search-right">
                <input type="text" placeholder="输入模块关键字">
                <div class="icon"><i class="iconfont icon-search"></i></div>
            </div>
        </div>
        <template v-if="moduleList.length > 0">
            <div class="list module-list">
                <div v-for="item in moduleList" class="module-list-item">
                    <div class="col icon">
                        <i class="iconfont icon-shoes"></i>
                    </div>
                    <div class="col name">
                        {{item.name}}
                    </div>
                    <div class="col namespace">
                        {{item.namespace}}
                    </div>
                    <div class="col status">
                        {{item.status}}
                    </div>
                    <div class="col handle">
                        <a href="javascript:;" @click="edit(item)">编辑</a>
                        <a href="">应用</a>
                        <a href="javascript:;" @click="remove(item.id)">删除</a>
                    </div>
                </div>
            </div>
            <modal :modalShow.sync="modalShow" modalName="编辑模块">
                <addModule :modalShow.sync="modalShow" :isEdit="true" @getList="getList"></addModule>
            </modal>
        </template>
        <template v-else>
            <noData text="没有任何模块">
                <a href="">去添加</a>
            </noData>
        </template>
    </div>
</template>

<script>
    import { getModuleList,removeModule } from '../../../../api/index';
    import noData from '../../../common/noData';
    import modal from '../../../common/modal';
    import addModule from './add';
    import mixin from '../../../../mixin/index';
    export default {
        name: "module-list",
        mixins:[mixin],
        data(){
            return {
                moduleList:[
                    {
                        name:"产品分类模块",
                        namespace:"asdadsasdads",
                        status:1
                    }
                ],
                modalShow:false
            }
        },
        components:{
            noData,
            modal,
            addModule
        },
        methods:{
            remove(id){
                this.$Modal.confirm({
                    title: "删除提示",
                    content: "确认删除这个模块",
                    onOk: () => {
                        removeModule(id)
                            .then(()=>{
                                this.successFormat("删除成功");
                                this.getList();
                            })
                    },
                    onCancel: () => {

                    }
                });
            },
            edit(item){
                this.modalShow = true;
                this.$store.commit('editObjInit',item);
            },
            getList(){
                getModuleList()
                    .then( response => {
                        this.moduleList = response.data.data;
                    })
                    .catch( error => {
                        console.log(error)
                    })
            }
        },
        created(){
            this.getList();
            this.$store.commit('editObjInit',"123");
        }
    }
</script>

<style scoped>

</style>
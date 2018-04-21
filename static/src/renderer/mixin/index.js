/**
 * Created by Administrator on 2018/4/15 0015.
 */
import Vue from 'vue';
import iView from 'iview';
Vue.use(iView);

let mixin = {
    methods:{
        warnPrompt(desc){
            this.$Notice.warning({
                title: '错误提示',
                desc
            });
        },
        successFormat(desc='操作成功'){
            this.$Message.success(desc);
        },
        successBack(desc,route){
            this.successFormat(desc);
            let timer = setTimeout(()=>{
                clearInterval(timer);
                this.$router.push({
                    path:route
                })
            },1000)
        },
        cloneObj(obj){
            return JSON.parse(JSON.stringify(obj))
        }
    }
};

export default mixin;

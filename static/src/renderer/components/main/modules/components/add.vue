<template>
    <div class="add-module-cont">
        <div class="head" v-if="!isEdit">
            <span class="name">添加模块</span>
            <div class="handle"></div>
        </div>
        <div class="form">
            <div class="add-module-form">
                <Form ref="formValidate"
                      :model="formValidate"
                      :rules="ruleValidate"
                      label-position="top">
                    <FormItem label="模块名称" prop="name">
                        <Input v-model="formValidate.name" placeholder="输入模块名称"></Input>
                    </FormItem>
                    <FormItem label="模块标识符" prop="sign">
                        <Input v-model="formValidate.sign" placeholder="输入模块标识符"></Input>
                    </FormItem>
                    <FormItem label="命名空间" prop="namespace">
                        <Input v-model="formValidate.namespace" placeholder="输入命名空间"></Input>
                    </FormItem>
                    <FormItem label="状态" prop="status">
                        <RadioGroup v-model="formValidate.status">
                            <Radio label="1">启用</Radio>
                            <Radio label="2">隐藏</Radio>
                            <Radio label="3">禁止</Radio>
                        </RadioGroup>
                    </FormItem>
                    <FormItem>
                        <Button type="primary" @click="handleSubmit('formValidate')">Submit</Button>
                    </FormItem>
                </Form>
            </div>
        </div>
    </div>
</template>

<script>
    import mixin from '../../../../mixin/index';
    import { addModule,editModule } from '../../../../api/index';
    export default {
        name: "add-module",
        mixins:[mixin],
        props:['isEdit','modalShow'],
        data(){
            return {
                formValidate:{
                    name:"",
                    sign:"",
                    namespace:"",
                    status:"1"
                },
                ruleValidate:{
                    name:[
                        {
                            required: true,
                            message: '请填写模块名称',
                            trigger: 'blur'
                        }
                    ],
                    sign:[
                        {
                            required: true,
                            message: '请填写模块标识符',
                            trigger: 'blur'
                        }
                    ],
                    namespace:[
                        {
                            required: true,
                            message: '请填写命名空间',
                            trigger: 'blur'
                        }
                    ]
                }
            }
        },
        methods:{
            handleSubmit(form){
                this.$refs[form].validate((valid) => {
                    if (valid) {
                        let params = this.cloneObj(this.formValidate);
                        if( this.isEdit ){
                            let id = this.$store.state.editObj.id;
                            editModule(params,id)
                                .then(response => {
                                    this.successFormat("修改成功");
                                    //重新获取数据
                                    this.$emit("getList");
                                    //关闭modal
                                    this.$emit('update:modalShow', false)
                                })
                                .catch( error => {
                                    console.log(error)
                                })
                        }else{
                            addModule(params)
                                .then(response => {
                                    this.successBack("添加成功","/index/modules/list");
                                })
                                .catch( error => {
                                    console.log(error)
                                })
                        }

                    }
                })
            }
        },
        created(){
            if( this.isEdit ){
                this.formValidate.name = this.$store.state.editObj.name;
                this.formValidate.sign = this.$store.state.editObj.sign;
                this.formValidate.namespace = this.$store.state.editObj.namespace;
                this.formValidate.status = this.$store.state.editObj.status;
            }
        }
    }
</script>

<style scoped>

</style>
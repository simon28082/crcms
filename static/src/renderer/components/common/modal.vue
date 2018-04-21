<template>
    <transition name="slide">
        <div class="slide-modal-cont" v-if="modalShow">
            <div class="slide-modal">
                <div class="slide-modal-head">
                    <span class="modal-name">{{modalName}}</span>
                    <div class="modal-close">
                        <a @click="close" href="javascript:;"><Icon type="close-round"></Icon></a>
                    </div>
                </div>
                <div class="slide-modal-body">
                    <slot></slot>
                </div>
            </div>
            <div @click="close" class="slide-modal-mask"></div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "modal",
        props:['modalShow','modalName'],
        methods:{
            close(){
                this.$emit('update:modalShow', false)
            }
        }
    }
</script>
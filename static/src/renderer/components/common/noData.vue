<template>
    <div class="no-data">
        <img src="../../../../static/images/basic/no-data.png" alt="">
        <div class="text">{{text}} <slot></slot></div>
    </div>
</template>

<script>
    export default {
        props:['text'],
        data() {
            return {

            }
        }
    }
</script>

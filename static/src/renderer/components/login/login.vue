<template>
    <div id="login" ref="login">
        <div class="login-form">
            <div class="item-title">
                <img src="../../../../static/images/basic/login.png" alt="">
            </div>
            <div class="item">
                <input v-model="username" type="text" placeholder="输入用户名" class="text" />
            </div>
            <div class="item">
                <input v-model="password" type="password" placeholder="输入密码" class="text" />
            </div>
            <div class="item form-code-item">
                <input type="text" placeholder="输入验证码" class="text" />
                <div class="code"><img src="../../../../static/images/code.jpg" alt=""></div>
            </div>
            <div class="item">
                <button @click.prevent="goLogin" class="submit-btn">登录</button>
            </div>
            <div class="item last-item">
                <router-link to="/reg">免费注册</router-link>
                <a href="">忘记密码?</a>
            </div>
        </div>
        <canvas id="login-bg"></canvas>
    </div>
</template>
<script>
    import { login } from '../../api/index';
    import mixin from '../../mixin/index';
    export default {
        name: 'login',
        mixins:[mixin],
        data(){
            return {
                username:"",
                password:""
            }
        },
        methods: {
            loginBgInit(){
                let starNum = 200;
                let canvas = document.getElementById("login-bg");
                let canvasWidth = this.$refs.login.offsetWidth;
                let canvasHeight = this.$refs.login.offsetHeight;
                canvas.width = canvasWidth;
                canvas.height = canvasHeight;
                let context = canvas.getContext("2d");
                let stars = [];
                let speed = 0.01;
                function starsInit(){
                    context.fillStyle = '#090723';
                    context.fillRect(0,0,canvasWidth,canvasHeight);
                    addArc();
                    for(let i =0; i<starNum ; i++){
                        let star = stars[i];
                        if( star.a > 0.6 ){
                            star.a -= speed;
                        }else if( star.a < 0.05 ){
                            star.a += speed;
                        }
                        star.x += star.vx;
                        if(star.x >= canvasWidth){
                            star.x = 0;
                        }else if(star.x < 0){
                            star.x = canvasWidth;
                        }
                        star.y += star.vy;
                        if(star.y >= canvasHeight){
                            star.y = 0;
                        }else if(star.y<0){
                            star.y = canvasHeight;
                        }
                        context.beginPath();
                        let bg = context.createRadialGradient(star.x, star.y, 0, star.x, star.y, star.r);
                        bg.addColorStop(0,'rgba(255,255,255,'+star.a+')');
                        bg.addColorStop(1,'rgba(255,255,255,0)');
                        context.fillStyle  = bg;
                        context.arc(star.x,star.y, star.r, 0, Math.PI*2, true);
                        context.fill();
                        context.closePath();
                    }
                }

                function addStars(){
                    for( let i=0; i<starNum; i++ ){
                        stars.push({
                            x : Math.round(Math.random()*canvasWidth),
                            y : Math.round(Math.random()*canvasHeight),
                            r : Math.random()*3,
                            a : Math.random()*0.5,
                            vx : Math.random()*0.2 - 0.1,
                            vy : Math.random()*0.2 - 0.1
                        })
                    }
                }

                function addArc(){
                    context.beginPath();
                    context.fillStyle = "rgba(82,16,44,0.5)";
                    context.arc(canvasWidth - 300,-100, 200, 0, Math.PI*2, true);
                    context.fill();
                    context.closePath();

                    context.beginPath();
                    context.fillStyle = "rgba(33,24,31,0.6)";
                    context.arc(canvasWidth - 150,300, 45, 0, Math.PI*2, true);
                    context.fill();
                    context.closePath();

                    context.beginPath();
                    context.fillStyle = "rgba(9,12,45,0.6)";
                    context.arc(canvasWidth - 350,400, 25, 0, Math.PI*2, true);
                    context.fill();
                    context.closePath();
                }

                addStars();
                starsInit();
                setInterval(starsInit,10);
            },
            goLogin(){
                login(
                   this.username,
                   this.password
                ).then( response => {
                    console.log(response);
                }).catch(error => {
                    this.warnPrompt('验证失败，但是还是要进入~');
                    localStorage.setItem('token',"123");
                    this.$router.push({
                        path:'/index'
                    });
                });
            }
        },
        mounted(){
            this.loginBgInit();
        }
    }
</script>
<style>
</style>
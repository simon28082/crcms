<template>
    <div class="reg" id="login" ref="login">
        <template v-if="!regSuccess">
            <div class="login-form">
                <div class="item-title">
                    <img src="../../../../static/images/basic/reg.png" alt="">
                </div>
                <div class="item">
                    <input v-model="username" type="text" placeholder="输入用户名" class="text" />
                </div>
                <div class="item">
                    <input v-model="password" type="password" placeholder="输入密码" class="text" />
                </div>
                <div class="item">
                    <input v-model="email" type="text" placeholder="输入邮箱地址" class="text" />
                </div>
                <div class="item form-code-item">
                    <input type="text" placeholder="输入验证码" class="text" />
                    <div class="code"><img src="../../../../static/images/code.jpg" alt=""></div>
                </div>
                <div class="item">
                    <button @click.prevent="goReg" class="submit-btn">注册</button>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="reg-success">
                <img src="../../../../static/images/basic/success.png" alt="">
                <div>恭喜您注册成功，将在{{leaveSeconds}}s后跳转到 <router-link to="/login">登录</router-link> 页面</div>
            </div>
        </template>
        <canvas id="login-bg"></canvas>
    </div>
</template>
<script>
    import { reg } from '../../api/index';
    import mixin from '../../mixin/index';
    export default {
        name: 'login',
        mixins:[mixin],
        data(){
            return {
                username:"",
                password:"",
                email:"",
                regSuccess:false,
                leaveSeconds:5,
                goSecondTimer:null
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
            goReg(){
                reg(this.username,this.password,this.email)
                    .then(response=>{

                    })
                    .catch(error=>{
                        this.regSuccess = true;
                        this.goSecond();
                    })
            },
            goSecond(){
                this.goSecondTimer = setInterval(()=>{
                    this.leaveSeconds--;
                    if( this.leaveSeconds === 0 ){
                        this.$router.push({
                            path:'/login'
                        })
                    }
                },1000)
            }
        },
        mounted(){
            this.loginBgInit();
        },
        beforeDestroy(){
            clearInterval(this.goSecondTimer);
        }
    }
</script>
<style>
</style>
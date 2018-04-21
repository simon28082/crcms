import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

const routes = [
    {
        path:'',
        redirect:"/index"
    },
    {
        path: '/login',
        name: 'login',
        component: require('@/components/login/login').default
    },
    {
        path: '/reg',
        name: 'reg',
        component: require('@/components/reg/reg').default
    },
    {
        path: '/index',
        name: 'index',
        redirect:'/index/user',
        meta:{
            requiresAuth:true
        },
        component: require('@/components/main/index').default,
        children:[
            {
                path:"user",
                name:"user",
                component:require('@/components/main/user/user').default
            },
            {
                path:"classification",
                name:"classification",
                component:require('@/components/main/classification/classification').default
            },
            {
                path:"modules",
                name:"modules",
                redirect:'/index/modules/list',
                component:require('@/components/main/modules/modules').default,
                children:[
                    {
                        path:"list",
                        name:"module-list",
                        component:require('@/components/main/modules/components/list').default
                    },
                    {
                        path:"add",
                        name:"module-add",
                        component:require('@/components/main/modules/components/add').default
                    }
                ]
            }
        ]
    },
    {
        path: '/*',
        name: 'error-404',
        redirect: '/404',
        component:require('@/components/errorPage/404').default
    }
];

const router = new Router({
    routes:routes,
    // mode: 'history',
    linkActiveClass: 'active',
});

router.beforeEach((to, from, next) => {
    let token = localStorage.getItem('token');
    if (to.matched.some(record => record.meta.requiresAuth) && (!token || token === null)) {
        window.localStorage.removeItem('token');
        next({
            path: '/login',
            //query: { redirect: to.fullPath }
        })
    } else{
        if( to.name === 'Index' ){
            next({
                path: '/index'
            })
        }else{
            next();
        }
    }
});



export default router;

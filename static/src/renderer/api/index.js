/**
 * Created by Administrator on 2018/4/15 0015.
 */
import ajax from '../ajax/index';

//登录
export const login = async (name,password) =>{
    try {
        return await ajax(`/api/v1/auth/login`, {
            name,
            password
        })
    } catch(error) {
        throw new Error(error);
    }
};


//注册
export const reg = async (name,password,email) =>{
    try {
        return await ajax(`/api/v1/auth/reg`, {
            name,
            password,
            email
        })
    } catch(error) {
        throw new Error(error);
    }
};


//模块列表
export const getModuleList = async () =>{
    try {
        return await ajax(`/api/v1/manage/modules`, {},'get')
    } catch(error) {
        throw new Error(error);
    }
};

//添加模块
export const addModule = async (params) =>{
    try {
        return await ajax(`/api/v1/manage/modules`, params)
    } catch(error) {
        throw new Error(error);
    }
};

//编辑模块
export const editModule = async (params,id) =>{
    try {
        return await ajax(`/api/v1/manage/modules/${id}`, params,'put')
    } catch(error) {
        throw new Error(error);
    }
};

//删除模块
export const removeModule = async (id) =>{
    try {
        return await ajax(`/api/v1/manage/modules/${id}`,{},'delete')
    } catch(error) {
        throw new Error(error);
    }
};
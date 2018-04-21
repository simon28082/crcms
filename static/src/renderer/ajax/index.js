/**
 * Created by Administrator on 2018/4/15 0015.
 */
import axios from 'axios';
import baseUrl from '../config/baseUrl';

let ajax = (url, data , method = 'post') => axios({
    method,
    url: `${baseUrl}${url}`,
    data
});

export default ajax;


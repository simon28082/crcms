/**
 * XSS还原原页面jquery防止和原页面冲突
 */
//如果有在jquery防止后续加载，不破坏原页面
if(__OLDJQUERY__) {
	$ = __OLDJQUERY__.noConflict(true);
} else {
	$ = null;
}

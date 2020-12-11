/**
 * Created by Administrator on 2020/12/11.
 */

/**
 * 配置编译环境和线上环境之间的切换
 *
 * baseUrl: 域名地址
 * routerMode: 路由模式
 * baseImgPath: 图片存放地址
 *
 */
let baseUrl = '';
let routerMode = 'history';
let baseImgPath = 'http://images.cangdu.org/';

if (process.env.NODE_ENV == 'development') {
	//baseUrl = 'http://cangdu.org:8001';
}else{
	baseUrl = 'http://mysweet.com/index.php?';
}

export {
	baseUrl,
	routerMode,
	baseImgPath
}

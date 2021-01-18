<?php
namespace hl\library\Session;

/**
** @ClassName: HLSessionApi
** @Description: 会话控制
** @author flamez57 <flamez57@mysweet95.com>
** @date 2021年1月18日 晚上13:41
** @version V1.0
*/
interface HLSessionApi
{
    /**
     * 初始化
     * @param $token
     * @return mixed
     */
    public function init($token = null);

    /**
     * 修改配置
     * @param $config
     * @return static
     */
    public function setConfig($config);

    /**
     * 获取session
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * 设置session
     * @param $key
     * @param $value
     * @return static
     */
    public function set($key, $value);

    /**
     * 保存session
     * @return mixed
     */
    public function save();

    /**
     * 删除session
     * @param $key
     * @return static
     */
    public function delete($key);

    /**
     * 清除session
     * @return mixed
     */
    public function destroy();

    /**
     * 获取Token
     * @return mixed
     */
    public function getToken();
}

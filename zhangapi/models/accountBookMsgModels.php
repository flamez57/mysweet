<?php
namespace zhangapi\models;
/**
** @ClassName: accountBookMsgModels
** @Description: 文章
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class accountBookMsgModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'blog';

    /*
    ** 操作类型
    */
    const TYPE_1 = 1;
    const TYPE_2 = 2;
    const TYPE_3 = 3;
    const TYPE_4 = 4;
    const TYPE_5 = 5;
    const TYPE_6 = 6;
    const TYPE_7 = 7;

    const TYPE_MAP = [
        self::TYPE_1 => '对方请求修改性别',
        self::TYPE_2 => '对方请求退出账单',
        self::TYPE_3 => '对方请求将您移出账单',
        self::TYPE_4 => '对方请求加入您得账单',
        self::TYPE_5 => '对方邀请您加入账单（放弃自己账单加入）',
        self::TYPE_6 => '您还没有关联账单是否创建新账单',
        self::TYPE_7 => '对方忘记密码，请求初始化密码',
    ];
    
    /*
    ** 数据表
    */
    public $tableName = 'yx_account_book_msg';
    /*
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '操作类型',
  `accept_mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '接收人手机号',
  `accept_member_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '接受人',
  `send_member_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发起人',
  `created_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发起时间',
     */
    
    public function __construct()
    {
        parent::__construct();
    }

    public function doSql($sql, $db = '')
    {
        return $this->query($sql, $db);
    }

    public function insert($param = [])
    {
        $this->db->insert($this->tableName, $param);
    }
}

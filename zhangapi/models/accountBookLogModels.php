<?php
namespace zhangapi\models;
/**
** @ClassName: accountBookLogModels
** @Description: 文章
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class accountBookLogModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'blog';

    /*
    ** 消费类型
    */
    const TYPE_YI = 1;
    const TYPE_SHI = 2;
    const TYPE_ZHU= 3;
    const TYPE_XING = 4;
    const TYPE_T_X = 5;
    const TYPE_W_Z = 6;
    const TYPE_J_J = 7;
    const TYPE_J_Y = 8;
    const TYPE_S = 9;
    const TYPE_T_K = 10;
    const TYPE_OTHER = 11;

    const TYPE_MAP = [
        self::TYPE_YI => '衣',
        self::TYPE_SHI => '食',
        self::TYPE_ZHU => '住',
        self::TYPE_XING => '行',
        self::TYPE_T_X => '通讯',
        self::TYPE_W_Z => '外债',
        self::TYPE_J_J => '交际',
        self::TYPE_J_Y => '教育',
        self::TYPE_S => '税',
        self::TYPE_T_K => '退款',
        self::TYPE_OTHER => '其他',
    ];

    /*
    ** 消费对象
    */
    const OBJ_SELF = 0;
    const OBJ_CHILD = 1;
    const OBJ_M_F = 2;
    const OBJ_W_F = 3;

    const OBJ_MAP = [
        self::OBJ_SELF => '自己',
        self::OBJ_CHILD => '孩子',
        self::OBJ_M_F => '爷爷奶奶',
        self::OBJ_W_F => '外公外婆',
    ];
    
    /*
    ** 数据表
    */
    public $tableName = 'yx_account_book_log';
    /*
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account_book_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '账本id',
  `year` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '年',
  `month` tinyint(4) NOT NULL DEFAULT '1' COMMENT '月',
  `day` tinyint(4) NOT NULL DEFAULT '1' COMMENT '日',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别：0女士 1男士',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '简要',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '流向 0支出   1收入',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型 衣食住行等',
  `obj` tinyint(4) NOT NULL DEFAULT '1' COMMENT '对象 自己父母孩子',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '金额',
  `content` text COMMENT '明细',
  `log` text COMMENT '修改日志',
  `member_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `created_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
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

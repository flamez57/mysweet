# mysweet
<h5>环境需要</h5>
注意需要支持命名空间

<h6>Apache 配置</h6>

1）首先需要apache开启重定向，修改httpd.conf配置：

    查找：
    Options FollowSymLinks 
    AllowOverride None
    改为： 
    Options FollowSymLinks 
    AllowOverride All

2）去掉下面的注释 

    LoadModule rewrite_module modules/mod_rewrite.so      //去掉行前的#


<h6>Nginx 重定向配置</h6>

    # nginx rewrite  rule 
    rewrite ^(.*)/(.*)_(.*)_(.*).html$ $1/index.php?m=$2&c=$3&a=$4 last;
    # end nginx rewrite rule

<h5>框架结构</h5>

    application 应用示例
    hl 框架核心
    config 框架配置

<h5>路由</h5>

1)生成连接

    \hl\HLRoute::makeUrl($model, $controller, $action);

2)获取参数

    \hl\HLRoute::getParam($key, $value);

<h5>数据响应</h5>
1)json

    \hl\library\Tools\HLResponse::json(200, 'success', $data);

2)xml

    \hl\library\Tools\HLResponse::xmlToEncode(200, 'success', $data);

3)综合

    \hl\library\Tools\HLResponse::show(200, 'success', $data, 'xml');

<h5>配置</h5>

1)common

    'url_mode' => 0, 0非美化url  1美化后url
	'module' => 'application', 默认模块
	'controller' => 'index', 默认控制器
	'action' => 'index' 默认方法

2)db

    'default' => [ 默认连接库
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'port' => '3306'
    ], 

<h5>视图</h5>

1)js文件引入

    \hl\HLView::js($path)

2)css文件引入

    \hl\HLView::css($path)

3)图片引入

    \hl\HLView::img($path, $param)
4)传入模板参数

    \hl\HLView::param($key, $value)

5)引入模板

    \hl\HLView::showTpl($path)


mysqli db
=========

An easy to use mysqli class with php!

### Inserting Data
数组的形势插入数据到表里

@param $table string 要插入的表

@param $data array 要插入的数据

@param $isReplace bool 插入方式 true 替换根据唯一键
@return bool
```php
$this->db->insert($this->tableName, ['aa' => 'sdfsd'.$i]);
```



### Deleting Data
按数组条件删除数据

@param $table string 表名

@param $where array 条件（后面专门对条件写法介绍）
```php
$this->db->delete($this->tableName, ['id' => 2]);
``` 



### Selecting Data
使用数组作为参数选择表的行

@param $table string 表名
    
@param $fields string|array 查询字段
    
@param $where array 条件 （后面专门对条件写法介绍）

```php
$c = $this->db->select($this->tableName, '*', ['id' => ['lt', 5]]);
foreach ($c as $_v) {
    echo $_v['id'].'--'.$_v['aa'].'<hr>';
}
```    
  
   
### Updating Data   
修改表行按数组条件

@param $table string 表名

@param $data array 更新的数据 ['aa' => 'dd'] | ['aa' => ['aa + 1']]

@param $where array 条件 （后面专门对条件写法介绍）
```php
$this->db->update($this->tableName, ['aa' => '李白'], ['id' => 3]);
```       
 
### Where Condition   
exp 链接表达式
```php
['id' => ['exp', 'aa + 1']]
```  
neq | !=  不等于
```php
['id' => ['neq', 1]]
['id' => ['!=', 1]]
```  

eq | = 等于
```php
['id' => ['eq', '1']]
['id' => ['=', '1']]
['id' => '1']
```  
gt 大于
```php
['id' => ['gt', '1']]
```  
gte | egt 大于等于
```php
['id' => ['egt', '1']]
['id' => ['gte', '1']]
```  
lt 小于
```php
['id' => ['lt', '1']]
```  
lte | elt 小于等于
```php
['id' => ['lte', '1']]
['id' => ['elt', '1']]
```  
between 区间 前毕后开
```php
['id' => ['between', '1', '2']]
```  
like 模糊匹配
```php
['id' => ['like', 'aa']]
```  
or 或关系
```php
['id' => ['or', '1', '2', '3', ...]]
```  
intersection 交集
```php
['id' => ['intersection', '表达式1', '表达式2', ...]] //各表达式之间或关系外层not
```  
in 指定若干
```php
['id' => ['in', [1,2,3,4]]]
```  
nin 不在这几个指定内
```php
['id' => ['nin', [1,2,3,4]]
```  

Excel
=========
数据读取
### xlsx
```php
$xlsx = new \hl\library\Tools\Excel\HLXLSXReader($path);
//获取表名
$sheetNames = $xlsx->getSheetNames();
//读取第一个表数据
$sheet = $xlsx->getSheet($sheetNames[1]);
//读取数据
$excels = $sheet->getData();
//去除第一个行
array_shift($excels);
var_dump($excels);
```
### xls
```php
$reader = new \hl\library\Tools\Excel\HLXlsReader($path);
//默认读取第一张表
$excels_tmp = $reader->dump();
//去除第一个行
array_shift($excels_tmp);
foreach ($excels_tmp as $_excel) {
    $excels[] = array_values($_excel);
}
var_dump($excels);
```

### csv
```php
$csv = new \hl\library\Tools\Excel\HLCsvReader();
$data = $csv->getData($path);
var_dump($data);
```

### csv 导出
```php
//实例化类
$csv = new \hl\library\Tools\Excel\HLPutoutCsv();
//设置表名
$csv->setTableName('aa22');
//设置表头
$csv->setTableHead(['id', 'aa']);
//导出数据
$csv->putout($c);
```

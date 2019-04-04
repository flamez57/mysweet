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

File
=====
        $create_path = '/vagrant/data/掌声/在/那里';
### 实例化文件对象
        $f = new \hl\library\Tools\Files\HLFile();/*
### 创建文件夹
        if($f->createDir($create_path)) echo '创建目录成功'; else '创建目录失败';
### 创建文件
        if($f->createFile($create_path.'/创建的文件.txt',true)) echo '创建文件成功!'; else echo '创建文件失败!';
### 读取文件
        $a = $f->readFile($create_path.'/创建的文件.txt');
### 服务器允许的最大上传字节
        $b = $f->allowUploadSize();
### 字节格式化
        $c = $f->byteFormat(145236987412563);
### 删除非空目录
        $f->removeDir($create_path, true);
### 获取取得文件完整名称(带后缀名)
        echo $f->getBasename($create_path.'创建的文件.txt');
### 取得文件后缀名
        echo $f->getExt($create_path.'创建的文件.txt');
### 取得上N级目录
        echo $f->fatherDir($create_path.'创建的文件.txt', 0); echo '<br>';
        echo $f->fatherDir($create_path.'创建的文件.txt', 1);echo '<br>';
        echo $f->fatherDir($create_path.'创建的文件.txt', 2);echo '<br>';
        echo $f->fatherDir($create_path.'创建的文件.txt', 3);echo '<br>';
### 删除文件
        if($f->unlinkFile($create_path.'创建的文件.txt')) echo '删除文件成功!'; else '删除文件失败!';
### 操作文件
        if($f->handleFile($create_path.'创建的文件.txt',$create_path.'创建的文件3.txt','copy',true))
            echo '复制文件成功!';
        else
            echo '复制文件失败!';
        if($f->handleFile($create_path.'创建的文件2.txt', $create_path.'创建的文件5.txt','move',true))
            echo '文件移动成功!';
        else
            echo '文件移动失败!';
### 操作文件夹
        if($f->handleDir('/vagrant/data/掌声/在','/vagrant/data/掌声/在这好','copy',true))
            echo '复制文件夹成功!';
        else
            echo '复制文件夹失败!';
        if($f->handleDir('/vagrant/data/掌声/在这','/vagrant/data/掌声/在这是啥','move',true))
            echo '移动文件夹成功!';
        else
            echo '移动文件夹失败!';
### 读取文件内容
        echo $f->getTempltes($create_path.'创建的文件.txt');
### 重命名
        $f->reName($create_path.'创建的文件5.txt', $create_path.'没事看这里.txt');
### 取得文件夹信息
        print_r($f->getDirInfo('/vagrant/data/掌声'));
### 替换统一格式路径
        echo $f->dirReplace("c:\d/d\\e/d\h");
### 取得指定条件的文件夹中的文件
        print_r($f->listDirInfo($create_path,true));
### 取得文件夹信息
        print_r($f->dirInfo($create_path));
### 判断文件夹是否为空
        if($f->isEmpty($create_path)) echo '为空'; else echo'不为空';
### 返回指定文件和目录的信息
        print_r($f->listInfo($create_path));
### 返回关于打开文件的信息
        print_r($f->openInfo($create_path.'没事看这里.txt'));
### 取得文件路径信息
        print_r($f->getFileType($create_path));
### 改变文件和目录的相关属性
        $f->changeFile($create_path, 'mode', '0777');
### 取得上传文件信息
        var_dump($f->getUploadFileInfo('name'));
### 文件命名
        echo $f->setFileName('hash');
### 下载远程文件
        var_dump($f->downRemoteFile('https://img01.sldlcdn.com/G0/M02/00/0F/CgIAiFt28-yIKIdWAAAAPDaASdYAAAG0gM22p0AAABU885.jpg', $create_path));
### 指定文件编码
        $f->changeFileCode($create_path.'没事看这里.txt','utf-8');
### 指定文件编码
        $f->changeDirFilesCode($create_path, 'utf-8');

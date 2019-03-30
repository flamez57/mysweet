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


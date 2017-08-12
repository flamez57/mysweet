# mysweet
cms系统

insert($data, $isReplace = false)  插入数据
showCreate()  查看建表语句
fetchOne($field, $wheres = [])  查询一个值
getRow($wheres = [], $field = '*')  查一行值
fetchRow($sql)查一行
getAll($wheres = [], $field = '*')  查全部
fetchAll($sql)
->where()->find();
->where()->findRow(Array $field);
->where()->group($field)->order($field)->page($page, $pageSize)->findAll(Array $field);
->lastSql; 执行的sql

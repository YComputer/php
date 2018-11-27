sqlite3 查看表结构
select * from sqlite_master where type="table" and name="emperors";

user 表
CREATE TABLE users(uid integer primary key  autoincrement, name varchar(512) not null, pwd varchar(512) not null);
INSERT INTO users (name, pwd) VALUES ('xiaobing', 'xiaobing');
// sql 转义bug
$sql = "SELECT * FROM users WHERE name='{$_POST['name']}' AND pwd='{$_POST['pwd']}'";
// 用户注入
$_POST['user'] = 'john';
$_POST['pwd'] = "' OR ''='";
// 真正执行的sql语句
SELECT * FROM users WHERE name='xiaobing' AND pwd='' OR ''='';
// 解决办法：mysql real_escape_string、PDO quote、预处理、参数化查询（parameterized SQL statements）

sqlite3 查看表结构
select * from sqlite_master where type="table" and name="emperors";

user 表
CREATE TABLE users(uid integer primary key  autoincrement, name varchar(512) not null, pwd varchar(512) not null);
INSERT INTO users (name, pwd) VALUES ('xiaobing', 'xiaobing');
// sql 注入攻击
$sql = "SELECT * FROM users WHERE name='{$_POST['name']}' AND pwd='{$_POST['pwd']}'";
// 用户注入
$_POST['user'] = 'john';
$_POST['pwd'] = "' OR ''='";
// 真正执行的sql语句
SELECT * FROM users WHERE name='xiaobing' AND pwd='' OR ''='';
// 解决办法：mysql real_escape_string、PDO quote、预处理、参数化查询（parameterized SQL statements）https://stackoverflow.com/questions/5857386/how-to-avoid-sql-injection-in-codeigniter
<!-- CodeIgniter's Active Record methods automatically escape queries for you, to prevent sql injection.

$this->db->select('*')->from('tablename')->where('var', $val1);
$this->db->get();
or

$this->db->insert('tablename', array('var1'=>$val1, 'var2'=>$val2));
If you don't want to use Active Records, you can use query bindings to prevent against injection.

$sql = 'SELECT * FROM tablename WHERE var = ?';
$this->db->query($sql, array($val1));
Or for inserting you can use the insert_string() method.

$sql = $this->db->insert_string('tablename', array('var1'=>$val1, 'var2'=>$val2));
$this->db->query($sql);
There is also the escape() method if you prefer to run your own queries.

$val1 = $this->db->escape($val1);
$this->db->query("SELECT * FROM tablename WHERE var=$val1"); -->
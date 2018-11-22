# web-programming

查看表结构
select * from sqlite_master where type="table" and name="categories";

products 表结构
table|products|products|4|CREATE TABLE products (pid integer primary key autoincrement, catid integer, name varchar(512), price decimal(11, 2), description varchar(65535), foreign key (catid) references categories(catid))
table|products|products|4|CREATE TABLE products (
    pid integer primary key autoincrement, 
    catid integer, 
    name varchar(512), 
    price decimal(11, 2), 
    description varchar(65535), 
    img BLOB, 
    foreign key (catid) references categories(catid))

categories 表结构
table|categories|categories|2|CREATE TABLE categories(catid integer primary key  autoincrement, name varchar(512) not null)

ALTER TABLE products ADD COLUMN img BLOB; 




INSERT INTO TEST (ID,NAME)
VALUES (1, 'Paul');


You Need To Run Tow Commends

first, change ownership of the laravel directory to web group

sudo chown -R :www-data /var/www/yourLarvelFolder

Give privileges over storage directory so it can be writeable.

sudo chmod -R 775 /var/www/yourLarvelFolder/storage
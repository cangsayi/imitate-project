-- --------------------------------------------------
-- 文件名: novel.sql 
-- novel项目安装数据库所在的文件
-- 作者： 小飒
-- --------------------------------------------------



# --------------------------------------------------------
# 表的结构 users ,该表用于
# --------------------------------------------------------

DROP TABLE IF EXISTS cms_users;
CREATE TABLE cms_users (
  id INT(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  nickname varchar(20) NOT NULL UNIQUE,
  username VARCHAR(20) NOT NULL UNIQUE,
  password VARCHAR(40) NOT NULL,
  sex ENUM('0','1','2') NOT NULL DEFAULT '0',
  email VARCHAR(40) NOT NULL,
  address VARCHAR(40) NOT NULL,
  PRIMARY KEY  (id)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

# --------------------------------------------------------
# 表的结构 admin,该表用于
# --------------------------------------------------------

DROP TABLE IF EXISTS cms_admin;
CREATE TABLE cms_admin (
  id TINYINT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(20) NOT NULL UNIQUE,
  password VARCHAR(40) NOT NULL,
  email VARCHAR(40) NOT NULL,
  PRIMARY KEY  (id)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

# --------------------------------------------------------
# 表的结构 category,该表用于
# --------------------------------------------------------

DROP TABLE IF EXISTS cms_category;
CREATE TABLE cms_category (
  id TINYINT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  pId TINYINT(1) UNSIGNED NOT NULL,
  name varchar(20) NOT NULL,
  image varchar(100) NOT NULL DEFAULT 'images/category/default.jpg',
  sort TINYINT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY  (id)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;


# --------------------------------------------------------
# 表的结构 author该表用于栏目
# --------------------------------------------------------

DROP TABLE IF EXISTS cms_author;
CREATE TABLE cms_author (
  id INT(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  nickname varchar(20) NOT NULL UNIQUE,
  userId INT(7) NOT NULL,
  hasBook ENUM('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY  (id)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;
# --------------------------------------------------------
# 表的结构 books,该表用于
# --------------------------------------------------------

DROP TABLE IF EXISTS cms_books;
CREATE TABLE cms_books (
  id INT(7) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(20) NOT NULL UNIQUE,
  image varchar(40) NOT NULL UNIQUE,
  authorId INT(7) UNSIGNED NOT NULL,
  categoryId TINYINT(1) UNSIGNED NOT NULL,
  createTime  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (id)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO cms_category (pId,name) VALUES('0', '男生'),('0','女生');


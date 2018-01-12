
--数据库的名字
--DATABASE php1210

--创建管理表
CREATE TABLE admin(
  id INT UNSIGNED PRIMARY KEY  AUTO_INCREMENT comment "主键",
  a_name VARCHAR(32)  NOT NULL comment "登录名",
  a_pwd CHAR(128) NOT NULL comment '密码'，
  a_truename VARCHAR(32) NOT NULL DEFAULT '' comment  '真名',
  a_avatar VARCHAR(128) NOT NULL DEFAULT '' comment '头像',
  a_role INT UNSIGNED NOT NULL DEFAULT 0 comment '角色',
  a_sex CHAR(1) NOT NULL DEFAULT 0 comment '性别',
  a_last_ip VARCHAR(128) NOT NULL DEFAULT '' comment '最后登录的ip',
  a_last_time DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' comment '最后登录时间'
) ENGINE = InnoDB;
insert into admin values(default,'admin',md5('123'),'administrator','',0,0,'0.0.0.0','0000-00-00 00:00:00');


-- 创建类别数据表
create table category(
c_id int unsigned primary key auto_increment comment '主键',
c_name varchar(32) not null default '' comment '分类名',
c_desc varchar(32) not null default '' comment '分类描述',
c_sort tinyint unsigned not null default 50 comment '排序',
c_time int unsigned comment '创建时间',
c_pid int unsigned
)charset utf8;

-- 创建文章表
create table article(
a_id int unsigned primary key auto_increment comment '主键',
a_title varchar(32) not null default '' comment '文章标题',
a_desc varchar(128) not null default '' comment '文章描述', 
a_content text not null comment '文章内容', 
a_author int unsigned comment '文章作者',  #存储的当前登陆的用户的id 
a_time int unsigned comment '创建时间',
a_click int unsigned comment '浏览次数' default 0,
a_like int unsigned comment '点赞' default 0,
a_comment int unsigned comment '评论数' default 0,
c_id int unsigned comment '所属分类',
a_img varchar(128) comment '图片',
a_thumber varchar(128) comment '缩略图',
a_water varchar(128) comment '水印图'
)charset utf8;

--创建评论表
--use blog;
-- 创建评论表
create table reply(
r_id int unsigned primary key auto_increment comment '主键',
r_content varchar(256) not null default '' comment '内容',
r_time int unsigned comment '评论时间',
u_id int unsigned comment '回复人',
a_id int unsigned comment '所评论的文章',
r_pid int unsigned comment '对评论的回复'
)charset utf8;






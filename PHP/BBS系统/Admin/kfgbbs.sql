#创建数据库
create database kfgbbs;
use kfgbbs;
drop table if exists user;
create table user(
id int unsigned primary key auto_increment comment '主键',
user_name varchar(50) not null unique comment '用户名',
user_pwd varchar(50) not null default '' comment '用户密码',
user_email varchar(50)  default null  unique comment '邮箱',
user_role int not null default '0' comment '角色0:普通用户1管理员',
user_upload varchar(50) not null default 'default.jpg' comment '上传头像',
user_icon varchar(50) not null default 'default.jpg' comment '用户头像',
user_allowed int not null default '1' comment '用户禁言1正常发言0禁言'
)charset utf8;

insert into user value(default,'admin',md5('admin'),'admin@bbs.com','1',default,default,default);
insert into user value(default,'leon1',md5('admin'),'leon1@bbs.com',default,default,default,default);



#创建专区表
drop table if exists area;
create table area(
id int unsigned primary key auto_increment comment '主键',
area_name varchar(20) not null unique comment '专区名',
area_role int not null default '1' comment '专区权限1所有用0只有管理员',
area_del int not null default '1' comment '是否已删除'
)charset utf8;

insert into area value(default,'综合交流专区',default,default),
	(default,'BUG反馈专区',default,default),
	(default,'活动交流专区','0',default),
	(default,'新闻公告专区','0',default);

	
=================================	
	
	
	
#创建帖子表
drop table if exists publish;
create table publish(
	id int unsigned primary key auto_increment comment '主键ID',
	pub_owner varchar(20) not null comment '发帖人',
	pub_title varchar(50) not null comment '帖子标题',
	pub_content text not null comment '发帖内容',
	pub_time datetime not null comment '发帖时间',
	pub_hits int unsigned not null default 0 comment '帖子浏览次数',
	pub_like int unsigned not null default 0 comment '帖子点赞数',
	pub_top smallint unsigned not null default 0 comment '帖子是否置顶，1置顶0否',
	pub_area varchar(20) not null comment '所属专区名',
	pub_del smallint not null default '1' comment '帖子删除，1未被删除，0已被删除',
	pub_apply_top smallint not null default '0' comment '是否请求置顶1请求置顶0未请求置顶'
)charset utf8;

insert into publish value
	(default,'leon','leon1','leon1leon1leon1','2017-12-19 17:59:44',default,default,default,'综合交流专区',default,'0'),
	(default,'leon','leon2','leon2leon2leon2','2017-12-19 15:59:44',default,default,default,'综合交流专区',default,'1');
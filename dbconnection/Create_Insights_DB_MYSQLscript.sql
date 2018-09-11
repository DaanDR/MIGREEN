create database insights_db;
create table insights_db.user (
userID int not null auto_increment,
userName varchar(45) not null default 'unknownUserName',
name varchar(45) not null,
company varchar(45) not null default 'unknownCompany',
role varchar(45) not null default 'user',
Constraint pk_userID primary key (userID)
);

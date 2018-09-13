drop schema if exists insights_db;
create database insights_db;
use insights_db;
create table insights_db.role (
role varchar(45) not null unique default 'user',
sessionDuration_hour int not null default '24',
dashboard_link varchar(255),
Constraint pk_role primary key (role)
);
insert into insights_db.role values (
'admin','1', 'link');
insert into insights_db.role values (
'user','24', 'link');
create table insights_db.user (
userID int not null auto_increment,
userName varchar(45) not null unique default 'unknownUserName',
password varchar(45) not null default '123456',
firstname varchar(45) not null,
lastname varchar(45) not null,
role varchar(45) not null default 'user',
Constraint pk_userID primary key (userID),
Constraint fk_user_role foreign key(role)
references role(role)
on update no action
on delete no action
);
CREATE TABLE `insights_db`.`customer` (
  `customerName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`customerName`),
  UNIQUE INDEX `customerName_UNIQUE` (`customerName` ASC));
INSERT INTO `insights_db`.`customer` (`customerName`) VALUES ('De Eerste Klant');
INSERT INTO `insights_db`.`customer` (`customerName`) VALUES ('De Tweede Klant');



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
password varchar(255) not null default '123456',
firstname varchar(45) not null,
lastname varchar(45) not null,
email varchar(45) not null,
role varchar(45) not null default 'user',
status_active boolean not null default TRUE,
Constraint pk_userID primary key (userID),
Constraint fk_user_role foreign key(role)
references role(role)
on update no action
on delete no action
);
CREATE TABLE insights_db.customer (
  customerName VARCHAR(45) unique NOT NULL,
  PRIMARY KEY (customerName)
);
INSERT INTO insights_db.customer (customerName) VALUES ('De Eerste Klant');
INSERT INTO insights_db.customer (customerName) VALUES ('De Tweede Klant');
create table insights_db.environment (
systemName varchar(45) unique not null,
customerName varchar(45),
vmURL varchar(255),
status_active boolean not null default TRUE,
Constraint pk_systemName primary key (systemName),
Constraint fk_environment_customer foreign key(customerName)
references customer(customerName)
on update no action
on delete no action
);
INSERT INTO `insights_db`.`user` (`userID`, `userName`, `password`, `firstname`, `lastname`, `email`, `role`, `status_active`) VALUES ('1', 'Test1234', '$2y$10$1iYgTdCtHt1R01db6DdlBeYZXYY34g.VnwZG2jrydvzX8QZVWJaGy', 'Tester', 'Tester', 'test@test.nl', 'admin', '1');
INSERT INTO `insights_db`.`environment` (`systemName`, `customerName`, vmURL, `status_active`) VALUES ('Testomgeving1', 'De Eerste Klant', 'link', '1');
INSERT INTO `insights_db`.`environment` (`systemName`, `customerName`, vmURL, `status_active`) VALUES ('Testomgeving2', 'De Tweede Klant', 'link','1');


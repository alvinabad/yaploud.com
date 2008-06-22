DROP TABLE IF EXISTS banned_users;
CREATE TABLE banned_users(
   id bigint NOT NULL AUTO_INCREMENT,
   username varchar(64) NULL,
   ip varchar(32) NOT NULL,
   date_created datetime NOT NULL,
   voter varchar(64) NULL,
   domainname varchar(256),
   PRIMARY KEY (id)
) type = MyISAM;

alter table banned_users add unique (domainname, ip, voter);
alter table banned_users add constraint foreign key (username) references user(username) ON DELETE CASCADE;


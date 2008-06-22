DROP TABLE IF EXISTS moderators;
CREATE TABLE moderators(
   id bigint NOT NULL AUTO_INCREMENT,
   username varchar(64),
   date_created datetime NOT NULL,
   domainname varchar(936) NOT NULL,
   PRIMARY KEY (id)
) type = MyISAM;

alter table moderators ADD UNIQUE (username, domainname);
alter table moderators add constraint foreign key (username) references user(username) ON DELETE CASCADE;


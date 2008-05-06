DROP TABLE IF EXISTS invited_friends;
CREATE TABLE invited_friends (
   id bigint NOT NULL AUTO_INCREMENT,
   userid varchar(32) NOT NULL,
   email varchar(968) NOT NULL,
   FULLTEXT(email),
   PRIMARY KEY (id)
) type = MyISAM;

alter table invited_friends ADD UNIQUE (userid, email);
alter table invited_friends add constraint foreign key (userid) references user (userid) ON DELETE CASCADE;


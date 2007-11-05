CREATE TABLE user (
  email varchar(64) NOT NULL,
  username varchar(64) NOT NULL,
  password varchar(32) NOT NULL,
  update_timestamp datetime NOT NULL,
  last_name varchar(32) NOT NULL,
  first_name varchar(32) NOT NULL,
  description varchar(2048) default NULL,
  user_icon varchar(256) default NULL,
  cookie char(32) NOT NULL default '',
  ip varchar(15) NOT NULL default '',
  session char(32) NOT NULL default '',
  userid varchar(32) NOT NULL,
  PRIMARY KEY  (`email`),
  UNIQUE (userid)
) type=MyISAM;

create index user_email_idx on dev.user (email); 
create index user_username_idx on dev.user (username); 

CREATE TABLE chat (
   id int NOT NULL AUTO_INCREMENT,
   topic_url varchar(2096) NOT NULL,
   submitter varchar(32) NOT NULL,
   creation_date datetime NOT NULL,
   msg varchar(256) NOT NULL,
   PRIMARY KEY (id)
) type = MyISAM;

create index msg_id_idx on dev.chat (id);
create index topic_idx on dev.chat (topic_url);
create index time_idx on dev.chat (creation_date);

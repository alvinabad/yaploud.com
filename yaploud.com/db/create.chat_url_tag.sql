DROP TABLE IF EXISTS chat_url_tag;
CREATE TABLE chat_url_tag (
   id bigint NOT NULL AUTO_INCREMENT,
   chat_url_id integer not null,
   tag varchar(996) NOT NULL,
   FULLTEXT(tag),
   PRIMARY KEY (id)
) type = MyISAM;

alter table chat_url_tag ADD UNIQUE (chat_url_id, tag);
alter table chat_url_tag add constraint foreign key (chat_url_id) references chat_url (chat_url_id) ON DELETE CASCADE;


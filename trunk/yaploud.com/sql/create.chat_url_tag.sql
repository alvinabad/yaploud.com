CREATE TABLE chat_url_tag (
   id int NOT NULL AUTO_INCREMENT,
   chat_url_id integer not null,
   tag varchar(1024) NOT NULL,
   FULLTEXT(tag),
   PRIMARY KEY (id)
) type = MyISAM;

alter table chat_url_tag add constraint foreign key (chat_url_id) references chat_url (chat_url_id) ON DELETE CASCADE;
create unique index chat_url_tag_idx on chat_url_tag (chat_url_id);

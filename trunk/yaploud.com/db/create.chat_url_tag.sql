CREATE TABLE chat_url_tag (
   id bigint NOT NULL AUTO_INCREMENT,
   chat_url_id integer not null,
   tag varchar(1000) NOT NULL,
   FULLTEXT(tag),
   PRIMARY KEY (id)
) type = MyISAM;

create unique index chat_url_tag_idx on chat_url_tag (tag);
alter table chat_url_tag add constraint foreign key (chat_url_id) references chat_url (chat_url_id) ON DELETE CASCADE;
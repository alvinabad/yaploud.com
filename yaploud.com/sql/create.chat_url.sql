CREATE TABLE chat_url (
   id int NOT NULL AUTO_INCREMENT,
   url varchar(2096) NOT NULL UNIQUE,
   title varchar(4096),
   description TEXT,
   creation_date datetime NOT NULL,
   FULLTEXT(title, description),
   PRIMARY KEY (id)
) type = MyISAM;

create index creation_date_idx on dev.chat (creation_date);

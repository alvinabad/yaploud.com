
CREATE TABLE chat_url (
   id bigint NOT NULL AUTO_INCREMENT,
   url varchar(1000) NOT NULL UNIQUE,
   title varchar(2048),
   description TEXT,
   votes int,
   average_rating float,
   creation_date datetime NOT NULL,
   FULLTEXT(title, description),
   PRIMARY KEY (id)
) type = MyISAM;

create index chat_url_creation_date_idx on chat_url (creation_date);

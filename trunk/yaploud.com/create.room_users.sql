CREATE TABLE room_users (
  username varchar(64) NOT NULL,
  topic_url varchar(256) NOT NULL,
  creation_date datetime NOT NULL,
  session varchar(32) NOT NULL,
  INDEX rooms_user_idx(username, topic_url)
) type=MyISAM;

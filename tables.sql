CREATE TABLE users (
  id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  role enum('Author','Admin') DEFAULT NULL,
  password varchar(255) NOT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT NULL
);

CREATE TABLE posts (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id int(11) DEFAULT NULL,
  title varchar(255) NOT NULL,
  slug varchar(255) NOT NULL UNIQUE,
  views int(11) NOT NULL DEFAULT '0',
  image varchar(255) NOT NULL,
  body text NOT NULL,
  published tinyint(1) NOT NULL,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE topics (
  id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name varchar(255) NOT NULL,
  slug varchar(255) NOT NULL UNIQUE
);

CREATE TABLE post_topic (
  id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  post_id int(11) DEFAULT NULL UNIQUE,
  topic_id int(11) DEFAULT NULL,
  FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (topic_id) REFERENCES topics (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);
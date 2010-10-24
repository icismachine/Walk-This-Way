-- create table for logging generic events

CREATE TABLE user (
  id BIGINT(20) NOT NULL AUTO_INCREMENT,
  phone_id VARCHAR(64),
  twitter_handle VARCHAR(64),
  created DATETIME,
  PRIMARY KEY (id)
);

CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type` varchar(64) DEFAULT NULL,
  `event_details` varchar(64) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_user_fk` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

CREATE TABLE question (
  id INT NOT NULL AUTO_INCREMENT,
  text varchar(2048),
  answer_a varchar(2048),
  answer_b varchar(2048),
  answer_c varchar(2048),
  answer_d varchar(2048),
  answer varchar(2048),
  created DATETIME,
  PRIMARY KEY (`ID`)
);

-- user's responses to questions are stored here
CREATE TABLE answer (
  id INT NOT NULL AUTO_INCREMENT,  
  question_id INT,
  user_id INT,
  choice varchar(2048),
  correct boolean, 
  created DATETIME,
  PRIMARY KEY (`ID`),
  CONSTRAINT answer_user_fk FOREIGN KEY(user_id) REFERENCES user(id)  
);

CREATE TABLE tweets (
  id INT NOT NULL AUTO_INCREMENT,
  raw_json varchar(2048),
  body varchar(140),
  twitter_id bigint(15),
  twitter_username varchar(64),
  PRIMARY KEY (`ID`)
);

CREATE TABLE round (
  id INT NOT NULL AUTO_INCREMENT,
  winner varchar(64),
  question varchar(2048),
  PRIMARY KEY (`ID`)
);

CREATE TABLE score (
  id INT NOT NULL AUTO_INCREMENT,
  amt INT,
  round_id INT,
  user_id INT, 
  PRIMARY KEY (`ID`),
  CONSTRAINT answer_user_fk FOREIGN KEY(user_id) REFERENCES user(id)  
);

insert into question (text, answer_a, answer_b, answer_c, answer_d, answer, created) values ('What is the name of the San Francisco football team?', '49ers', 'Raiders', 'Chargers', 'Packers', 'a', now());

insert into question (text, answer_a, answer_b, answer_c, answer_d, answer, created) values ('What is the name of the San Francisco baseball team?', 'Giants', 'Raiders', 'Chargers', 'Packers','a',now());

insert into question (text, answer_a, answer_b, answer_c, answer_d, answer, created) values ('What is the name of a team that packs?', 'Giants', 'Raiders', 'Chargers', 'Packers', 'd', now());

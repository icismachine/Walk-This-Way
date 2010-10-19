-- create table for logging generic events

CREATE TABLE user (
  id BIGINT(20) NOT NULL AUTO_INCREMENT,
  phone_id VARCHAR(64),
  created DATETIME,
  PRIMARY KEY (id)
);

CREATE TABLE event (
  id INT NOT NULL AUTO_INCREMENT,
  event_type VARCHAR(64),
  event_details VARCHAR(64),    
  user_id INT,
  created DATETIME,
  PRIMARY KEY (`ID`),
  CONSTRAINT event_user_fk FOREIGN KEY(user_id) REFERENCES user(id)
);

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

insert into question (text, answer_a, answer_b, answer_c, answer_d, answer, created) values ('What is the name of the San Francisco football team?', '49ers', 'Raiders', 'Chargers', 'Packers', 'a', now());

insert into question (text, answer_a, answer_b, answer_c, answer_d, answer, created) values ('What is the name of the San Francisco baseball team?', 'Giants', 'Raiders', 'Chargers', 'Packers','a',now());

insert into question (text, answer_a, answer_b, answer_c, answer_d, answer, created) values ('What is the name of a team that packs?', 'Giants', 'Raiders', 'Chargers', 'Packers', 'd', now());

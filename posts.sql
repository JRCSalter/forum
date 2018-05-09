CREATE TABLE posts(
id INT NOT NULL AUTO_INCREMENT,
content TEXT,
author INT,
thread INT,
postTime DATETIME,
FOREIGN KEY (author) REFERENCES users(id),
FOREIGN KEY (thread) REFERENCES threads(id),
PRIMARY KEY (id)
);
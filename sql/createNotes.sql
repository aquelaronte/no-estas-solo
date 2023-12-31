DROP TABLE IF EXISTS notes;

CREATE TABLE notes(
  id INTEGER AUTO_INCREMENT PRIMARY KEY,
  id_user INTEGER NOT NULL,
  title VARCHAR(100) NOT NULL,
  description VARCHAR(150) DEFAULT "",
  FOREIGN KEY (id_user) REFERENCES users(id)
);
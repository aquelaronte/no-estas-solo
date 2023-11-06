
CREATE TABLE tips (
  id INTEGER AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  id_psychologist INTEGER NOT NULL,
  FOREIGN KEY(id_psychologist) REFERENCES users(id)
);
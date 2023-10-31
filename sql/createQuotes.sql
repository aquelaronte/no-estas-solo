DROP TABLE IF EXISTS quotes;

CREATE TABLE quotes (
  id INTEGER AUTO_INCREMENT PRIMARY KEY,
  id_student INTEGER NOT NULL,
  id_psychologist INTEGER,
  title VARCHAR(100) NOT NULL,
  description VARCHAR(255) NOT NULL,
  appointment_date VARCHAR(100),
  creation_date VARCHAR(100) NOT NULL,
  finished BOOLEAN DEFAULT FALSE,
  state VARCHAR(100) NOT NULL DEFAULT "en espera",
  FOREIGN KEY(id_student) REFERENCES users(id),
  FOREIGN KEY(id_psychologist) REFERENCES users(id)
)
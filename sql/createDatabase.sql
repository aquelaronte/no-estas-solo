DROP DATABASE IF EXISTS no_estas_solo;

CREATE DATABASE no_estas_solo;
USE no_estas_solo;

CREATE TABLE users (
  id INTEGER AUTO_INCREMENT PRIMARY KEY, 
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE, 
  password VARCHAR(50) NOT NULL, 
  phone VARCHAR(50) NOT NULL, 
  address VARCHAR(100) DEFAULT "", 
  grade VARCHAR(10) NOT NULL, 
  role VARCHAR(10) NOT NULL, 
  age VARCHAR(10) NOT NULL,
  description VARCHAR(200) DEFAULT ""
);

CREATE TABLE notes(
  id INTEGER AUTO_INCREMENT PRIMARY KEY,
  id_user INTEGER NOT NULL,
  title VARCHAR(100) NOT NULL,
  description VARCHAR(255) DEFAULT "",
  FOREIGN KEY (id_user) REFERENCES users(id)
);

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
);

CREATE TABLE tips (
  id INTEGER AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  id_psychologist INTEGER NOT NULL,
  FOREIGN KEY(id_psychologist) REFERENCES users(id)
);
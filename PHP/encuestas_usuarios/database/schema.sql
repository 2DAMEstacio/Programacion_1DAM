CREATE DATABASE IF NOT EXISTS encuestas_usuarios CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE encuestas_usuarios;

DROP TABLE IF EXISTS votos;
DROP TABLE IF EXISTS opciones;
DROP TABLE IF EXISTS preguntas;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  creado_en DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE preguntas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  texto VARCHAR(255) NOT NULL,
  activa TINYINT(1) DEFAULT 1
);

CREATE TABLE opciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pregunta_id INT NOT NULL,
  texto VARCHAR(255) NOT NULL,
  votos INT DEFAULT 0,
  FOREIGN KEY (pregunta_id) REFERENCES preguntas(id) ON DELETE CASCADE
);

CREATE TABLE votos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  pregunta_id INT NOT NULL,
  opcion_id INT NOT NULL,
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(usuario_id, pregunta_id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (pregunta_id) REFERENCES preguntas(id) ON DELETE CASCADE,
  FOREIGN KEY (opcion_id) REFERENCES opciones(id) ON DELETE CASCADE
);

INSERT INTO preguntas (texto, activa) VALUES
('¿Qué lenguaje te gustaría practicar más este trimestre?', 1);

INSERT INTO opciones (pregunta_id, texto, votos) VALUES
(1, 'PHP', 0),
(1, 'JavaScript', 0),
(1, 'Python', 0),
(1, 'Java', 0);

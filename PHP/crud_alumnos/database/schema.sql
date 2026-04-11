CREATE DATABASE IF NOT EXISTS alumnos_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE alumnos_db;

CREATE TABLE IF NOT EXISTS alumnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    edad INT NOT NULL,
    curso VARCHAR(50) NOT NULL
);

INSERT INTO alumnos (nombre, email, edad, curso) VALUES
    ('Ana Martinez', 'ana.martinez@ies.local', 18, '1DAM'),
    ('Pablo Gomez', 'pablo.gomez@ies.local', 19, '1DAM'),
    ('Lucia Navarro', 'lucia.navarro@ies.local', 20, '1DAM'),
    ('Sergio Ruiz', 'sergio.ruiz@ies.local', 21, '2DAM'),
    ('Marta Lopez', 'marta.lopez@ies.local', 18, '2DAW'),
    ('David Torres', 'david.torres@ies.local', 22, '1ASIR'),
    ('Carla Perez', 'carla.perez@ies.local', 19, '2ASIR'),
    ('Hugo Sanchez', 'hugo.sanchez@ies.local', 20, '1DAW');

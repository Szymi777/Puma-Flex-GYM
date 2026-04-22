CREATE DATABASE logowanie_sesje CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci;
USE logowanie_sesje;

CREATE TABLE uzytkownicy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    haslo VARCHAR(255) NOT NULL
);

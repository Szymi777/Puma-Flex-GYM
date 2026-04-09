CREATE DATABASE IF NOT EXISTS pumaflex_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pumaflex_db;

-- Tabela Użytkowników
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela Trenerów
CREATE TABLE trainers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specialization VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255) DEFAULT 'default_trainer.jpg'
);

-- Tabela Karnetów
CREATE TABLE memberships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    features TEXT NOT NULL
);

-- Tabela Zajęć (Grafik)
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trainer_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    class_time DATETIME NOT NULL,
    max_participants INT DEFAULT 15,
    FOREIGN KEY (trainer_id) REFERENCES trainers(id) ON DELETE CASCADE
);

-- Tabela Rezerwacji (Zajęcia i Treningi Personalne)
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    class_id INT DEFAULT NULL,
    trainer_id INT DEFAULT NULL,
    booking_type ENUM('class', 'personal') NOT NULL,
    booking_time DATETIME NOT NULL,
    status ENUM('active', 'cancelled') DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE,
    FOREIGN KEY (trainer_id) REFERENCES trainers(id) ON DELETE CASCADE
);

-- Tabela Logów (np. do zapisu powodu usunięcia konta)
CREATE TABLE deletion_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    deleted_user_email VARCHAR(100),
    reason TEXT NOT NULL,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- --- DANE STARTOWE ---

-- Hasło dla admina i usera to: 'haslo123' (zhashowane w PHP password_hash)
INSERT INTO users (name, email, password_hash, role) VALUES 
('Administrator', 'admin@pumaflex.pl', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Jan Kowalski', 'jan@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

INSERT INTO trainers (name, specialization, description) VALUES 
('Adam "Głaz" Nowak', 'Trójbój siłowy', 'Wielokrotny mistrz Polski w trójboju. Z nim zbudujesz surową siłę.'),
('Anna Lewandowska', 'Zumba & Fitness', 'Wulkan energii. Spalanie tkanki tłuszczowej to jej specjalność.'),
('Michał "Kulturysta" Wiśniewski', 'Sylwetka & Posing', 'Przygotowanie do zawodów sylwetkowych i perfekcyjne proporcje.'),
('Kasia "Fizjo" Kowal', 'Rehabilitacja & Mobility', 'Naprawi Twoje barki i kolana. Bezpieczny trening to podstawa.'),
('Piotr "Kettlebell" Zieliński', 'Cross trening', 'Wyciśnie z Ciebie siódme poty na strefie old school.'),
('Marta "Zen" Wójcik', 'Odnowa biologiczna', 'Zadba o Twój relaks i optymalną regenerację po ciężkim boju.');

INSERT INTO memberships (name, price, features) VALUES 
('Standard', 149.00, 'Dostęp 24/7, strefa wolnych ciężarów, darmowe izotoniki'),
('Premium', 199.00, 'Wszystko co w Standard + zajęcia grupowe + strefa relaksu'),
('VIP Elite', 399.00, 'Pełny dostęp + strefa VIP + 2 treningi personalne + opieka lekarska');

INSERT INTO classes (trainer_id, name, class_time, max_participants) VALUES 
(2, 'Zumba Ogień', '2026-04-10 18:00:00', 20),
(1, 'Podstawy Martwego Ciągu', '2026-04-11 19:30:00', 8);
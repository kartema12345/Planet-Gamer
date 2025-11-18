
-- Database structure for Planet Gamer (sample)
CREATE DATABASE IF NOT EXISTS planetgamer_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE planetgamer_db;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(200) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200),
  short_desc TEXT,
  long_desc TEXT,
  price DECIMAL(10,2),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NULL,
  product_id INT NOT NULL,
  amount DECIMAL(10,2),
  status VARCHAR(50) DEFAULT 'pending',
  external_id VARCHAR(200),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (title, short_desc, long_desc, price) VALUES
('Conta RS3 - 2700 Total', 'Conta full pronta para bossing.', 'Conta preparada com itens e skills para bossing, cliente precisa apenas logar.', 450.00),
('Conta OSRS - Pure PK', 'Build perfeita para PK.', 'Conta otimizada para PK com stats e equipamentos adequados.', 320.00);

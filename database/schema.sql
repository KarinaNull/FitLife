CREATE DATABASE IF NOT EXISTS fitlife CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fitlife;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    nickname VARCHAR(128) NOT NULL,
    email VARCHAR(255) NOT NULL,
    is_confirmed TINYINT(1) NOT NULL DEFAULT 0,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    password_hash VARCHAR(255) NOT NULL DEFAULT '',
    auth_token VARCHAR(255) NOT NULL DEFAULT '',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uk_users_nickname (nickname),
    UNIQUE KEY uk_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE articles (
    id INT NOT NULL AUTO_INCREMENT,
    author_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    text TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL,
    PRIMARY KEY (id),
    KEY idx_articles_author (author_id),
    CONSTRAINT fk_articles_author FOREIGN KEY (author_id) REFERENCES users (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE comments (
    id INT NOT NULL AUTO_INCREMENT,
    author_id INT NOT NULL,
    article_id INT NOT NULL,
    text TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_comments_article (article_id),
    CONSTRAINT fk_comments_author FOREIGN KEY (author_id) REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT fk_comments_article FOREIGN KEY (article_id) REFERENCES articles (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE contacts (
    id INT NOT NULL AUTO_INCREMENT,
    last_name VARCHAR(100) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100) NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    birth_date DATE NOT NULL,
    phone VARCHAR(32) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    comment TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE feedback_messages (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (nickname, email, is_confirmed, role, password_hash) VALUES
('coach_anna', 'anna@fitlife.local', 1, 'admin', ''),
('trainer_max', 'max@fitlife.local', 1, 'user', ''),
('nutrition_kate', 'kate@fitlife.local', 1, 'user', '');

INSERT INTO articles (author_id, name, text) VALUES
(1, 'Разминка перед тренировкой', 'Правильная разминка снижает риск травм и повышает эффективность занятий. Начните с 5–7 минут лёгкого кардио и динамической растяжки основных групп мышц.'),
(2, 'Силовая программа для начинающих', 'Три тренировки в неделю: приседания, жим, тяга. Работайте в диапазоне 8–12 повторений, постепенно увеличивая рабочий вес.'),
(3, 'Баланс БЖУ в повседневном рационе', 'Белки поддерживают мышцы, жиры — гормоны, углеводы — энергию. Следите за дефицитом или профицитом калорий в зависимости от цели.');

INSERT INTO comments (author_id, article_id, text) VALUES
(2, 1, 'Отличная статья! Добавила упражнения на мобильность суставов.'),
(3, 2, 'Сколько отдыха между подходами вы рекомендуете?');

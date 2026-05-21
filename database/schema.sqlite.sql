CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nickname VARCHAR(128) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    is_confirmed INTEGER NOT NULL DEFAULT 0,
    role TEXT NOT NULL DEFAULT 'user' CHECK(role IN ('admin', 'user')),
    password_hash VARCHAR(255) NOT NULL DEFAULT '',
    auth_token VARCHAR(255) NOT NULL DEFAULT '',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS articles (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    author_id INTEGER NOT NULL,
    name VARCHAR(255) NOT NULL,
    text TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL,
    FOREIGN KEY (author_id) REFERENCES users (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS comments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    author_id INTEGER NOT NULL,
    article_id INTEGER NOT NULL,
    text TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (article_id) REFERENCES articles (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS contacts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    last_name VARCHAR(100) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100) NOT NULL DEFAULT '',
    gender TEXT NOT NULL CHECK(gender IN ('male', 'female')),
    birth_date DATE NOT NULL,
    phone VARCHAR(32) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    comment TEXT NOT NULL DEFAULT '',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS feedback_messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(128) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT OR IGNORE INTO users (id, nickname, email, is_confirmed, role, password_hash) VALUES
(1, 'coach_anna', 'anna@fitlife.local', 1, 'admin', ''),
(2, 'trainer_max', 'max@fitlife.local', 1, 'user', ''),
(3, 'nutrition_kate', 'kate@fitlife.local', 1, 'user', '');

INSERT OR IGNORE INTO articles (id, author_id, name, text) VALUES
(1, 1, 'Разминка перед тренировкой', 'Правильная разминка снижает риск травм и повышает эффективность занятий. Начните с 5–7 минут лёгкого кардио и динамической растяжки основных групп мышц.'),
(2, 2, 'Силовая программа для начинающих', 'Три тренировки в неделю: приседания, жим, тяга. Работайте в диапазоне 8–12 повторений, постепенно увеличивая рабочий вес.'),
(3, 3, 'Баланс БЖУ в повседневном рационе', 'Белки поддерживают мышцы, жиры — гормоны, углеводы — энергию. Следите за дефицитом или профицитом калорий в зависимости от цели.');

INSERT OR IGNORE INTO comments (id, author_id, article_id, text) VALUES
(1, 2, 1, 'Отличная статья! Добавила упражнения на мобильность суставов.'),
(2, 3, 2, 'Сколько отдыха между подходами вы рекомендуете?');

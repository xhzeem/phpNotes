CREATE DATABASE notes_app;

USE notes_app;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, 
    coins INT NOT NULL DEFAULT 0
);

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO notes_app.notes (id, title, content) VALUES (1, 'Secret note', 'FLAG{7c6483ddcd99eb112c060ecbe0543e86}');
INSERT INTO notes_app.notes (id, title, content) VALUES (0, 'Hidden note', 'FLAG{7c6483dd8899eb112c060ecbe0543e86}');
INSERT INTO users (id, username, password) VALUES (2, "FLAG{67113a029bf9f33a1b53977419f70fb2}", "e49bc3e4dd35d4e76273a37815cf4cc83fde02c0");
INSERT INTO users (id, username, password) VALUES (1, "admin", "e49bc3e4dd35d4e76273a37815cf4cc83fde02c0");
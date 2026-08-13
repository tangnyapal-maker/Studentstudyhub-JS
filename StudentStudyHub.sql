-- Student Study Hub Database

CREATE DATABASE student_study_hub;


-- Connect to student_study_hub before running the tables

CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE resources (
    resource_id SERIAL PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    resource_type VARCHAR(50),
    link VARCHAR(255)
);

CREATE TABLE contacts (
    contact_id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password)
VALUES
('Student User', 'student@example.com', 'student123');

INSERT INTO resources (title, description, resource_type, link)
VALUES
('Study Notes', 'Helpful notes for students', 'Notes', '#'),
('Past Papers', 'Past examination papers', 'Past Papers', '#'),
('Online Tutorials', 'Useful learning tutorials', 'Tutorial', '#');

INSERT INTO contacts (name, email, message)
VALUES
('Student User', 'student@example.com', 'I would like more study resources.');

SELECT * FROM users;
SELECT * FROM resources;
SELECT * FROM contacts;
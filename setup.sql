-- Setup script for Student Management System Database

-- Create database
CREATE DATABASE IF NOT EXISTS schoolproject;
USE schoolproject;

-- Create user table
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255),
    phone VARCHAR(20),
    usertype VARCHAR(50),
    password VARCHAR(255) NOT NULL,
    class_id INT,
    FOREIGN KEY (class_id) REFERENCES class(id)
);

-- Create teacher table
CREATE TABLE IF NOT EXISTS teacher (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    description TEXT,
    image VARCHAR(255)
);

-- Create class table
CREATE TABLE IF NOT EXISTS class (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Alter user table to add class_id if not exists
ALTER TABLE user ADD COLUMN class_id INT DEFAULT NULL;
ALTER TABLE user ADD CONSTRAINT fk_user_class FOREIGN KEY (class_id) REFERENCES class(id);

-- Alter courses table to add class_id if not exists
ALTER TABLE courses ADD COLUMN class_id INT DEFAULT NULL;
ALTER TABLE courses ADD CONSTRAINT fk_courses_class FOREIGN KEY (class_id) REFERENCES class(id);

-- Create admission table
CREATE TABLE IF NOT EXISTS admission (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(20),
    message TEXT
);

-- Create courses table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    teacher_id INT,
    class_id INT,
    FOREIGN KEY (teacher_id) REFERENCES teacher(id),
    FOREIGN KEY (class_id) REFERENCES class(id)
);

-- Insert sample data for user table
INSERT INTO user (username, email, phone, usertype, password, class_id) VALUES
('admin', 'admin@example.com', '1234567890', 'admin', 'admin123', NULL),
('student1', 'student1@example.com', '0987654321', 'student', 'student123', 1),
('student2', 'student2@example.com', '1122334455', 'student', 'student456', 2);

-- Insert sample data for teacher table
INSERT INTO teacher (name, description, image) VALUES
('John Doe', 'Experienced math teacher with 10 years of experience.', 'image/teacher1.png'),
('Jane Smith', 'Science teacher specializing in biology.', 'image/teacher2.png'),
('Bob Johnson', 'English literature professor.', 'image/teacher3.png');

-- Insert sample data for class table
INSERT INTO class (name) VALUES
('Class 1'),
('Class 2');

-- Insert sample data for admission table
INSERT INTO admission (name, email, phone, message) VALUES
('Alice Brown', 'alice@example.com', '555-1234', 'I am interested in enrolling in the science program.'),
('Charlie Wilson', 'charlie@example.com', '555-5678', 'Please consider my application for admission.'),
('Diana Prince', 'diana@example.com', '555-9012', 'Excited to join the student community!');

-- Insert sample data for courses table
INSERT INTO courses (name, description, teacher_id, class_id) VALUES
('Mathematics', 'Basic to advanced math concepts.', 1, 1),
('Science', 'Biology, Chemistry, Physics.', 2, 1),
('English Literature', 'Classic and modern literature.', 3, 2);

-- Insert sample data for enrollments table
INSERT INTO enrollments (student_id, course_id, enrollment_date) VALUES
(2, 1, '2026-01-01'),
(2, 2, '2026-01-01'),
(3, 3, '2026-01-01');
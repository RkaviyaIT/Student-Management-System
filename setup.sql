-- Setup script for Student Management System Database

-- Drop database if exists
DROP DATABASE IF EXISTS schoolproject;

-- Create database
CREATE DATABASE IF NOT EXISTS schoolproject;
USE schoolproject;

-- Create roles table
CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT
);

-- Create permissions table
CREATE TABLE IF NOT EXISTS permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

-- Create role_permissions table
CREATE TABLE IF NOT EXISTS role_permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    UNIQUE(role_id, permission_id)
);

-- Create user table with role_id and hashed password
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255),
    phone VARCHAR(20),
    role_id INT,
    password VARCHAR(255) NOT NULL,
    class_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Create teacher table
CREATE TABLE IF NOT EXISTS teacher (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    description TEXT,
    image VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Create class table
CREATE TABLE IF NOT EXISTS class (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);

-- Create sections table
CREATE TABLE IF NOT EXISTS sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    class_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE CASCADE
);

-- Create subjects table
CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);

-- Create class_subjects table
CREATE TABLE IF NOT EXISTS class_subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_id INT NOT NULL,
    subject_id INT NOT NULL,
    teacher_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_id) REFERENCES teacher(id),
    UNIQUE(class_id, subject_id)
);

-- Create students table (subset of users with role student)
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    roll_number VARCHAR(50),
    section_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (section_id) REFERENCES sections(id)
);

-- Create student_enrollments table
CREATE TABLE IF NOT EXISTS student_enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    class_subject_id INT NOT NULL,
    enrollment_date DATE NOT NULL,
    status ENUM('active', 'inactive', 'completed') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (class_subject_id) REFERENCES class_subjects(id) ON DELETE CASCADE,
    UNIQUE(student_id, class_subject_id)
);

-- Create admission table
CREATE TABLE IF NOT EXISTS admission (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(20),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create materials table
CREATE TABLE IF NOT EXISTS materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    file_path VARCHAR(500),
    file_type ENUM('pdf', 'video', 'link', 'document') DEFAULT 'document',
    subject_id INT,
    uploaded_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (subject_id) REFERENCES subjects(id),
    FOREIGN KEY (uploaded_by) REFERENCES user(id)
);

-- Create material_access_logs table
CREATE TABLE IF NOT EXISTS material_access_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_id INT NOT NULL,
    user_id INT NOT NULL,
    access_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    FOREIGN KEY (material_id) REFERENCES materials(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

-- Create audit_logs table
CREATE TABLE IF NOT EXISTS audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255) NOT NULL,
    table_name VARCHAR(100),
    record_id INT,
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Insert sample roles
INSERT INTO roles (name, description) VALUES
('admin', 'Administrator with full access'),
('teacher', 'Teacher role'),
('student', 'Student role');

-- Insert sample permissions
INSERT INTO permissions (name, description) VALUES
('view_users', 'Can view user list'),
('edit_users', 'Can edit users'),
('delete_users', 'Can delete users'),
('view_students', 'Can view students'),
('edit_students', 'Can edit students'),
('view_teachers', 'Can view teachers'),
('edit_teachers', 'Can edit teachers'),
('view_classes', 'Can view classes'),
('edit_classes', 'Can edit classes'),
('view_subjects', 'Can view subjects'),
('edit_subjects', 'Can edit subjects'),
('view_materials', 'Can view materials'),
('upload_materials', 'Can upload materials'),
('view_reports', 'Can view reports');

-- Assign permissions to roles
INSERT INTO role_permissions (role_id, permission_id) VALUES
(1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (1, 7), (1, 8), (1, 9), (1, 10), (1, 11), (1, 12), (1, 13), (1, 14), -- admin all
(2, 4), (2, 5), (2, 8), (2, 10), (2, 11), (2, 12), (2, 13), -- teacher some
(3, 4), (3, 12); -- student limited

-- Insert sample data for user table with hashed passwords
INSERT INTO user (username, email, phone, role_id, password, class_id) VALUES
('admin', 'admin@example.com', '1234567890', 1, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL), -- password: password
('student1', 'student1@example.com', '0987654321', 3, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('student2', 'student2@example.com', '1122334455', 3, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('teacher1', 'teacher1@example.com', '1112223333', 2, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL);

-- Insert sample data for teacher table
INSERT INTO teacher (name, description, image, user_id) VALUES
('John Doe', 'Experienced math teacher with 10 years of experience.', 'image/teacher1.png', 4),
('Jane Smith', 'Science teacher specializing in biology.', 'image/teacher2.png', NULL),
('Bob Johnson', 'English literature professor.', 'image/teacher3.png', NULL);

-- Insert sample data for class table
INSERT INTO class (name) VALUES
('Class 1'),
('Class 2');

-- Insert sample data for sections table
INSERT INTO sections (name, class_id) VALUES
('Section A', 1),
('Section B', 1),
('Section A', 2);

-- Insert sample data for subjects table
INSERT INTO subjects (name, description) VALUES
('Mathematics', 'Basic to advanced math concepts.'),
('Science', 'Biology, Chemistry, Physics.'),
('English Literature', 'Classic and modern literature.');

-- Insert sample data for class_subjects table
INSERT INTO class_subjects (class_id, subject_id, teacher_id) VALUES
(1, 1, 1),
(1, 2, 2),
(2, 3, 3);

-- Insert sample data for students table
INSERT INTO students (user_id, roll_number, section_id) VALUES
(2, 'S001', 1),
(3, 'S002', 3);

-- Insert sample data for student_enrollments table
INSERT INTO student_enrollments (student_id, class_subject_id, enrollment_date) VALUES
(1, 1, '2026-01-01'),
(1, 2, '2026-01-01'),
(2, 3, '2026-01-01');

-- Insert sample data for admission table
INSERT INTO admission (name, email, phone, message) VALUES
('Alice Brown', 'alice@example.com', '555-1234', 'I am interested in enrolling in the science program.'),
('Charlie Wilson', 'charlie@example.com', '555-5678', 'Please consider my application for admission.'),
('Diana Prince', 'diana@example.com', '555-9012', 'Excited to join the student community!');

-- Insert sample data for materials table
INSERT INTO materials (title, description, file_path, file_type, subject_id, uploaded_by) VALUES
('Math Basics PDF', 'Introduction to mathematics', 'uploads/math_basics.pdf', 'pdf', 1, 4),
('Science Video', 'Biology fundamentals', 'https://example.com/science_video.mp4', 'video', 2, 4);

ALTER TABLE user ADD CONSTRAINT fk_user_class FOREIGN KEY (class_id) REFERENCES class(id);

-- Indexes for performance
CREATE INDEX idx_user_role_id ON user(role_id);
CREATE INDEX idx_user_deleted_at ON user(deleted_at);
CREATE INDEX idx_user_username ON user(username);
-- Fast student search - composite index for filtering
CREATE INDEX idx_user_class_id ON user(class_id);
CREATE INDEX idx_user_usertype ON user(usertype);
-- This index makes student search very fast (jumps directly instead of scanning all rows)
CREATE INDEX idx_student_search ON user(usertype, class_id, username);
CREATE INDEX idx_students_section_id ON students(section_id);
CREATE INDEX idx_students_deleted_at ON students(deleted_at);
CREATE INDEX idx_class_subjects_class_id ON class_subjects(class_id);
CREATE INDEX idx_class_subjects_subject_id ON class_subjects(subject_id);
CREATE INDEX idx_student_enrollments_student_id ON student_enrollments(student_id);
CREATE INDEX idx_materials_subject_id ON materials(subject_id);
CREATE INDEX idx_materials_deleted_at ON materials(deleted_at);
CREATE INDEX idx_audit_logs_user_id ON audit_logs(user_id);
CREATE INDEX idx_audit_logs_created_at ON audit_logs(created_at);
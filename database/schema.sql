CREATE DATABASE IF NOT EXISTS learnsphere CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE learnsphere;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('student','admin') NOT NULL DEFAULT 'student',
  verified TINYINT(1) NOT NULL DEFAULT 0,
  otp_hash VARCHAR(255) NULL,
  otp_expires_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(180) NOT NULL,
  category VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  instructor VARCHAR(120) NOT NULL,
  duration VARCHAR(50) DEFAULT '4 weeks',
  level ENUM('Beginner','Intermediate','Advanced') DEFAULT 'Beginner',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE enrollments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  course_id INT NOT NULL,
  status ENUM('active','completed') DEFAULT 'active',
  enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  completed_at DATETIME NULL,
  UNIQUE KEY unique_enrollment(user_id, course_id),
  FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY(course_id) REFERENCES courses(id) ON DELETE CASCADE
);

INSERT INTO courses(title,category,description,instructor,duration,level) VALUES
('Python for Beginners','Programming','Learn Python syntax, functions, collections and practical problem solving.','Apex Instructor','6 weeks','Beginner'),
('Web Development with PHP','Web Development','Build dynamic websites with PHP, MySQL, authentication and CRUD.','Apex Instructor','8 weeks','Intermediate'),
('Database Management with SQL','Database','Master tables, joins, constraints, aggregate functions and database design.','Apex Instructor','5 weeks','Beginner'),
('JavaScript & AJAX','Web Development','Create interactive web applications using JavaScript, Fetch API and AJAX.','Apex Instructor','5 weeks','Intermediate'),
('Data Structures Fundamentals','Computer Science','Understand arrays, stacks, queues, trees, sorting and searching.','Apex Instructor','7 weeks','Intermediate'),
('Career Ready Project Lab','Career','Build a portfolio project and prepare for technical interviews.','Apex Instructor','4 weeks','Advanced');

-- After registering your first account, run:
-- UPDATE users SET role='admin', verified=1 WHERE email='your@email.com';

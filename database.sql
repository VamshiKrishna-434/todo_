-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    online_status BOOLEAN DEFAULT FALSE
);

-- Create the tasks table
CREATE TABLE IF NOT EXISTS tasks (
    id SERIAL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    due_date DATE NOT NULL,
    due_time TIME NOT NULL,
    priority ENUM('red', 'yellow', 'green') NOT NULL,
    assigned_to INT,
    is_personal BOOLEAN DEFAULT FALSE,
    progress INT DEFAULT 0,
    created_by INT,
    FOREIGN KEY (assigned_to) REFERENCES users(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Insert a test user
INSERT INTO users (email, password, role, mobile, online_status) 
VALUES ('testuser@example.com', '$2y$10$somethinghashed', 'user', '1234567890', FALSE); 

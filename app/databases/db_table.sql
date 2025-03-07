-- DROP TABLE Event_Images;
-- DROP TABLE Attendance ;
-- DROP TABLE Registration;
-- DROP TABLE Events ;
-- DROP TABLE Users;
-- DROP VIEW UserWithAge;
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    prefix VARCHAR(10),
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15),
    gender ENUM('Male', 'Female', 'Other'),
    birthday DATE,
    profile_image VARCHAR(255)
);
CREATE TABLE Events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    event_types VARCHAR(50),
    participant_amount INT NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    time TIME,
    location VARCHAR(255),
    organizer_id INT,
    qr_code_att VARCHAR(255),
    text_code_att VARCHAR(255),
    FOREIGN KEY (organizer_id) REFERENCES Users(user_id) ON DELETE SET NULL
);
CREATE TABLE Registration (
    reg_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    register_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    requested_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    approved_at DATETIME NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES Events(event_id) ON DELETE CASCADE
);
CREATE TABLE Attendance (
    att_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    reg_id INT NOT NULL,
    event_id INT NOT NULL,
    checkin_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (reg_id) REFERENCES Registration(reg_id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES Events(event_id) ON DELETE CASCADE
);
CREATE TABLE Event_Images (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    image VARCHAR(255) NOT NULL,
    FOREIGN KEY (event_id) REFERENCES Events(event_id) ON DELETE CASCADE
);



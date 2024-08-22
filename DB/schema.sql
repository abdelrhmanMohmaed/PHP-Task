CREATE TABLE departments 
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT now(),
    updated_at DATETIME NOT NULL DEFAULT now(),
    
    PRIMARY KEY(id)
);

CREATE TABLE users
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    
    department_id INT UNSIGNED NOT NULL,
    manager_id INT UNSIGNED,

    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    `password` TEXT NOT NULL,
    phone VARCHAR(255) NOT NULL,
    salary DECIMAL(8,2) NOT NULL,
    avatar VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT now(),
    updated_at DATETIME NOT NULL DEFAULT now(),

    PRIMARY KEY(id),
    FOREIGN KEY(department_id) REFERENCES departments(id),
    FOREIGN KEY(manager_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE tasks 
(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,

    user_id INT UNSIGNED NOT NULL,
    created_by INT UNSIGNED,

    title VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `status` ENUM('Pending','In Progress','Complete') NOT NULL DEFAULT 'Pending',
    created_at DATETIME NOT NULL DEFAULT now(),
    updated_at DATETIME NOT NULL DEFAULT now(),
    
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(created_by) REFERENCES users(id) ON DELETE SET NULL
);
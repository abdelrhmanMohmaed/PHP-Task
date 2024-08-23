# PHP Task
 This PHP project is designed to manage employees, departments, and tasks within an organization. 


## Key features include:

- **Login Screen** Users can log in using their email or phone number with a predefined complex password.
- **Employee Management:** Add, edit, search, and delete employee records, including fields like first name, last name, salary, image, and manager name. The full name is dynamically generated and not stored in the database.
- **Department Management:** Add, edit, search, and delete departments. The search functionality provides the count of employees and the total salary within each department. Deletion of a department is restricted if employees are assigned to it.
- **Task Assignment:** Managers can assign tasks to their employees and track task statuses. Employees can view and update the status of their assigned tasks.

## Technologies Used:

- **Backend:** PHP-Native
- **Frontend:** HTML5, CSS, JavaScript, Bootstrap, JQuery, Ajax
- **Database:** MySQL

## Usage:

1. git clone https://github.com/abdelrhmanMohmaed/PHP-Task.git
2. cd project-name.
3. CREATE DATABASE php_task.
4. mysql DB/schema.sql
5. mysql DB/seed.sql
6. (http://localhost/PHP-Task/login.blade.php)



```shell 
# Login
	email: ahmed@hotmail.com or 01623843786
	password: @123456aAqw
	url: http://localhost/PHP-Task/login.blade.php
```
---

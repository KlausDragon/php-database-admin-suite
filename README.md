# Secure Database Administration Interface

## Overview
This project is a web application that enables secure and efficient management of a student database. It allows users to view, add, delete, and edit student records with robust security measures to prevent SQL injection and ensure data integrity.

## Features
- **View Student Records**: Displays the entire students table in a user-friendly HTML table format.
- **Add Student**: Includes a form for adding new student records with fields for Student Number, First Name, and Last Name.
- **Edit Student**: Allows updating existing student records with pre-populated form fields.
- **Delete Student**: Offers a secure deletion process with a confirmation step to prevent accidental deletions.
- **SQL Injection Protection**: Implements validation and sanitization to safeguard against SQL injection attacks.
- **User Feedback**: Provides immediate, clear feedback on the outcome of database operations.

## Technology Stack
- **Front-End**: HTML, CSS
- **Back-End**: PHP
- **Database**: MySQL

## Installation
1. Clone the repository to your local machine.
2. Set up a MySQL database and import the relevant tables.
3. Update `dbinfo.php` with your database connection details.
4. Host the application on a PHP-supported server.

## Usage
- Navigate to `index.php` to view the student records.
- Use the 'Add Student', 'Delete', and 'Update' options to manage records.
- Follow on-screen prompts and feedback for seamless interaction with the database.

## Security
This application employs best practices in web security, including:
- Secure database connection handling.
- Input validation and sanitization.
- Session management for maintaining state and data integrity.

## Contributing
Contributions to enhance the functionality or security of this application are welcome. Please feel free to fork the repository and submit pull requests.

## License
This project is open-sourced under the MIT License.

## Credits
Developed by Ali Abbasi - © ` + getCurrentYear() + `
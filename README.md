# QuestWise - PHP MVC Task Management Platform with Gamification

QuestWise is a task management platform built using the PHP Model-View-Controller (MVC) architecture. It incorporates gamification elements to make task management engaging and fun. This README provides an overview of QuestWise and outlines the setup and usage instructions.

## Features
- Task creation, editing, and deletion
- Categorization of tasks for better organization
- Task prioritization and assignment
- Progress tracking and completion status
- Gamification with rewards, points, and badges
- User registration and authentication
- User profile management

## Requirements
- PHP
- MySQL database
- Apache or Nginx web server

## Installation
1. Clone the repository or download the ZIP file.
2. Create a MySQL database for QuestWise.
3. Import the `database.sql` file located in the `database` folder into your MySQL database.
4. Configure the database connection in `config.php` located in the `app` folder.

## Usage
1. Set up a virtual host or configure your web server to point to the QuestWise project folder.
2. Access the website in your browser.
3. Register a new account or log in if you already have one.
4. Start creating tasks and organizing them into categories.
5. As you complete tasks, you'll earn points and unlock badges based on your progress.
6. Compete with other users to see who can complete the most tasks and earn the highest score.

## Project Structure
- `app`: Contains the core application files
    - `config.php`: Configuration file for database connection and other settings
    - `controllers`: Contains controllers to handle user requests
    - `models`: Contains models for interacting with the database
    - `views`: Contains the user interface files (HTML, CSS, JS)
- `database`: Contains the SQL file to set up the database tables
- `public`: Contains publicly accessible files (CSS, JS, images)
- `routes`: Contains the file containing the routes that can be visited on the website and the controllers and actions they are connected to.

## Credits
QuestWise was developed by [Talha Bera](https://github.com/talhabera). Special thanks to the open-source community and all contributors who made this project possible.

## Contact
If you have any questions or need further assistance, you can reach us at [support@questwise.app](mailto:support@questwise.app).

Happy Questing! 🚀

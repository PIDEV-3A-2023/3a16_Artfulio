Artfulio
Artfulio is a web application built with Symfony/Doctrine/PHP that serves as a portfolio for artists. It allows artists to showcase their work in various formats such as images, audio, and video.

Installation:

Clone the repository: git clone https://github.com/YOUR-USERNAME/Artfulio.git
Install dependencies: composer install
Configure database connection in .env file
Run migrations: php bin/console doctrine:migrations:migrate
Start the Symfony server: symfony server:start
Usage:

Open the application in your browser: http://localhost:8000
Register a new account or log in with an existing one
Navigate to the dashboard to add/edit/delete your artwork
Browse other artists' portfolios in the "Explore" section
Features:

User authentication and authorization using Symfony's security system
CRUD functionality for artwork using Doctrine ORM and Symfony forms
Ability to upload and display images, audio, and video files
Pagination and search functionality in the Explore section
Responsive design using Bootstrap

Contributing:

Contributions to Artfulio are welcome! If you want to contribute, please follow these steps:

Fork the repository:

Create a new branch: git checkout -b feature/my-new-feature
Make changes and commit them: git commit -am 'Add some feature'
Push to the branch: git push origin feature/my-new-feature
Create a pull request on GitHub
License:

Artfulio is open-source software licensed under the Esprit License.

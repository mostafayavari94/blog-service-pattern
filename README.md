#### Install using Docker

1. Clone the project.
2. Navigate to the `blog-service-pattern` folder.
3. Copy `.env.example` as `.env`.
4. Open `.env` and configure Docker according to your system (commented config in `.env.example` can be used as a reference).
5. Go to the `laravel` folder, similar to the previous step.
6. Copy `.env.example` as `.env` in the `laravel` folder.
7. Open your `.env` file and update the database name (`DB_DATABASE`), username (`DB_USERNAME`), and password (`DB_PASSWORD`) fields according to the Docker `.env`.
8. Set `DB_HOST` to `mysql` inside the `.env` file.
9. Inside the `blog-service-pattern` directory, run `docker compose --profile app --profile mysql up`.
10. Open [localhost:8001](http://localhost:8001).
11. Run `docker exec blog php artisan db:seed` in the `laravel` folder to create an admin user.
12. Feel free to ask questions from [Mostafa Yavari](mailto:Mostafayavari94@gmail.com). Enjoy!

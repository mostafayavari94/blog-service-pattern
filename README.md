#### Install using docker
- Clone project.
- Go to `blog-service-pattern` folder.
- Copy `.env.example` as `.env`.
- Open `.env` and config docker according your system(commented config in `.env.example` can be used).
- Go to `laravel` folder like previous Copy `.env.example` as `.env`.
- Open your `.env` file and change the database name (`DB_DATABASE`), username (`DB_USERNAME`) and password (`DB_PASSWORD`) fields according to docker `.env`.
- Also set `DB_HOST` to `mysql` inside `.env` file.
- Inside `blog-service-pattern` directory run `docker compose --profile app --profile mysql up`.
- Enjoy!

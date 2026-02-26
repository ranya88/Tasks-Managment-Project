## Setup postgres database 

run 
```bash
docker compose up -d
```
To launch a local postgres db for development

To test it download a postgres client and run `psql -h 127.0.0.1 -U devuser -d task_manager_db`

## Run Migrations

run `cp .env.example .env` 
then `php artisan migrate`

## Mock users(for dev)

Generate mock users as default for testing
```
#php artisan tinker
> \App\Models\User::factory(10)->create();
```
```

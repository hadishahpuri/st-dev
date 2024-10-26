
## STDev cinema ticket reservation by Hadi Shahpuri

#### This project is build with Laravel, React, CSS and Docker. For running this project please follow the structions bellow

### Build and deploy

- Download the project
- ``` cp .env.example .env ```
- set the DB_DATABASE, DB_PASSWORD variables in .env
- ```docker compose up -d --force-recreate --build```
- ```docker exec -it app composer update```
- ```docker exec -it app php artisan key:generate```
- ```docker compose up -d --force-recreate```
- ```docker exec -it app php artisan migrate:fresh --seed```
- ```docker exec -it app npm install```
- ```docker exec -it app npm run build```
- after the above commands you should be able to visit this project at: http://localhost

### Things that could be done! (But I didn't have the time)

- Use React Toastify instead of alert!
- Use Shadcn instead of Tailwind for better theme structure
- Add cancel reservation ability
- Add users login to handle multiple user reservations (Currently a default user is beeing used)

Thank you for reviewing this task!

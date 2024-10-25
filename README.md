
## STDev cinema ticket reservation by Hadi Shahpuri

#### This project is build with Laravel, React, CSS and Docker. For running this project please follow the structions bellow

### Build and deploy

- Download the project
- In the root of the project, run: docker compose up -d --force-recreate --build
- docker exec -it app composer update
- docker exec -it app php artisan migrate:fresh --seed
- docker exec -it app npm install
- docker exec -it app npm run build
- after the above commands you should be able to visit this project at: http://localhost

Thank you for reviewing this task!

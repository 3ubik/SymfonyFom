# SymfonyForm
# To run project you need 
1. Run 'make dc_build' command in SymfonyFom destination
2. Run 'make dc_start' command in SymfonyFom destination
3. Run 'make php' command in SymfonyFom destination to get into php-fpm docker container
4. Run 'composer install' in php-fpm docker container
5. Run 'php bin/console make:migration' in php-fpm docker container
5. Run 'php bin/console doctrine:migrations:migrate' in php-fpm docker container
6. Go to localhost:8080/addData to add products and countries
7. Go to localhost:8080/form to calculate price
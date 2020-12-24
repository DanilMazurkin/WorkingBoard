### Курсовая работа 
## Проект находится в разработке
Разработать доску объявлений, в которой будут реализованы следующие функции:
- Возможность создавать объявления (в объявлении должны быть картинки, текст, заголовок) (+)
- Возможность работы с профилем (загружать аватарку, данные пользователя) (+)
- Возможность отслеживать объявления каждого пользователя
- Возможность отслеживать отдельное объявление (+)
- Возможность комментировать объявления
- Возможность показать/скрыть личные данные
- Возможность показать статистику по каждому объявлению


1) > git clone https://github.com/DanilMazurkin/Workingboard.git
2) > cd Workingboard
3) > docker-compose build
4) > docker-compose up -d
5) > docker ps
6) > docker exec -it {CONTAINER_APP_ID}  bash
7) > composer install
8) > cp .env.example .env
9) In .env set 
   > DB_CONNECTION=mysql  
   > DB_HOST=db  
   > DB_PORT=3306  
   > DB_DATABASE=laraapp_db  
   > DB_USERNAME=root  
   > DB_PASSWORD=  
10) > docker exec -it {CONTAINER_APP_ID}  bash
11) > chown -R www-data:www-data /var/www
12) > chmod 755 /var/www
13) > php artisan key:generate 
14) > php artisan config:cache
15) > php artisan migrate

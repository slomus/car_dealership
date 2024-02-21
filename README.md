## Wymagania
PHP >= 8.1
Mysql
Konfiguracja pliku .env pod swoją konfiguracje

## Komendy
Aby zainicjować bazę danych, wygenerować przykładowe dane i uruchomić serwer deweloperski, wykonaj poniższe polecenia:

```bash
php artisan migrate               # Wykonuje migracje bazy danych
php artisan db:seed --class=UserSeeder    # Seeduje bazę danych danymi użytkowników
php artisan db:seed --class=CarSeeder    # Seeduje bazę danych danymi samochodów
php artisan serve    
```

## Link
Strona główna
http://127.0.0.1:8000/

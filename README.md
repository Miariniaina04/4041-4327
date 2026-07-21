# 4041-4327

1. installer composer
    ```
    composer install
    ```
2.  Renomme le env -> .env
    ```
    cp env .env
    ```
3. Donner les autorisation a codeigniter4-framework-b3359be/writable
   ```
   sudo chmod -R 755 writable
   # ou si insuffisant
   sudo chmod -R 777 writable
   ```
4. Verification du fichier writable
    ```
    touch writable/cache/test.txt && echo "OK ecriture" || echo "Echec ecriture"

    # si "echec ecriture"
    mkidir -p writable/cache writable/logs writable/session writable/uploads writable/debugbar
    ``` 
5. Migrate & seeder
    ```
    php spark migrate
    php spark db:seed DatabaseSeeder

    ## si vous rencontrer des problemes lors du migrate && seeder
    rm writable/database.db
    php spark migrate
    php spark db:seed DatabaseSeeder
    ```
6. Lancer
   ```
   php spark serve
   ```

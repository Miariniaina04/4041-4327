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
git add codeigniter4-framework-b3359be/writable/cache/.gitkeep codeigniter4-framework-b3359be/writable/logs/.gitkeep codeigniter4-framework-b3359be/writable/session/.gitkeep codeigniter4-framework-b3359be/writable/uploads/.gitkeep codeigniter4-framework-b3359be/writable/debugbar/.gitkeep codeigniter4-framework-b3359be/.gitignore
git commit -m "Fix writable"
git push

git rm --cached codeigniter4-framework-b3359be/writable/database.db
git commit -m "Ne plus versionner la base SQLite"
git push
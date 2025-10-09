PHP API PSR-4 Demo
==================
Features:
- PSR-4 autoloading
- Dynamic router (auto-load controllers by path)
- JWT Auth (login issues token)
- Auth middleware + Exception middleware
- PDO Database service (configure DB in app/Config/config.php)
- Product CRUD (id,name,size,is_available)
- Custom action routing: /api/{controller}/{customMethod}
- Swagger annotations (swagger.php + app/Docs/OpenApiMetadata.php)

Setup:
1. Unzip into your htdocs (e.g., D:/xampp/htdocs/php-api-psr4)
2. Run: composer install
3. Create database and table (see app/Config/sql.sql)
4. Adjust DB credentials in app/Config/config.php
5. Start Apache or run: php -S localhost:8000 -t public
6. Access API via: http://localhost/php-api-psr4/public/api/products


# Simple poll application

## System requirements
* PHP 7+
* MariaDB 10+
* WebServer
* Composer

## How to install
1. Copy application to your virtual host. Application must be avalible at `http://your.host`.
2. Go to htdocs and make `composer install`. PHPUnit and some another depencies will be installed.
3. Create user in DB. Required grants on SELECT,INSERT,UPDATE,DELETE,CREATE,DROP,ALTER,TRIGGER. 
4. Edit config.php in root directory. DB constant array for DB connection. In WSS HOST indicate your virtual host as `your.host`, in PORT - any available port.
5. Make migrations. Go to `application\migrations` and type `php start.php`.
6. Start WebSocket server. Go to `application\websocket` and type `php server.php start`.
7. Please, enjoy and have fun %)

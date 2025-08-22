# Domus Aurea — Backend (Laravel + Vite)

> Repositorio: `CristianR04/domusaurea`

Este repositorio implementa el **backend de una aplicación inmobiliaria** para la gestión de propiedades, propietarios e inquilinos. Está construido sobre **Laravel** e integra **Vite** para compilar activos front (Vue/TypeScript) embebidos en `resources/`. Incluye configuración para ejecución local y **despliegue con Docker Compose**.

---

## 📚 Tabla de contenido
- [Arquitectura y stack](#arquitectura-y-stack)
- [Estructura de carpetas](#estructura-de-carpetas)
- [Requisitos](#requisitos)
- [Configuración inicial](#configuración-inicial)
- [Ejecución local con Docker](#ejecución-local-con-docker)
- [Ejecución local sin Docker](#ejecución-local-sin-docker)
- [Compilación de assets (Vite)](#compilación-de-assets-vite)
- [Comandos útiles de Artisan](#comandos-útiles-de-artisan)
- [Despliegue en producción (Docker Compose + Nginx)](#despliegue-en-producción-docker-compose--nginx)
- [Backups](#backups)
- [Pruebas](#pruebas)
- [Solución de problemas](#solución-de-problemas)
- [Licencia](#licencia)

---

## 🧱 Arquitectura y stack
- **Framework**: Laravel (PHP 8.2+)
- **Front embebido**: Vite + Vue + TypeScript (en `resources/`)
- **Base de datos**: MySQL 8.x
- **Servidor web**: Nginx (en despliegue con Docker)
- **Contenedores**: Docker Compose (servicios típicos: `app`/PHP-FPM, `nginx`, `mysql`)

> Nota: El proyecto trae archivos como `docker-compose.yml` y `docker/php/Dockerfile` para orquestar el entorno.

---

## 🗂️ Estructura de carpetas
```
app/                # Código de la aplicación (Models, Http, Policies, etc.)
bootstrap/          # Bootstrap de Laravel
config/             # Archivos de configuración
database/           # Migrations, seeders y factories
public/             # Document root (index.php)
resources/          # Vistas/Componentes y assets (Vue/TS, CSS)
routes/             # web.php, api.php, etc.
storage/            # Logs, caché, archivos públicos (via storage:link)
tests/              # Pruebas

docker/php/         # Dockerfile de PHP-FPM y configuración

docker-compose.yml  # Orquestación de servicios
composer.json       # Dependencias PHP (Laravel)
package.json        # Dependencias Node (Vite)
vite.config.ts      # Configuración de Vite
```

---

## 🔧 Requisitos
**Con Docker**
- Docker Desktop / Engine 24+
- Docker Compose v2

**Sin Docker**
- PHP 8.2+
- Composer 2+
- MySQL 8.x
- Node 20+ y npm 10+ (para construir assets con Vite)

---

## 🚀 Configuración inicial
Clona el repositorio y copia el archivo de entorno:
```bash
git clone https://github.com/CristianR04/domusaurea.git
cd domusaurea
cp .env.example .env
```
Edita `.env` y establece al menos:
```dotenv
APP_NAME="DomusAurea"
APP_ENV=local
APP_URL=http://localhost

# Base de datos (ajusta según tu entorno / compose)
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=domusaurea
DB_USERNAME=domusaurea
DB_PASSWORD=domusaurea

# Archivos
FILESYSTEM_DISK=public
```
> 🔎 En Docker, el `DB_HOST` suele ser el **nombre del servicio** de MySQL dentro de `docker-compose.yml` (por ejemplo `mysql`).

---

## 🐳 Ejecución local con Docker
1) **Construir y levantar**
```bash
docker compose up -d --build
```
2) **Instalar dependencias PHP** (dentro del contenedor PHP-FPM)
```bash
docker compose exec <app> composer install
```
3) **Generar key de la app**
```bash
docker compose exec <app> php artisan key:generate
```
4) **Migraciones y seeders (opcional)**
```bash
docker compose exec <app> php artisan migrate --seed
```
5) **Vincular storage público**
```bash
docker compose exec <app> php artisan storage:link
```
6) **(Opcional) Compilar assets** con Vite (ver sección de Vite más abajo).

Accede a la app en: **http://localhost**

> 💡 Reemplaza `<app>` por el **nombre del servicio PHP** definido en tu `docker-compose.yml` (ej. `app`, `backend`, `laravel`, etc.). Puedes listarlo con `docker compose ps`.

---

## 💻 Ejecución local **sin Docker**
1) Instala dependencias PHP y Node:
```bash
composer install
npm install
```
2) Configura `.env` (ver sección anterior) y crea clave:
```bash
php artisan key:generate
```
3) Crea BD y corre migraciones/seeders:
```bash
php artisan migrate --seed
```
4) En otra terminal, levanta el servidor de desarrollo de Vite:
```bash
npm run dev
```
5) Levanta el servidor PHP embebido (opcional) o configura Nginx/Apache:
```bash
php artisan serve
```
App disponible en **http://localhost:8000** (o el host/puerto configurados en tu servidor web).

---

## ⚡ Compilación de assets (Vite)
- **Desarrollo:**
```bash
npm run dev
```
- **Producción (build):**
```bash
npm run build
```
Los archivos generados se publican para ser servidos desde `public/` según tu configuración de Vite.

---

## 🛠️ Comandos útiles de Artisan
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan migrate:fresh --seed
php artisan test   # Ejecuta las pruebas
```

---

## 🚢 Despliegue en producción (Docker Compose + Nginx)
A continuación un **ejemplo** de `docker-compose.yml` típico para producción. Si tu repositorio ya trae uno, úsalo como base y ajusta variables.

```yaml
version: "3.8"
services:
  app:
    build:
      context: .
      dockerfile: ./docker/php/Dockerfile
    container_name: domusaurea_app
    env_file: .env
    working_dir: /var/www
    volumes:
      - ./:/var/www
    depends_on:
      - mysql

  nginx:
    image: nginx:stable
    container_name: domusaurea_nginx
    ports:
      - "80:80"
      # - "443:443"  # si usas TLS
    volumes:
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf:ro
      - ./:/var/www:ro
    depends_on:
      - app

  mysql:
    image: mysql:8.0
    container_name: domusaurea_mysql
    restart: unless-stopped
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_USER: ${DB_USERNAME}
      MYSQL_PASSWORD: ${DB_PASSWORD}
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

Archivo Nginx de ejemplo (`docker/nginx/default.conf`):
```nginx
server {
  listen 80;
  server_name _;
  root /var/www/public;
  index index.php index.html;

  location / {
    try_files $uri $uri/ /index.php?$query_string;
  }

  location ~ \.(php|phar)$ {
    include fastcgi_params;
    fastcgi_pass app:9000;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    fastcgi_param PATH_INFO $fastcgi_path_info;
  }

  location ~* \.(css|js|jpg|jpeg|png|gif|ico|svg|webp)$ {
    try_files $uri =404;
    expires max;
    access_log off;
  }
}
```

**Pasos recomendados en servidor Ubuntu (ejemplo DigitalOcean):**
```bash
# 1) Instalar Docker y Compose
sudo apt-get update && sudo apt-get install -y ca-certificates curl gnupg
# (instala Docker Engine y Compose v2 desde docs oficiales)

# 2) Clonar repo
git clone https://github.com/CristianR04/domusaurea.git
cd domusaurea
cp .env.example .env # y configura variables

# 3) Construir y levantar
docker compose up -d --build

# 4) Inicializar app
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan storage:link

# (opcional) Build de assets para prod
docker compose exec app npm ci
docker compose exec app npm run build
```

> 🔐 **TLS**: para HTTPS, integra Let’s Encrypt (por ejemplo, con `nginx-proxy + acme-companion`, Caddy, o configura certbot en el host y monta certificados en el contenedor Nginx).

---

## 💾 Backups
- **MySQL**
  ```bash
  docker compose exec mysql mysqldump -u$DB_USERNAME -p$DB_PASSWORD $DB_DATABASE > backup.sql
  ```
- **Archivos**: respalda `storage/app` y `public/storage`.

---

## ✅ Pruebas
Ejecuta el suite de pruebas:
```bash
php artisan test
```
O bien:
```bash
./vendor/bin/phpunit
```

---

## 🆘 Solución de problemas
- **`SQLSTATE[HY000] [1045] Access denied for user`**
  - Verifica `DB_USERNAME`/`DB_PASSWORD` y que el usuario exista en MySQL.
  - En Docker, destruye y recrea contenedores si cambias credenciales iniciales de MySQL: `docker compose down -v && docker compose up -d`.

- **`php_network_getaddresses: getaddrinfo for mysql failed`**
  - Asegura que `DB_HOST` sea el **nombre del servicio** en Compose (`mysql`) y que el contenedor esté corriendo.

- **CORS**
  - Configura orígenes permitidos en `config/cors.php` y en `APP_URL`.

- **Permisos en `storage/` y `bootstrap/cache`**
  - Dentro del contenedor: `chown -R www-data:www-data storage bootstrap/cache` y `chmod -R 775 storage bootstrap/cache`.

- **Error 502/404 en Nginx**
  - Verifica que Nginx apunte a `root /var/www/public;` y que `fastcgi_pass app:9000;` coincida con el servicio PHP.

---

## 📄 Licencia
Este proyecto se distribuye bajo los términos que el autor defina en el repositorio. Si no hay licencia explícita, se asume **todos los derechos reservados**.

---

### ✍️ Notas
- Ajusta los nombres de servicio (`app`, `mysql`, etc.) a los que especifique tu `docker-compose.yml`.
- Si tu frontend vive en un repo aparte, configura CORS y las URLs del front en `.env`.

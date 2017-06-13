# Laravel

## Instalación

### Via Laravel Installer

Descargamos el instalador de laravel

	composer global require "laravel/installer"

Make sure to place the $HOME/.composer/vendor/bin directory (or the equivalent directory for your OS) in your $PATH so the laravel executable can be located by your system.

Una vez instalado el instalador ejecutamos el comando `laravel new <dirctorio>`

	laravel new blog
	
### Via Composer Create-Project

	composer create-project --prefer-dist laravel/laravel blog

### Servidor local de desarrollo

	php artisan serve

## Configuración

Si no se ha creado el archivo `.env` ejecutamos:

	composer run-script post-root-package-install

### Application Key

	php artisan key:generate
	
### Nota

 >Nota: Todas las variables de entorno se pueden acceder via $_ENV que es una variable PHP superglobal, que mediante un array asociativo te permite acceder sus elementos. Hay un helper llamado "env" que justamente está para facilitarte el acceso a las variables de entorno sin usar la superglobal de PHP. Por ejemplo env('APP_DEBUG') te daría el valor de la variable de entorno APP_DEBUG. Puedes verlo en funcionamiento en el archivo config/app.php.

## Enlaces

 * [Curso Laravel en Desarrolloweb](https://desarrolloweb.com/articulos/tareas-instalacion-laravel5-problemas.html)
 * [Página de laravel](https://laravel.com)
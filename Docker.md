##### Docker

#### Uso básico de Docker
Ejecución de un container con consola interactiva

	docker run --name test -h test -it ubuntu bash

  * **--name test**: Le damos un nombre a la sesión
  * **-h test**: El hostname
  * **-it**: Consola interactiva
  * **bash**: Comando que ejecutamos

Ver los dockers que se han ejecutado

	docker ps -a

Información de un container:

	docker inspect <ID CONTAINER>

Creación de una nueva imagen basada en un container:

	docker commit test ubuntu_apache

 * **test**: Nombre del contenedor en el que nos basamos.
 * **ubuntu_apache**: Nombre que le damos al conetenedor.

Ejecutar un container basado en una imagen con un servidor web activo en FOREGROUND:

	docker run -d --name web -h web ubuntu_apache bash -c "apache2ctl -D FOREGROUND"

 * **-d**: Desatachado, es decir, sin consola virtual interactiva (ejecutado de fondo o background).
 * **--name web**: Nombre que le damos al contenedor.
 * **-h web**: Hostname
 * **ubuntu_apache**: imagen en la que nos basamos para ejecutar el contenedor.
 * **bash -c "apache2ctl -D FOREGROUND"**: Comando que ejecutamos desde bash

Comandos que se están ejecutando en un contenedor:

	docker top <CONTAINER NAME/ID>

Mostrar la salida de un contenedor en ejecución:

	docker logs <CONTAINER NAME/ID>

Ejectuar un comando dentro de un container en ejecución:

	

Para ver las diferencias del contenedor con las diferentes instancias. El hash que pongamos es a partir del cual nos mostrará las diferencias del contenedor:

	docker diff 8a46cfae0b49

Con 'docker attach <hash>' entramos en forma interactiva a ese container

	docker attach fce2354f3f1ae07c81f4f57f86eb181c8cb3768ebb12676ca92313f61950f543

#### Busquedas en la nube

	docker search gentoo

Busca los contenedores con gentoo y directamente podemos arrancarlos y si no los tiene los descarga.

#### Parada y comienzo de un container

	docker stop <id>

	docker start <id>

#### Redireccionamiento de puertos

	docker run -p 80:8000 -d curso/webogram

#### Dockerfile

#### Enlaces

  * Home page: https://www.docker.com/
  * Compilar y documentar tu servidor usando Dockerfile: https://platzi.com/blog/imagenes-con-dockerfile/
  * 

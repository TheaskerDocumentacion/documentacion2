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

	docker exec web bash -c "apt-get update && apt-get install nano"	
	docker exec -it web bash -c "apt-get update && apt-get install nano"	

Otra forma de entrar en un container en ejecución sería con 'docker attach <hash>' entramos en forma interactiva a ese container

	docker attach fce2354f3

 * **--sig-proxy=true**: Lo que hace es decirle que todo lo que ejecutemos en la consola que abrimos le mande las señales a la consola principal, por lo que si hicieramos un 'Crtl+c' mataríamos el comando principal con el que ejecutamos el contenedor (docker ... bash -c "apache2ctl -D FOREGROUND")

Copiar un fichero al container:

	docker cp temp.txt web:/tmp

 * **web:/tmp**: 'web es el nombre del container y '/tmp' es la ruta donde quero copiar el fichero

Para ver las diferencias del contenedor con las diferentes instancias. El hash que pongamos es a partir del cual nos mostrará las diferencias del contenedor:

	docker diff 8a46cfae0b49

#### Busquedas en la nube

	docker search gentoo

Busca los contenedores con gentoo y directamente podemos arrancarlos y si no los tiene los descarga.

#### Parada y comienzo de un container

	docker stop <id/name>

	docker start <id/name>

#### Publicar una imagen a dockerhub

Ponerle una etiqueta a la imagene que queremos subir.

	docker tag ubuntu_apache theasker/ubuntu_apache

Subimos la imagen

	doker push theasker/ubuntu_apache

#### Networking

### Exponer un puerto

Publicamos los puertos que usa el contenedor

	docker run -it --expose 80 --expose 3306 --name test debian bash

### Publicar un puerto

"Publicamos" 

Publicamos el puerto 80 del contenedor en un puerto aleatorio del host

	docker run -it --name test -p 80 debian bash


Publicamos el puerto 80 del contenedor en el 8080 del host

	docker run -it --name test -p 8080:80 debian bash


Publicamos todos los puertos expuestos a puertos aleatorios del host

	docker run -it --name test -P debian bash


Comprobación de puertos publicados de un contenedor

	docker port test
	80/tcp -> 0.0.0.0:32788

	docker port test1 80
	0.0.0.0:32788

### Enlazar contenedores

Crear un contenedor añadiendole cierta información de otro contenedor ya existente para que el acceso entre ambas sea más sencillo con variables de entorno.

	docker run -it --name test1 -h test1 mijack/apache2 bash
	docker run --link test1 -rm -it --name test2 -h test2 debian bash


Docker modifica el fichero '/etc/hosts' añadiendo la ip de la máquina enlazada para que su acceso sea rápido

	root@test2:/# cat /etc/hosts
	[...]
	172.17.0.2      test1 test1
	172.17.0.3      test2

Crea unas variables de entorno por cada puerto expuesto en test1 para que sea más fácil su acceso, así como el hostname del contenedor enlazado, así como su variable HOME y PATH.

	root@test2:/# env
	TEST1_NAME=/test2/test1
	TEST1_PORT_80_TCP_ADDR=172.17.0.2
	HOSTNAME=test2
	TEST1_PORT_80_TCP=tcp://172.17.0.2:80
	TERM=xterm
	TEST1_PORT_80_TCP_PROTO=tcp
	TEST1_PORT=tcp://172.17.0.2:80
	PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
	TEST1_PORT_80_TCP_PORT=80
	PWD=/
	SHLVL=1
	HOME=/root
	_=/usr/bin/env


#### Enlaces

  * Home page: https://www.docker.com/
<<<<<<< HEAD
  * Compilar y documentar tu servidor usando Dockerfile: https://platzi.com/blog/imagenes-con-dockerfile/ 
=======
  * Compilar y documentar tu servidor usando Dockerfile: https://platzi.com/blog/imagenes-con-dockerfile/
  * 
>>>>>>> 31ced3b8e83b440775075459ed462b9b0850cc4e

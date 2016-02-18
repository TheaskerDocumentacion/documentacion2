##### Docker

#### Uso básico de Docker
Ejecución de un container con consola interactiva

	docker run -i -t ubuntu:12.10 bash

Ver los dockers que se han ejecutado

	docker ps -a

Para ver las diferencias del contenedor con las diferentes instancias. El hash que pongamos es a partir del cual nos mostrará las diferencias del contenedor:

	docker diff 8a46cfae0b49

Ejecutar un container en segundo plano

	theasker@TheaskerGentoo ~ $ docker run -d ubuntu /bin/sh -c "ls"
	fce2354f3f1ae07c81f4f57f86eb181c8cb3768ebb12676ca92313f61950f543
	theasker@TheaskerGentoo ~ $ docker logs fce2354f3f1ae07c81f4f57f86eb181c8cb3768ebb12676ca92313f61950f543
	bin
	boot
	dev
	etc
	home
	lib
	lib64
	media
	mnt
	opt
	proc
	root
	run
	sbin
	srv
	sys
	tmp
	usr
	var

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

'-p 80:8000' es el puerto público 80 con el puerto 8000 de la máquina docker, por lo que para poder usar el puerto de alguna aplicación que usa el puerto 8000 en el respositorio lo redireccionamos al puerto 80, por lo que en el host sólo tendríamos que poner la ip del respositorio en nuestro navegador para hacerlo funcionar y poder acceder.

#### Dockerfile

### Publicar un repositorio

	docker push theasker/repositorio

#### Enlaces

  * Home page: https://www.docker.com/
  * Compilar y documentar tu servidor usando Dockerfile: https://platzi.com/blog/imagenes-con-dockerfile/ 
##### Docker

#### Uso básico de Docker
Ejecución de un container con consola interactiva
	docker run -i -t ubuntu:12.10 bash

Ver los dockers que se han ejecutado
	docker ps -a

Para ver las diferencias del contenedor con las diferentes instancias. El hash que pongamos es a partir del cual nos mostrará las diferencias del contenedor:
	docker diff 8a46cfae0b49

Ejecutar un container en segundo plano
	docker run -d ubuntu:12.10 /bin/sh -c "ls"
	
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




#### Dockerfile

#### Enlaces

  * Home page: https://www.docker.com/
  * Compilar y documentar tu servidor usando Dockerfile: https://platzi.com/blog/imagenes-con-dockerfile/
  * 
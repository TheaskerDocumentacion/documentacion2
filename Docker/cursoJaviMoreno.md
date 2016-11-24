# Curso de Docker de Javi Moreno

Creo una máquina virtual para VirtualBox

	docker-machine create --driver virtualbox b2d

Para listar las máquinas virtualas creadas con docker-machine

	docker-machine ls

Para conectarme a una máquina virtual por ssh

	docker-machine ssh b2d

Para eliminar una máquina virtual

	docker-machine kill b2d

Con `docker-machine help` tendremos todos los comandos que podemos usar.
# Curso Docker de Udemy (Ricardo Andre Gonzalez Gomez)

<!-- TOC -->

- [Curso Docker de Udemy (Ricardo Andre Gonzalez Gomez)](#curso-docker-de-udemy-ricardo-andre-gonzalez-gomez)
    - [Imagenes y su contruccion (Dockerfile)](#imagenes-y-su-contruccion-dockerfile)
        - [FROM](#from)
        - [RUN](#run)
        - [COPY / ADD <src> <dest>](#copy--add-src-dest)
        - [ENV](#env)
        - [WORKDIR](#workdir)
        - [EXPOSE](#expose)
        - [LABEL](#label)
        - [USER](#user)
        - [CMD](#cmd)
        - [dockerignore](#dockerignore)
        - [resumen hasta ahora](#resumen-hasta-ahora)
        - [Buenas prácticas en creación de DockerFile](#buenas-prácticas-en-creación-de-dockerfile)
        - [Multi Stage Build](#multi-stage-build)
        - [Tratamiento de imagenes](#tratamiento-de-imagenes)
            - [Eliminar imágenes `docker rmi`](#eliminar-imágenes-docker-rmi)
            - [Eliminar imágenes "huerfana"](#eliminar-imágenes-huerfana)
            - [Contruir una imagen con otro fichero distinto de DockerFile](#contruir-una-imagen-con-otro-fichero-distinto-de-dockerfile)
        - [Creación de imágenes de ejemplo](#creación-de-imágenes-de-ejemplo)
            - [Apache + PHP + SSL](#apache--php--ssl)
            - [Creación de una imagen con Nginx y PHP-FPM](#creación-de-una-imagen-con-nginx-y-php-fpm)
            - [Apache + php 7](#apache--php-7)
    - [Contenedores](#contenedores)
        - [Listar contenedores](#listar-contenedores)
        - [Creación de contenedores](#creación-de-contenedores)
            - [Operaciones con contenedores](#operaciones-con-contenedores)
            - [Destruir contenedores automáticamente o contenedores temporales](#destruir-contenedores-automáticamente-o-contenedores-temporales)
            - [Cambiar el Document Root de docker](#cambiar-el-document-root-de-docker)
            - [Sobreescribir el CMD de una imagen en el contenedor](#sobreescribir-el-cmd-de-una-imagen-en-el-contenedor)
            - [Ejemplos de contenedores](#ejemplos-de-contenedores)
                - [Crear un contenedor con MySQL](#crear-un-contenedor-con-mysql)
                - [Crear un contenedor de MongoDB](#crear-un-contenedor-de-mongodb)
                - [Crear un contenedor con Apache / Ngnix / Tomcat](#crear-un-contenedor-con-apache--ngnix--tomcat)
                - [Crear un contenedor con Postgress](#crear-un-contenedor-con-postgress)
                - [Crear un contenedor con Jenkins](#crear-un-contenedor-con-jenkins)
                - [Ejercicio](#ejercicio)
            - [Mapeo de puertos](#mapeo-de-puertos)
            - [Limitar recursos de un contenedor](#limitar-recursos-de-un-contenedor)
                - [Memoria](#memoria)
                - [CPU](#cpu)
        - [Docker commit](#docker-commit)
    - [Volúmenes](#volúmenes)
        - [Volumenes de Host - Caso práctico MySQL](#volumenes-de-host---caso-práctico-mysql)
        - [Volumenes anónimos](#volumenes-anónimos)
            - [VOLUME en un Dockerfile](#volume-en-un-dockerfile)
        - [Volúmenes nombrados](#volúmenes-nombrados)
    - [Enlaces](#enlaces)

<!-- /TOC -->

## Imagenes y su contruccion (Dockerfile)
Una imagen de docker está formada por capas de solo lectura que se forman con las instrucciones FROM, RUN, CMD en los ficheros DockerFile.

El comando CMD de un DockerFile es la ejecución de un comando o aplicación. Cuando terminan todos los procesos de un contenedor, el contenedor se cerrará, por eso se suelen ejecutar servicios en contenedores.

### FROM

La imagen desde la que se construirá nuestra imagen.

### RUN

Cosas que podemos ejecutar por líneas de comando en la formación de la imagen.

### COPY / ADD <src> <dest>

* **`COPY`** Copia archivos desde nuestro sistema operativo hacia la imagen que estamos creando.

* **`ADD`** También copia pero permite que el origen sea una url.

En las buenas prácticas en Docker, se recomienda usar COPY siempre que se pueda y no sea necesario usar ADD.

### ENV

Sirver para agregar variables de entorno a nuestra imagen.

````dockerfile
ENV contenido prueba
RUN echo "$contenido" > /var/www/html/prueba.html
````
Hemos creado la variable de entorno llamada `contenido` con valor "prueba" y la almacenamos en un fichero.

### WORKDIR

Asignamos cual es el directorio de trabajo en un momento dado de la creación de la imagen.
````dockerfile
WORKDIR /var/www/html
````

### EXPOSE

"Exponemos" un puerto del host asignado para un puerto de la imagen.
````dockerfile
EXPOSE 8080
````
### LABEL

Son etiquetas / metadatos que dan información sobre la imagen creada.
````dockerfile
LABEL version=1.0
LABEL description=This is apache image
LABEL vendor=xxxxx
````

### USER

Le decimos quien esta ejecutando la tarea posterior

````dockerfile
FROM centos

LABEL version=1.0
LABEL description=This is apache image
LABEL vendor=xxxxx

RUN yum install httpd -y

RUN echo "$(shoami)" > /var/www/html/usar1.html
RUN useradd mauri
USER mauri
RUN echo "$(shoami)" > /tmp/usar2.html
USER root
RUN cp /tmp/user2.html /var/www/html/user2.html
CMD apachectl -DFOREGROUND
````
El primer echo será el usuario `root` que es el de por defecto, y el segundo echo es el usuario que hemos creado `mauri`.

### CMD

Es lo que mantiene vivo al contenedor, es decir, cuando finalice la ejecución del comando introducido en la sentencia CMD finalizará la ejecución del contenedor.

No sólo podemos ejecutar comandos del sistema operativo, sino también scripts. Por ejemplo:

`run.sh`
````bash
#!/bin/bash

echo "Iniciando container..."
apachectl -DFOREGROUND
````

y luego en nuestro DockerFile
````dockerfile
COPY run.sh /run.sh
CMD sh /run.sh
````

### dockerignore

Archivo oculto con nombre `.dockerignore` que sirve para ignorar cualquier cosa que esté en el directorio de trabajo actual que no queramos incluir en la imagen, ya que al construir la imagen, se envía lo que esté en el directorio de trabajo.

### resumen hasta ahora

````dockerfile
FROM nginx
RUN useradd mauri
COPY fruit /usr/share/nginx/html
ENV archivo docker
WORKDIR /usr/share/nginx/html
RUN echo "$archivo" > /usr/share/nginx/html/env.html
EXPOSE 90
LABEL version=1
USER mauri
RUN echo "Yo soy $(whoami)" > /tmp/yo.html
USER root
RUN cp /tmp/yo.html /usr/share/nginx/html/docker.html
VOLUME /var/log/nginx
CMD nginx -g 'daemon off;'
````

### Buenas prácticas en creación de DockerFile
* El servicio que se cree, se tiene que poder destruir con gran facilidad, que sea **efímero**.
* Debería haber un sólo servicio por contenedor, osea un sólo servicio instalado por imagen.
* Si vamos a tener archivos grandes o que no queremos que estén dentro del contexto 
* Hay que intentar reducir el número de capas de la imagen.
* Separar los argumentos en varias líneas para que sea más legible.
Esto crea 3 capas:
````dockerfile
RUN echo "1" >> /usr/share/nginx/html/test.txt
RUN echo "2" >> /usr/share/nginx/html/test.txt
RUN echo "2" >> /usr/share/nginx/html/test.txt
````
y habría que dejarlo así para que sea más legible:
````dockerfile
RUN \
    echo "1" >> /usr/share/nginx/html/test.txt && \
    echo "2" >> /usr/share/nginx/html/test.txt && \
    echo "2" >> /usr/share/nginx/html/test.txt
````
o incluso así usando una variable de entorno:
````dockerfile
ENV fich /usr/share/nginx/html/test.txt
RUN \
    echo "1" >> $fich && \
    echo "2" >> $fich && \
    echo "2" >> $fich
````

* Poner varios argumentos en una sola capa.
* No instalar paquetes innecesarios.
* Usar LABELS que den información de nuestra imagen, como pueden ser versiones y descripciones.


### Multi Stage Build

Es una funcionalidad en la que nos permiete untilizar varios **FROM** dentro de un mismo DockerFile. 

Por ejemplo, podemos querer contruir un fichero .jar desde una imagen MAVEN que necesita muchas dependencias y una vez que esté creado el .jar lo puedo copiar a una imagen JAVA sin necesidad de instalar todas las dependencias que se necesitaba para su compilación, con el ahorro considerable de espacio.

El último **FROM** será siempre el válido.

````dockerfile
FROM maven:3.5-alpine as builder
COPY app /app
RUN cd /app && mvn package

FROM openjdk:8-alpine
COPY --from=builder /app/target/my-app-1.0.SNAPSHOT.jar /opt/app.jar
CMD java -jar /opt/app.jar
````

Una vez que tenemos el Dockerfile creamos la imagen
````
docker build -t java .
````

### Tratamiento de imagenes

#### Eliminar imágenes `docker rmi`

`docker rmi` <id>|<image name>
````
docker rmi centos:prueba apache-centos:latest
````

#### Eliminar imágenes "huerfana"

Cada vez que creas una imagen con el mismo tag, pero que se ha modificado alguna de las capas de la imagen (comando RUN del DockerFile, por ejemplo), al ser las capas de **solo lectura** docker, creará otra imagen nueva y dejará huerfana la anterior por no poder usar el mismo tag en 2 imagenes. Para eliminar estas capas

````
<none>                         <none>              c6e31f151420        About an hour ago   349MB
````
Lo eliminaremos con el id de la imagen:
````
docker rmi c6e31
````

Visualizamos las imagenes "colgadas" o "huerfanas"
````
docker images -f dangling=true
````

Con la opción `-q` le decimos q sólo muestre los ids, y con eso y con el comando `xargs` de linux podemos decirle que nos borre todas las imágnes con esos ids.

````
docker images -f dangling=true -q | xargs docker rmi
````

#### Contruir una imagen con otro fichero distinto de DockerFile
Si en vez de usar el típico fichero `DockerFile` usamos otro nombre como `my-dockerfile`:
````
docker build -t test -f my-dockerfile .
````

### Creación de imágenes de ejemplo

#### Apache + PHP + SSL

````dockerfile
FROM centos:7
RUN yum -y install httpd php php-cli php-common
RUN echo "<?php phpinfo(); ?>" > /var/www/html/phpinfo.php
COPY startbootstrap-sb-admin-2-gh-pages /var/www/html
CMD apachectl -DFOREGROUND
````
Creamos el archivo `.dockerignore` por seguir las buenas prácticas.
`.dockerignore`
````
gh-pages.zip
startbootstrap-sb-admin-2-gh-pages
````

Ahora creamos un certificado autofirmado:
````bash
openssl req -x509 -nodes -days 365 -newkey rsa:2018 -keyout mysitename.key -out mysitename.crt
````

creamos el archivo `ssl.conf`
````conf
<VirtualHost *:443>
    DocumentRoot /var/www/html
    ServerName localhot
    SSLEngine on
    SSLCertificateFile /docker.crt
    SSLCertificateKeyFile /docker.key
    # SSLCertificateChainFile /ruta/a/DigiCertCA.crt
</VirtualHost> 
````

modificamos nuestro DockerFile:
````dockerfile
FROM centos:7
RUN yum -y install httpd \
    php \
    php-cli \
    php-common \
    mod_ssl \
    openssl
RUN echo "<?php phpinfo(); ?>" > /var/www/html/phpinfo.php
COPY startbootstrap-sb-admin-2-gh-pages /var/www/html
COPY ssl.conf /etc/httd/conf.d/default.conf
COPY docker.crt /docker.crt
COPY docker.key /docker.key
EXPOSE 443
CMD apachectl -DFOREGROUND
````
Construimos la imagen con:
````
docker build -t apache:ssl-ok .
````

Y luego creamos el contenedor
````
docker run -d -p 443:443 apache:ssl-ok
````

#### Creación de una imagen con Nginx y PHP-FPM

````dockerfile
FROM centos:7
COPY ./conf/nginx.repo /etc/yum.repos.d/nginx.repo
RUN yum -y install nginx --enablerepo=nginx && \
    yum -y install https://centos7.iuscommunity.org/ius-release.rpm && \
    yum -y install \
        php71u-fpm \
        php71u-cli \
        php71u-mysqlnd \
        php71u-soap \
        php71u-xml \
        php71u-zip \
        php71u-json \
        php71u-mcrypt \
        php71u-mbstring \
        php71u-gd \
        -- enablerepo=ius && yum clean all
EXPOSE 443
VOLUME /var/www/html /var/log/php-fpm /var/lib/php-fpm
COPY ./vonf/nginx.conf /etc/nginx/conf.d/nginx.conf
COPY ./bin/start.sh /start.sh
CMD /start.sh
````

#### Apache + php 7
````dockerfile
FROM debian:9
RUN     apt-get update && \
        apt-get -y install apache2 php7.0 php7.0-cli php7.0-common
RUN echo "<?php phpinfo(); ?>" > /var/www/html/phpinfo.php
RUN a2enmod php7.0
CMD apachectl -DFOREGROUND
````
Creamos la imagen con ese Dockerfile
````
docker build -t apachephp .
````
Luego creamos un contenedor usando esa imagen
````
docker run -d p 81:80 --name apachephp apachephp
````

## Contenedores

El contenedor es una instancia de una imagen.

Los contenedores son temporales, por lo que si queremos que los cambios sean permanentes, debemos definirlo en el Dockerfile de la imagen. Las capas de las imágenes son de solo lectura pero **la capa de contenedor es de lectura y escritura**. Podemos crear todos los contenedores que queramos partiendo de una sola imagen.

### Listar contenedores

* Con `docker ps` listamos los contenedores en funcionamiento.
* Con `docker ps -a` listamos todos los contenedores, incluso lo que están parados y no funcionando.

### Creación de contenedores

#### Operaciones con contenedores
El requisito principal es basarnos en una imagen, ya que un contenedor es una instancia de una imagen.

* **`docker pull jenkins`**: Descargamos la imagen de Jenkins.
* `docker run -d`: Creación y ejecución de un contenedor en segundo plano sin una consola interactiva.

* **Renombrar contenedor**: `docker rename <old name> <new name>`
* **Detener contenedor**: `docker stop <name|id>`
* **Arranchar contenedor**: `docker start <name|id>`
* **Reiniciar contenedor**: `docker restart <name|id>`
* **Entrar al contenedor por una shell**: `docker exec -ti <name|id> <container name> <shell>` por ejemplo `docker exec -ti jenkins bash`

Si no es especifica **hostname** el hostname por defecto será el id de contenedor.

* **Entrar en un contenedor con un usuario específico**: `docker exec -u root -ti jenkins bash`. Aqui entraríamos como usuario `root`
* **Eliminar contenedores**: `docker rm <nombre|id>`
* **Eliminar todos contenedores**: Con `docker ps -q` visualizamos las ids de los contenedores y asi con el comando `xarg` de linux al que le pasamos como parámetro ese resultado: `docker ps -q | xargs docker rm -f` o también `docker rm -fv $(docker ps -aq)`
* **Crear una variable de entorno al crear el contenedor**: `docker run -dti -e "prueba1=4321" --name jenkinsenv jenkins`
* **Ver la memoria consumida por un contenedor**: `docker stats my-mongo`
* **Ver la salida de un contenedor**: `docker log mongo` y si lo ponemos con el parámtro `-f` (follow) se quedará mostrando todo lo que salga por consola `docker log -f mongo`
* **Copiar ficheros a o desde un contenedor**: 
  * Desde el host a un contenedor: `docker cp ./index.html apache:/usr/local/apache2/htdocs/index.html`
  * Desde el contenedor al host: `docker cp apache:/var/log/dpkg.log .`

#### Destruir contenedores automáticamente o contenedores temporales
Una vez que se termina la ejecución y salgamos del contenedor se destruirá.
````bash
docker run --rm -ti centos bash
````

#### Cambiar el Document Root de docker
Es toda la jerarquía de directorios que crea docker para guardar las imágnes, contenedores, redes, etc. Lo podemos ver con el comando:
````
$ docker info | grep -i root
WARNING: No swap limit support
Docker Root Dir: /var/lib/docker
````
````
# ls -la /var/lib/docker/
total 56
drwx--x--x 12 root root  4096 sep 18 13:23 .
drwxr-xr-x 26 root root  4096 oct 20  2017 ..
drwx------  2 root root  4096 oct  5  2017 builder
drwx------  7 root root  4096 sep 19 11:25 containers
drwx------  3 root root  4096 oct  5  2017 image
drwxr-x---  3 root root  4096 oct  5  2017 network
drwx------ 65 root root 12288 sep 19 11:25 overlay2
drwx------  4 root root  4096 oct  5  2017 plugins
drwx------  2 root root  4096 oct  5  2017 swarm
drwx------  2 root root  4096 sep 18 13:23 tmp
drwx------  2 root root  4096 oct  5  2017 trust
drwx------ 18 root root  4096 sep 18 12:02 volumes
````
Editamos el fichero de configuración `/lib/systemd/system/docker.service`. Buscamos la línea donde dice **ExecStart=/usr/bin/dockerd** y la modificamos de esta manera **ExecStart=/usr/bin/dockerd --data-root /opt/docker**.

Luego avisamos que hemos hecho un cambio en la configuración a **Systemd** y reiniciamos el servicio
````
systemctl daemon-reload
systemctl restart docker
````

#### Sobreescribir el CMD de una imagen en el contenedor
Creamos un contenedor normal
````bash
$ docker run -dti centos
$ docker ps
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS               NAMES
8a39ad1a5e7e        centos              "/bin/bash"         5 seconds ago       Up 4 seconds                            vigilant_euler
````

Creamos ahora un contenedor sustituyendo el CMD de la imagen
````bash
$ docker run -dti centos echo "hola mundo"
$ docker ps -a
CONTAINER ID        IMAGE                                 COMMAND                  CREATED             STATUS                      PORTS               NAMES
c8141e6837bd        centos                                "echo 'hola mundo'"      29 seconds ago      Exited (0) 28 seconds ago                       pedantic_almeida
8a39ad1a5e7e        centos                                "/bin/bash"              58 seconds ago      Up 57 seconds                                   vigilant_euler
````
#### Ejemplos de contenedores

##### Crear un contenedor con MySQL

Que creará un usuario y una contraseña asignada a una base de datos nueva:
`docker run -d -p 3333:3306 --name my-db2 -e "MYSQL_ROOT_PASSWORD=12345678" -e "MYSQL_DATABASE=docker-db" -e "MYSQL_USER=docker-user" -e "MYSQL_PASSWORD=87654321" mysql:5.7`

##### Crear un contenedor de MongoDB
`docker run -d --name my-mongo -p 27017:27017 mongo`

##### Crear un contenedor con Apache / Ngnix / Tomcat

**Ngnix**
````
docker run -d -p 8888/:80 --name ngnix ngnix
````
**Apache**
````
docker run -d -p 9999/:80 --name apache apache
````
**Tomcat**
````
docker run -d -p 7777/:8080 --name tomcat tomcat:9.0.8-jre8-alpine
````

##### Crear un contenedor con Postgress
````
docker run -d --name postgress -e "POSTGRES_PASSWORD=12345678" -e "POSTGRESS_USER=docker-user" -e "POSTGRES_DB=docker-db" -p 5432:5432 postgres
````

##### Crear un contenedor con Jenkins
````
docker run -d --name jenkins -p 7070:8080 jenkins
````

##### Ejercicio

En donde trabajas, solicitan los siguientes contendores con las siguientes características:

Un contenedor con la imagen de Apache + php creada en la anterior solicitud con:
* 50Mb límites de RAM
* Solo podrá acceder a la CPU 0
* Debe tener dos variables de entorno:
    * ENV = dev
    * VIRTUALIZATION = docker
* El webserver debe ser accesible vía puerto 5555 en el navegador
````
docker run -d -m "50mb" --cpuset-cpus 0 --name apachephpmemcpu -e "ENV=dev" -e "VIRTUALIZATION=docker" -p 5555:80 apachephp
````

- Un contenedor con la imagen de Apache + php creada en la anterior solicitud con:

* 100Mb límites de RAM
* Podrá acceder a la cpu 0 y 1
* Debe tener tres variables de entorno:
    * ENV = stg
    * VIRTUALIZATION = docker
    * TYPE = container
* El webserver debe ser accesible vía puerto 8181 en el navegador
````
 docker run -d -m "100mb" --cpuset-cpus 0-1 --name apachephpmemcpu -e "ENV=stg" -e "VIRTUALIZATION=docker" -e "TYPE=container" -p 8181:80 apachephp
````

#### Mapeo de puertos

Si ejecutamos:
````
$ docker run -d jenkins
````
````
theasker@vps462589:~/docker-images$ docker ps
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                 NAMES
a9177342bf59        jenkins             "/bin/tini -- /usr..."   14 seconds ago      Up 13 seconds       8080/tcp, 50000/tcp   elegant_jackson
````

Con el comando docker ps vemos los contenedores en ejecución y vemos que en el apartado PORTS están expuestos los puertos 8080 y 50000, pero como en nuestro comando de ejecución `docker run -d jenkins` no hemos mapeado los puertos, es decir, que no le hemos dicho a docker en que puertos de nuestra maquina fisica queremos que se mapeen los puertos de nuestro contenedor, no podremos acceder a esos puertos. Para eso tenemos la opción `-p` de docker run en la que le diremos `-p <puerto host>: <puerto contenedor>`:
````
docker run -d -p 9090:8080 jenkins
````
````
$ docker ps
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                               NAMES
2e82c8958791        jenkins             "/bin/tini -- /usr..."   5 seconds ago       Up 4 seconds        0.0.0.0:9090->8080/tcp, 50000/tcp   angry_banach
````
`0.0.0.0:9090->8080/tcp`: Todas las interfaces de nuestra máquina en el puerto 9090 están siendo mapeadas al puerto 8080 de nuestro contenedor.

#### Limitar recursos de un contenedor

Con el comando `docker stats <nombre contenedor>` vemos los recursos que está consumiendo el contenedor.

##### Memoria
Con `docker run -d -m "500mb" --name mongo` (mb, gb).

##### CPU
El número de CPUs va dede 0 que es 1 CPU, por lo que para limitar el número de CPUs a usar entre una y dos, sería:
````
docker run -d  --name mongo mongo
````

### Docker commit

Sirve para crear una imagen a partir de un contenedor. **Si en ese contenedor se han hecho cambios en un volumen, estos no se guardarán**, ya que se supone que ese volumen se monta en el host y se guardan alli.
````
docker commit <imagen origen> <imagen destino>
````

## Volúmenes

Nos permite guardar datos de un contenedor de manera persistente en el host local. Como los contenedores son temporales, si se eliminan, se elimina también los datos, pero al usar volúmenes, estos datos persisten aunque se borre el contenedor. 

Hay 3 tipos de volúmenes:
* **Host**: Se almacenan en una carpeta dentro de nuestro sistema de ficheros que nosotros definimos.
* **Anonymus**: No definimos una carpeta pero docker asigna un directorio random donde persiste la información.
* **Named Volumes**: No son carpetas nuestras y si que tienen un nombre asignado y las administra docker.

### Volumenes de Host - Caso práctico MySQL

Queremos que las bases de datos de MySQL no se pierdan si destruimos el contenedor. Para eso creamos una carpeta en nuestro sistema de archivos donde se guardarán las bases de datos.
````
mkdir /opt/mysql
````
Ahora creamos nuestro contenedor
````
docker run -d --name db -p 3306:3306 -e "MYSQL_ROOT_PASSWORD=12345678" -v /opt/mysql/:/var/lib/mysql mysql:5.7
````

### Volumenes anónimos
Ahora creamos nuestro contenedor, casi igual que el comando anterior, pero sólo definire el volumen del contenedor y docker le asignara una carpeta al azar dentro de mi máquina
````
docker run -d --name db -p 3306:3306 -e "MYSQL_ROOT_PASSWORD=12345678" -v /var/lib/mysql mysql:5.7
````

Si hacemos un `docker info` veremos la carpeta root de docker, que está en `/var/lib/docker`.
````
$ docker info | grep -i root
Docker Root Dir: /var/lib/docker
````
Dentro del docker root hay una carpeta llamada **volumes** en `/var/lib/docker/volumes` en donde creará una carpeta aleatoria, que podemos ver cual es ejecutando `docker inspect db` y mirando en el apartado "Mounts".

No es recomendable usar este tipo de volúmenes, ya que cuando elimino el volumen con la opcion `-v` también se eliminará el volumen:
````
docker rm -fv db
````
Si se elimina el contendor **sin la opción `-v`**, es decir, `docker rm -f db`, el volumen no se eliminará.

#### VOLUME en un Dockerfile

Si ponemos dentro de un Dockerfile la instrucción `VOLUME /opt/`, se creará un **volumen anónimo** en el host enlazando a la ruta del contenedor `/opt`. Que podemos ver listando los volumenes con `docker volume ls`

### Volúmenes nombrados
Es como la **unión de un volumen de host y un volumen anónimo**, es decir, es un volumen creado independiente de un contenedor:
````
$ docker volume create mysql-data
mysql-data
$ docker volume ls
DRIVER              VOLUME NAME
local               mysql-data
````

Ahora ya sólo nos queda asignar ese volumen a un contenedor:
````
docker run -d --name mysql -v mysql-data:/var/lib/mysql -p 3306:3306 -e "MYSQL_ROOT_PASSWORD=12345678" -e "MYSQL_DATABASE=docker-db"  mysql:5.7
````

La diferencia con los volúmenes anónimos es que si luego eliminamos el contenedor con la opción `-v` no se elimina el volumen:
````
docker rm -fv mysql
````



## Enlaces
- https://www.udemy.com/docker-de-principiante-a-experto
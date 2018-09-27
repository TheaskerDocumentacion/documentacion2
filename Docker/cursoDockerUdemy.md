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
        - [Eliminar dangling Volumes](#eliminar-dangling-volumes)
- [ip a | grep docker](#ip-a--grep-docker)
        - [Conectar contenedores de la misma red](#conectar-contenedores-de-la-misma-red)
        - [Conectar contenedores de distintas redes](#conectar-contenedores-de-distintas-redes)
        - [Eliminar redes](#eliminar-redes)
        - [Asignar una IP a un contenedor](#asignar-una-ip-a-un-contenedor)
        - [La red Host](#la-red-host)
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

### Eliminar dangling Volumes
````docker volume ls -f dangling=true -q | xargs docker volume rm````

### Ejemplos de contenedores con datos persistentes

* **Persistiendo bases de datos en MongoDB**:
````
docker run -d -p 27017:27017 -v /opt/mongo/:/data/db mongo
````
Con este volumen, la próxima vez que creemos un nuevo contenedor, tendremos las bases de datos guardadas.

* **Persistiendo configuración y datos en Jenkins**: 
````
docker run -d -p 8080:8080 --name jenkins -v /opt/jenkins/:/var/jenkins_home jenkins
docker exec jenkins bash -c "cat /var/jenkins_home/secrets/initicalAdminPassword"
````
Y el resultado lo pegamos en la pantalla que lo pide en la instalación.

Con estos datos, la próxima vez que creemos un nuevo contenedor, que apunte al mismo volumen, Jenkins estará ya instalado y con todos los datos y tareas que ya tuvieramos.

* **Persistiendo configuración y datos en Jenkins**: 
````
docker run -d --name nginx -p 80:80 -v /opt/logs_nginx/:/var/log/nginx/ nginx
````
* **ejercicio**:

- Un contenedor con la imagen de Apache + php creada en la anterior solicitud con:
  * 50Mb límites de RAM
  * Solo podrá acceder a la CPU 0
   * Debe tener dos variables de entorno:
      * ENV = dev
      * VIRTUALIZATION = docker
  * El webserver debe ser accesible vía puerto 5555 en el navegador
  * En /opt/source1 (Debes crear el directorio en tu máquina local) debe persistir el código que se incluya en el webserver. En este caso, para pruebas, utilizarás un phpinfo que debe sobrevivir a la eliminación del contenedor.

````
docker run -d -e ENV=dev -e VIRTUALIZATION=docker -p 5555:80 -v /home/theasker/docker-images/volumes/source1/:/var/www/html/ apachephp

````

## Redes en Docker

Cuando instalamos Docker, se crea una interfaz de red virtual con su propia ip, en este caso `172.17.0.1/16`:
````
# ip a | grep docker
3: docker0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc noqueue state UP group default
    inet 172.17.0.1/16 scope global docker0
25: vethb962238@if24: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc noqueue master docker0 state UP group default
````

Si creamos un contenedor y lo inspeccionamos con `docker inspect <id|nombre>`:
````
"Gateway": "172.17.0.1",
"IPAddress": "172.17.0.3",
````

### Red por defecto de docker

Para ver la red por defecto de docker:
````
$ docker network ls
NETWORK ID          NAME                DRIVER              SCOPE
e0f4e1b1d817        bridge              bridge              local
7f2c0cb5a8b7        host                host                local
64f49e30aa86        none                null                local
````

Si inspeccionamos la red **bridge**:
````json
$ docker inspect bridge
[
    {
        "Name": "bridge",
        "Id": "e0f4e1b1d8175718dcca9ea0596f86a2ec7fbb413e0f968cab5bdbe68029c91a",
        "Created": "2018-09-18T13:23:35.21909352+02:00",
        "Scope": "local",
        "Driver": "bridge",
        "EnableIPv6": false,
        "IPAM": {
            "Driver": "default",
            "Options": null,
            "Config": [
                {
                    "Subnet": "172.17.0.0/16",
                    "Gateway": "172.17.0.1"
                }
            ]
        },
        "Internal": false,
        "Attachable": false,
        "Ingress": false,
        "ConfigFrom": {
            "Network": ""
        },
        "ConfigOnly": false,
        "Containers": {
            "a15fac664663b8e82acdeda49a9d5cda38634eef79ed5c4b110df609e53dd21a": {
                "Name": "confident_cray",
                "EndpointID": "035984b4b666b307a7aeaad134c91056b0c61bedfe8745d3a879dc33b35d9ab3",
                "MacAddress": "02:42:ac:11:00:03",
                "IPv4Address": "172.17.0.3/16",
                "IPv6Address": ""
            }
        },
        "Options": {
            "com.docker.network.bridge.default_bridge": "true",
            "com.docker.network.bridge.enable_icc": "true",
            "com.docker.network.bridge.enable_ip_masquerade": "true",
            "com.docker.network.bridge.host_binding_ipv4": "0.0.0.0",
            "com.docker.network.bridge.name": "docker0",
            "com.docker.network.driver.mtu": "1500"
        },
        "Labels": {}
    }
]
````

Veremos que el **Gateway** es el que sale en el interfaz que hemos visto `172.17.0.1` y la ip asignada al contenedor está en la subred que salía en la interfaz de red virtual `172.17.0.3`.

Si creamos 2 contenedores dentro de la misma red, podemos hacer un ping  de uno a otro:
````
$ docker run -dti centos
ea3a7da8f4479f0e40eb9467167b4491cc45664ebc93b8e07d8f10abf52b5703
theasker@vps462589:~$ docker run -dti centos
6857747bd1534a5b43ffabc57ccd33f42c26603033a49d6ffa939022327868f6
$ docker ps -a
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS               NAMES
6857747bd153        centos              "/bin/bash"              6 seconds ago       Up 5 seconds                            focused_bassi
ea3a7da8f447        centos              "/bin/bash"              7 seconds ago       Up 6 seconds                            sleepy_einstein
$ docker inspect focused_bassi| grep IPAddress
"IPAddress": "172.17.0.4",
````
````
$ docker inspect sleepy_einstein| grep IPAddress
"IPAddress": "172.17.0.2",
````
````
$ docker exec focused_bassi bash -c "ping 172.17.0.2"
PING 172.17.0.2 (172.17.0.2) 56(84) bytes of data.
64 bytes from 172.17.0.2: icmp_seq=1 ttl=64 time=0.279 ms
64 bytes from 172.17.0.2: icmp_seq=2 ttl=64 time=0.325 ms
64 bytes from 172.17.0.2: icmp_seq=3 ttl=64 time=0.064 ms
````
**En la red bridge se pueden ver los contedores por IP pero no por nombre**.

### Crear una red definida por el usuario

Para crear una red con **driver bridge**, que es el driver por defecto, que es una red virtual donde podemos agregar contenedores.
````
$ docker network

Usage:  docker network COMMAND

Manage networks

Options:
      --help   Print usage

Commands:
  connect     Connect a container to a network
  create      Create a network
  disconnect  Disconnect a container from a network
  inspect     Display detailed information on one or more networks
  ls          List networks
  prune       Remove all unused networks
  rm          Remove one or more networks

Run 'docker network COMMAND --help' for more information on a command.
````

Para crear una nueva red:
````
$ docker network create --help

Usage:  docker network create [OPTIONS] NETWORK

Create a network

Options:
      --attachable             Enable manual container attachment
      --aux-address map        Auxiliary IPv4 or IPv6 addresses used by Network
                               driver (default map[])
  -d, --driver string          Driver to manage the Network (default "bridge")
      --gateway stringSlice    IPv4 or IPv6 Gateway for the master subnet
      --help                   Print usage
      --ingress                Create swarm routing-mesh network
      --internal               Restrict external access to the network
      --ip-range stringSlice   Allocate container ip from a sub-range
      --ipam-driver string     IP Address Management Driver (default "default")
      --ipam-opt map           Set IPAM driver specific options (default map[])
      --ipv6                   Enable IPv6 networking
      --label list             Set metadata on a network
  -o, --opt map                Set driver specific options (default map[])
      --subnet stringSlice     Subnet in CIDR format that represents a network
                               segment
````
````docker network create test-network````

Para poder definir la subred en la q operará y el gateway en una red diferente a la de docker:
 ````docker network create -d bridge --subnet 172.124.10.0/24 --gateway 172.124.10.1 docker-test-network````

Y vemos que se ha creado
````
$ docker network ls | grep test
6981a4feb7af        docker-test-network   bridge              local
````

Inspeccionamos la red creada:
````json
$ docker network inspect docker-test-network
[
    {
        "Name": "docker-test-network",
        "Id": "6981a4feb7af3bcb32505ad4906f5fd41405ca602760882a994ced727f59af50",
        "Created": "2018-09-27T09:50:47.384951321+02:00",
        "Scope": "local",
        "Driver": "bridge",
        "EnableIPv6": false,
        "IPAM": {
            "Driver": "default",
            "Options": {},
            "Config": [
                {
                    "Subnet": "172.124.10.0/24",
                    "Gateway": "172.124.10.1"
                }
            ]
        },
        "Internal": false,
        "Attachable": false,
        "Ingress": false,
        "ConfigFrom": {
            "Network": ""
        },
        "ConfigOnly": false,
        "Containers": {},
        "Options": {},
        "Labels": {}
    }
]
````

Y para agregar un contenedor a una red específica que hemos creado:
````
docker run --network docker-test-network -d --name test3 -ti centos
````

e inspeccionando el contendor, vemos que se ha agregado a la red docker-test-network y que la ip asignada, así como el gateway es el correcto de la red que hemos configurado.
````json
 "Networks": {
    "docker-test-network": {
        "IPAMConfig": null,
        "Links": null,
        "Aliases": [
            "c487a17122ac"
        ],
        "NetworkID": "6981a4feb7af3bcb32505ad4906f5fd41405ca602760882a994ced727f59af50",
        "EndpointID": "4205a956c12aa9f872b6772c204fdeac4c77ffe9519feb7a8abbe0a8334662bb",
        "Gateway": "172.124.10.1",
        "IPAddress": "172.124.10.2",
        "IPPrefixLen": 24,
        "IPv6Gateway": "",
        "GlobalIPv6Address": "",
        "GlobalIPv6PrefixLen": 0,
        "MacAddress": "02:42:ac:7c:0a:02",
        "DriverOpts": null
    }
````

### Conectar contenedores de la misma red

Creamos 2 contenedores de la red que hemos creado:
````
$ docker run -d -it --network docker-test-network --name cont1 centos
b3b0821f3504f2eee21ffe7d25516c5d2f23a604bdf9da7932e90cafc4083e63
$ docker run -d -it --network docker-test-network --name cont2 centos
ec5a78d51685268a970994287b1292a3b887261959390e542ee01463965881a2
````

Si inspeccionamos los contenedores, vemos que están en el rango que le dijimos la crear la red:
````
$ docker inspect cont1 | grep -i "ipaddress"
    "IPAddress": "172.124.10.2",
$ docker inspect cont2 | grep -i "ipaddress"
    "IPAddress": "172.124.10.3",
````

Por lo que si hacemos un ping de uno al otro funcionará
````
$ docker exec cont1 bash -c "ping -c2 172.124.10.3"
PING 172.124.10.3 (172.124.10.3) 56(84) bytes of data.
64 bytes from 172.124.10.3: icmp_seq=1 ttl=64 time=0.292 ms
64 bytes from 172.124.10.3: icmp_seq=2 ttl=64 time=0.103 ms
````

En la red de docker, no podemos ver ni hacer ping a las redes por su nombre, pero en las redes definidas por el usuario, si:
````
$ docker exec cont1 bash -c "ping -c2 cont2"
PING cont2 (172.124.10.3) 56(84) bytes of data.
64 bytes from cont2.docker-test-network (172.124.10.3): icmp_seq=1 ttl=64 time=0.162 ms
64 bytes from cont2.docker-test-network (172.124.10.3): icmp_seq=2 ttl=64 time=0.075 ms
````

### Conectar contenedores de distintas redes

Tenemos 2 redes en diferentes subred:
````
$ docker network inspect test | grep -i subnet
                    "Subnet": "172.18.0.0/16",
$ docker network inspect docker-test-network | grep -i subnet
                    "Subnet": "172.124.10.0/24",
````

Creamos 2 contenedores cada uno en una red:
````
$ docker run -dit --network docker-test-network --name test1 centos
d686820a8cfc13b7efb176935704a1b0b5e8975005249c53bdd1f8c4141109af
$ docker run -dit --network test --name test2 centos
6f784f9cd4926e3752d1c07dd42e62705dfa07c6288c5be8bc17bf2402a5e77c
````

Y vemos que no se ven un contenedor con el otro:
````
$ docker exec test1 bash -c "ping -c3 test2"
ping: test2: Name or service not known
````

Para poder conectar 2 redes con distintas subred podemos usar el comando `docker network connect`. Lo que hace este comando es conectar un contenedor de otra subred a la red a la que queremos conectar.
````
$ docker network connect --help

Usage:  docker network connect [OPTIONS] NETWORK CONTAINER

Connect a container to a network

Options:
      --alias stringSlice           Add network-scoped alias for the container
      --help                        Print usage
      --ip string                   IPv4 address (e.g., 172.30.100.104)
      --ip6 string                  IPv6 address (e.g., 2001:db8::33)
      --link list                   Add link to another container
      --link-local-ip stringSlice   Add a link-local address for the container
````

En nuestro ejemplo sería:
````
docker network connect docker-test-network test2
````

Si ahora inspeccionamos el contenedor test2, veremos que se la ha agregado la nueva red, por lo que ahora pertenecerá a 2 redes:
````
$ docker inspect test2
 "Networks": {
    "docker-test-network": {
        "IPAMConfig": {},
        "Links": null,
        "Aliases": [
            "6f784f9cd492"
        ],
        "NetworkID": "6981a4feb7af3bcb32505ad4906f5fd41405ca602760882a994ced727f59af50",
        "EndpointID": "ca282c6ddcd91dc4f602715568340b3fc086d2b786233ad3b8a566f1a2669994",
        "Gateway": "172.124.10.1",
        "IPAddress": "172.124.10.3",
        "IPPrefixLen": 24,
        "IPv6Gateway": "",
        "GlobalIPv6Address": "",
        "GlobalIPv6PrefixLen": 0,
        "MacAddress": "02:42:ac:7c:0a:03",
        "DriverOpts": null
    },
    "test": {
        "IPAMConfig": null,
        "Links": null,
        "Aliases": [
            "6f784f9cd492"
        ],
        "NetworkID": "bd134ca63e3b624e2f182674ab95132f9ecd5aa8e7d6de609f24e9c85b511cf6",
        "EndpointID": "ff29b9915c7ca0f9891a7076125554c3501ad275e785e885905b8d7371e22d59",
        "Gateway": "172.18.0.1",
        "IPAddress": "172.18.0.2",
        "IPPrefixLen": 16,
        "IPv6Gateway": "",
        "GlobalIPv6Address": "",
        "GlobalIPv6PrefixLen": 0,
        "MacAddress": "02:42:ac:12:00:02",
        "DriverOpts": null
    }
}
````

jY ahora ya funciona la conexión:
````
docker exec test1 bash -c "ping test2"
PING test2 (172.124.10.3) 56(84) bytes of data.
64 bytes from test2.docker-test-network (172.124.10.3): icmp_seq=1 ttl=64 time=0.053 ms
````

Para volver a desconectarlo y dejarlo en su propia red:
````
docker network disconnect docker-test-network test2
````

### Eliminar redes

No podremos eliminar redes si hay algún contenedor conectado a esa red. Una vez eliminados los contenedores que estén conectados a la red, lo eliminaremos:
````
docker network rm docker-test-network
````

### Asignar una IP a un contenedor

Creamos una nueva red:
````
$ docker network create --subnet 172.128.10.0/24 --gateway 172.128.10.1 -d bridge my-net
0d68a4089b3e2953c4a3a86ffa0eef4d8f4be9e662f43e3496c12c978807540e
````

Si queresmos un contenedor en la ip 172.128.10.50, haremos:
````
docker run --network my-net --ip 172.128.10.50 -d --name nginx -ti centos
6faf0c7fed90cb137db6d014b2281350fdbf952a2efecebb904f884152dadd8b
````

Y podemos ver que se ha creado con esa ip:
````
$ docker inspect nginx | grep -i ipadd
            "SecondaryIPAddresses": null,
            "IPAddress": "",
                    "IPAddress": "172.128.10.50",
````

Para que funcione esto, tenemos que habe creado **una red con una subred y un gateway definidas**.

### La red Host

Es la red de nuestra máquina:
````
$ ip a | grep ens
2: ens3: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc pfifo_fast state UP group default qlen 1000
    inet 145.239.196.19/32 brd 145.239.196.19 scope global ens3
````

Creamos un contenedor y entramos para ver la ip:
````
theasker@vps462589:~$ docker run -it --name centos --network host centos bash
[root@vps462589 /]# ifconfig
...
ens3: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
        inet 145.239.196.19  netmask 255.255.255.255  broadcast 145.239.196.19
        inet6 fe80::f816:3eff:fe4f:83a0  prefixlen 64  scopeid 0x20<link>
        ether fa:16:3e:4f:83:a0  txqueuelen 1000  (Ethernet)
        RX packets 977125  bytes 234510022 (223.6 MiB)
        RX errors 0  dropped 0  overruns 0  frame 0
        TX packets 892585  bytes 122746776 (117.0 MiB)
        TX errors 0  dropped 0 overruns 0  carrier 0  collisions 0
...
````
Adquiere todas las propiedades de la máquina host, incluso el **hostname**:
````
theasker@vps462589:~$ hostname
vps462589
theasker@vps462589:~$ docker exec -it centos bash -c "hostname"
vps462589
````



## Enlaces
- https://www.udemy.com/docker-de-principiante-a-experto
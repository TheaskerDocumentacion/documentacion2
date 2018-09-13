# Curso Docker de Udemy (Ricardo Andre Gonzalez Gomez)

## Dockerfile
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

## Tratamiento de imagenes

### Eliminar imágenes `docker rmi`

`docker rmi` <id>|<image name>
````
docker rmi centos:prueba apache-centos:latest
````

### Eliminar imágenes "huerfana"

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

### Contruir una imagen con otrof fichero distinto de DockerFile
Si en vez de usar el típico fichero `DockerFile` usamos otro nombre como `my-dockerfile`:
````
docker build -t test -f my-dockerfile .
````

## Creación de imágenes de ejemplo

### Apache + PHP + SSL

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

### Creación de una imagen con Nginx y PHP-FPM

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


````

## Enlaces
- https://www.udemy.com/docker-de-principiante-a-experto
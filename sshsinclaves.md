# Configurar conexiones ssh sin password

Queremos conectarnos desde PC1 al PC2 sin introducir contraseña:

PC1 → Generamos la llave pública

	ssh-keygen -b 4096 -t rsa

Aceptamos con enter las 3 veces que nos lo pida.
Ahora tenemos que darle esa copia al PC2 que nos vamos a conectar (192.168.0.70)

	ssh-copy-id -p 2223 www-data@192.168.0.70

Donde ”-p 2345” es el puerto donde está configurado el servidor ssh y pi es el usuario del PC2 del cual necesitaremos y nos pedirá su contraseña.

Con estos pasos ya no nos volverá a pedir la contraseña para conectarnos desde el PC1 al PC2.

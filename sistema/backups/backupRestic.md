# Copias de seguridad con Restic

## Instalación de Restic

    apt install restic

## Inicialización del repositorio

El lugar donde estarán nuestras copias es un "repositorio" y lo tenemos que inicializar.

    restic -r /home/ubuntu/resticbackups init

O también en un repositorio remoto:

    restic -r sftp:ubuntu@podereuropeo.duckdns.org:/home/ubuntu/resticbackups2 init


Esto crea un directorio con los metadatos necesarios para almacenar nuestros backups.

Para comprobar el estado del repositorio:

    restic -r sftp:ubuntu@podereuropeo.duckdns.org:/home/ubuntu/resticbackups2 check

Bibliografía
------------
 * https://adamtheautomator.com/restic-backup/
 * https://voidnull.es/restic-el-programa-que-hace-copias-de-seguridad-correctamente/
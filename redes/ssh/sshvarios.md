

# Comandos "avanzados" de SSH

- [Comandos "avanzados" de SSH](#comandos-avanzados-de-ssh)
  - [ssh sin contraseña (copiar clave pública)](#ssh-sin-contraseña-copiar-clave-pública)
  - [Ejecutar un comando remoto con terminal](#ejecutar-un-comando-remoto-con-terminal)
  - [Usar ssh como proxy](#usar-ssh-como-proxy)
  - [Ejecutar aplicaciones gráficas por ssh](#ejecutar-aplicaciones-gráficas-por-ssh)
  - [Hacer un "tunel ssh"](#hacer-un-tunel-ssh)
  - [Tunel ssh Inverso](#tunel-ssh-inverso)
  - [Bibliografía](#bibliografía)


## ssh sin contraseña (copiar clave pública)
`ssh-copy-id ubuntu@theaskervps.duckdns.org`

Con este comando copiamos la clave pública de nuestro host a el equipo remoto a su archivo `~/.ssh/authorized_keys`

## Ejecutar un comando remoto con terminal
`ssh -t theasker@theaskervps.duckdns.org irssi`

Ejecuta un comando con terminal y al terminar ese comando, servicio o programa se sale de la terminal remota ssh.

## Usar ssh como proxy
`ssh -D 8090 theasker@theaskervps.duckdns.org`

Al ejectutar este comando, se crea un **proxy socks** que podremos usar con cualquier programa que soporte proxy, como por ejemplo un navegador, y después de configurarlo navegaremos como si estuvieramos navegando desde el servidor y no desde el cliente donde está el navegador o la aplicación donde hayamos configurado el proxy. Esta configuración en la aplicación tendrá que ser:
- **Servidor proxy de SOCKS**: "localhost"
- **Puerto**: el que hemos puesto, en este caso 8090

## Ejecutar aplicaciones gráficas por ssh
En linux, el entorno gráfico es un servicio (servidor X11), por lo que podemos conectarnos remotamente a este servicio.
Hay que configurar primero nuestro servicio ssh para que soporte este tipo de conexión.

`ssh -X theasker@theaskervps.duckdns.org firefox`

o hacer primero la conexión y luego ejecutar la aplicación a usar
```
$ ssh -X ubuntu@theaskervps.duckdns.org
ubuntu@theasker-20220727:~$ firefox
```

## Hacer un "tunel ssh"
Hay veces que un servidor no está expuesto a internet y sólo es accesible desde otro servidor. Entonces lo que hacemos es crear en nuestra máquina un puerto por el que accederemos a esa otra máquina que no está accesible por medio del servidor que puede acceder:

`ssh -L 2020:<serv.destino(no accesible)>:22 root@<serv.accesible>`

Con esto ya tenemos abierto el **tunel ssh** por medio del puerto 2020 que hemos abierto en nuetra máquina.

Luego ya en una terminal nueva desde nuestro equipo nos podremos conectar al segundo servidor, haciendo:
`ssh localhost:2020`

Ejemplo:
Queremos acceder a una máquina que no tiene acceso al exterior, pero si desde otra máquina de la red que sólo tiene expuesto su puerto ssh (22):
- **Ip/dominio externo de la red (accesible)**: theaskervps.duckdns.org
- **ip privada de la máquina con el servicio no expuesto**: 10.0.0.88
- **Puerto temporal que se creará en nuestra host**: 3333
- **Puerto del servicio al que queremos acceder en la máquina no expuesta**: 80

`ssh -L 3333:10.0.0.88:80 ubuntu@theaskervps.duckdns.org`

## Tunel ssh Inverso

## Bibliografía
- [Youtube de Pelado Nerd - Aprendiendo SSH - Parte 2 / Comandos AVANZADOS!](https://www.youtube.com/watch?v=IDDmqlN-hF0&t=0s)
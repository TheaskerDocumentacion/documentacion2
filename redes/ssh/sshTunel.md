# Tunel ssh

````bash
ssh -p 22 -N -D 8081 pi@theasker.mooo.com
````

* **`-p 22`**: Con este parámetro indicamos el puerto de escucha de nuestros servidor SSH. El puerto de escucha estándard acostumbra a ser el 22 para los servidores SSH. En el caso que hayamos modificado el puerto de escucha deberemos sustituir el 22 por nuestro puerto real de escucha.

* **`-D 8081`**: **Estamos especificando que se realice un reenvio dinámico de puertos o tunel dinámico**. Por lo tanto con este comando estamos indicando que el tunel SSH se establezca a través del puerto local 8081. En el puerto 8081 habrá un servidor proxy socks que escuchará las conexiones del puerto 8081. Cuando el servidor proxy socks detecte una solicitud o conexión en el puerto 8081 enviará el tráfico cifrado a través del tunel SSH que creamos entre la cafetería y nuestra casa. Una vez la petición/información llegue a nuestra casa o servidor SSH, como hemos establecido un tunel dinámico, se redirigirá al sitio de Internet que queremos conectarnos que por ejemplo podría ser Facebook o Twitter.

> Nota: Estamos usando el puerto 8081 pero se puede usar cualquiera de los puertos no privilegiado que van desde el 1025 al 65535. En el caso de querer usar un puerto privilegiado deberemos hacerlo como root añadiendo sudo al inicio comando para establecer el tunel SSH.

> Nota: El servidor local Proxy Socks es quien realmente está enviando el trafico de nuestro ordenador al servidor SSH que está en una red local segura. Por lo tanto la información que reciba el servidor proxy socks a través del cliente, que en este caso es Firefox, debe enviarse con el protocolo Socks. Por lo tanto los clientes como Firefox u otros deberán ser capaces de enviar sus peticiones a través del protocolo socks. En el caso que la aplicación no soporte la comunicación con el protocolo socks no se podrá establecer la conexión. Para aplicaciones que no soporten socks tenemos la opción de usar tsocks en nuestro ordenador. En futuros post comentaremos como usar tsocks.

* **`-N`**: **Permite que se establezca el tunel SSH pero que no se abra una sesión interactiva con el servidor SSH**. En el caso de no usar esta opción, nuestra conexión SSH estará permanentemente abierta y si alguien nos robará el ordenador o nos despistaros y alguien malintencionado tuviera acceso al ordenador nos podría por ejemplo borrar completamente la información que tenemos almacenada en nuestro servidor SSH.

## Enlaces
* https://geekland.eu/establecer-un-tunel-ssh/
* https://geekland.eu/que-es-y-para-que-sirve-un-tunel-ssh/
* https://blog.desdelinux.net/como-crear-un-tunel-ssh-entre-un-servidor-linux-y-un-cliente-windows/
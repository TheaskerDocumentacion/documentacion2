# Amazon Web Services



**Región** Sería un datacenter donde podemos trabajar con los productos de AWS. En Europa a día de hoy hay 2 una en Irlanda y otra en Frankfurt. Cada región tiene 2 ó 3 **zonas de disponibilidad** o **Availability Zones** separados totalmente unos de otros, estas zonas de disponibilidad podemos elegir en cual podemos usar para desplegar los recursos.

## Key Pair

Es un conjunta de claves público/privadas para acceder a nuestros servidores. 

Después de crearla se descarga un fichero con extensión .pem y podemos usar esta clave para entrar en nuestros servidores sin necesidad de usar una contraseña.

[http://docs.aws.amazon.com/es_es/AWSEC2/latest/UserGuide/AccessingInstancesLinux.html](Connecting to Your Linux Instance Using SSH)

## Security Groups

En las **Security Groups** decimos las reglas de firewall que va a tener una instancia.

## Elastic IPs

Cuando levantamos una instancia, va a tener una ip pública y una ip privada. Con las ips privadas de las intancias podemos crear una infraestructura ( 192.168.0.0/24 ), pero la ip pública, puede cambiar cada vez que reiniciamos o paramos la instancia, es decir, no es una ip fija. Para solucionar esto y poder conectarnos correctamente con nuestra instancia, usaremos **Elastic IP**. Cuando generamos una Elastic IP, el sistema generará una ip que va a estar siempre asociada a tu cuenta.

Cuando creemos una instancia, nos permitirá asiciar esta ip a la instancia para poder acceder.

## Instancias

Cuando terminamos una instancia, la destruimos y no podremos acceder a ellas más, aunque se quedan en la lista de instancias con el status de "terminated", durante unas horas.

### AMIs

Cuando lanzamos una instancia, tenemos que usar un AMI (Amazon Machina Images) que es una imagen de una máquina virtual ya preparada para ser lanzada.

En **AWS marketplace** tenemos una lista de máquinas virtuales para ser usadas (https://aws.amazon.com/marketplace)
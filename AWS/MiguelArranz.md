# Curso AWS de Miguel Arranz

## Security groupos
Es donde pones las reglas de firewall, donde ponemos los puertos que abrimos y hacia dónde los abrimos. En las instancias asignaremos las diferentes security groups.

## Elastic IPs
Cada instancia de EC2 que levantamos tendrá una IP privada y una IP pública. 
La IP privada será las que le asigne aunque las paremos y las volvamos a arrancar.
La IP pública que tiene cada instancia no es siempre la misma, es decir, cuando tu paras y vuelves a arrancar una instancia, la IP pública puede cambiar.

Por todo esto tenemos la **Elastic IPs**, que crea una IP asignada a tu cuenta de AWS y que podemos asignar a cada instancia.

Cada usuario tiene una VPC, es decir tiene su propia red privada para poder comunicar sus máquinas virtuales.

## AMI (Amazon Machine Images)
Imagen de una máquina ya preparada para ser usada.


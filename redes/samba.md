# Samba
- [Samba](#samba)
  - [Instalación](#instalación)
  - [Referencias](#referencias)

## Instalación

```bash
sudo pacman -S samba
```

El sistema no trae archivo de configuración `/etc/samba/smb.conf` y lo creamos usando el ejemplo del repositorio de GitHub de samba en https://git.samba.org/samba.git/?p=samba.git;a=blob_plain;f=examples/smb.conf.default;hb=HEAD:

```bash
cd /etc/samba
touch smb.conf
```

Pegamos el contenido del enlace https://git.samba.org/samba.git/?p=samba.git;a=blob_plain;f=examples/smb.conf.default;hb=HEAD:

Iniciamos el servicio
```bash
systemctl enable smb
Created symlink /etc/systemd/system/multi-user.target.wants/smb.service → /usr/lib/systemd/system/smb.service.
systemctl start smb
```

Instalamos el cliente:
```bash
pacman -S smbclient
```

Vemos los recursos compartidos:
```bash
smbclient -L localhost -U%
```

## Referencias
* https://wiki.archlinux.org/title/samba
* https://access.redhat.com/documentation/es-es/red_hat_enterprise_linux/8/html/configuring_and_managing_virtualization/sharing-files-between-the-host-and-windows-virtual-machines_sharing-files-between-the-host-and-its-virtual-machines
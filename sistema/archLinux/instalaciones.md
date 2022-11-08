# Instalaciones del sistema

## Docker

    pacman -S docker docker-compose
    $ sudo usermod -aG docker $USER

    sudo systemctl enable docker
    sudo systemctl start docker

## Hardware / drivers

### Nvidia drivers

    sudo pacman -S nvidia-installer-dkms

Con esto comprobamos la tarjeta que tenemos y nos dirá qué tenemos que instalar:

    $ nvidia-installer-check
    NVIDIA card id: 1287
    The nvidia-dkms version: 520.56.06-2
    Graphics card (id: 1287):
    - Is supported by the nvidia-470xx-dkms driver.
    - To install a driver for this card:
        - Use the --force option with nvidia-installer-dkms.
        - Then, BEFORE rebooting,
        - uninstall nvidia-dkms, nvidia-utils, and related other Nvidia driver packages
        - install 470 series packages
        Example:
        yay -Rsn nvidia-dkms nvidia-utils nvidia-settings
        yay -S nvidia-470xx-dkms nvidia-470xx-utils nvidia-470xx-settings




## sistema

    pacman -S gnome-disk-utility
    pacman -S gparted

### Grub

Editar fichero `etc/default/grub` y descomentar la línea: `#GRUB_DISABLE_OS_PROBER=false` y luego recargar

    sudo grub-mkconfig -o /boot/grub/grub.cfg


## Internet

    sudo pacman -S telegram-desktop
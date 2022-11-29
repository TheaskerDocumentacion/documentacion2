# Instalaciones del sistema

## Docker

    sudo pacman -S docker docker-compose
    sudo usermod -aG docker $USER
    sudo newgrp docker

    sudo systemctl enable docker
    sudo systemctl start docker

    sudo pacman -S lightdm-gtk-greeter-settings 


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
    $ yay -S nvidia-470xx-dkms nvidia-470xx-utils nvidia-470xx-settings

## sistema

    sudo pacman -S gnome-disk-utility gparted
    sudo pacman -S mc
    sudo pacman -S partclone
    sudo pacman -S htop
    sudo pacman -S veracrypt

Desactivar el firewall

    sudo systemctl stop firewalld
    sudo systemctl disable --now firewalld
    sudo pacman -R firewalld

Modificar `~/.bashrc`:

    nano ~/.bashrc
    PS1='\[$(tput setaf 39)\]\u\[$(tput setaf 81)\]@\[$(tput setaf 77)\]\h \[$(tput setaf 226)\]\w \[$(tput sgr0)\]\$ '

### Zram

    $ yay -S zramd
    # systemctl enable zramd
    # systemctl start zramd

Vemos que está activo con:

    $ swapon
    NAME       TYPE      SIZE   USED PRIO
    /dev/sdd2  partition 7,8G 355,5M   -2
    /dev/zram0 partition   2G 409,5M  100
    /dev/zram1 partition   2G 385,6M  100

o con mucha más información:

    $ zramctl 
    NAME       ALGORITHM DISKSIZE   DATA COMPR TOTAL STREAMS MOUNTPOINT
    /dev/zram1 zstd            2G  77,7M 19,8M 21,5M       4 [SWAP]
    /dev/zram0 zstd            2G 103,2M 23,9M 25,5M       4 [SWAP]

El archivo de configuración está en `/etc/default/zramd`


    $ cat /etc/default/zramd 
    # See available algorithms by running "cat /sys/block/zramX/comp_algorithm"
    # ALGORITHM=zstd

    # Max fraction of physical memory to use
    # FRACTION=1.0

    # Max total swap size in MB
    MAX_SIZE=4096

    # Number of zram devices to create
    NUM_DEVICES=2

    # Swap priority
    # PRIORITY=100

    # Skip initialization if running inside a virtual machine
    # SKIP_VM=false


### Dotfiles con dotdrop

    cd /mnt/datos1/backup/dotfiles
    sudo pacman -S python-pip
    pip3 install -r dotdrop/requirements.txt --user

Modificar `~/.bashrc`:

    nano ~/.bashrc
    alias dotdrop='/mnt/datos1/backup/dotfiles/dotdrop/dotdrop.sh'

### /etc/fstab

    UUID=48b71f34-1eca-4f20-96fd-016bcbf12a57 /              ext4    defaults,noatime 0 1
    tmpfs                                     /tmp           tmpfs   defaults,noatime,mode=1777 0 0
    # Swap
    UUID=f6a5653d-8f33-4efe-99d7-0f710342c949   none    swap    defaults    0   0

    # Discos de datos
    UUID=0d475404-655d-4d8c-af2c-8e3258ce5bd3	/mnt/datos1	btrfs	compress=zstd,relatime,rw  0 0
    UUID=4a894b50-328d-4f57-9460-f76b4bd2a67e	/mnt/datos2	btrfs	compress=zstd,relatime,rw  0 0
    UUID=7720197f-b04d-47fd-b180-143b028eb852	/mnt/datos3	btrfs	compress=zstd,relatime,rw  0 0

### Grub

    sudo mkdir /mnt/datos1 /mnt/datos2 /mnt/datos3 && chmod 777 /mnt/*
    sudo systemctl daemon-reload
    sudo mount /mnt/datos1 && sudo mount /mnt/datos2 && sudo mount /mnt/datos3

Editar fichero `etc/default/grub` y descomentar la línea: `#GRUB_DISABLE_OS_PROBER=false` y luego recargar

    sudo grub-mkconfig -o /boot/grub/grub.cfg

### Varios

Configuración de dispositivos Logitech
    
    sudo pacman -S piper

## Internet

    sudo pacman -S telegram-desktop

## Multimedia

    yay -S plex-media-server
    sudo pacman -S smplayer

## Varios

    sudo pacman -S xfce4-cpugraph-plugin xfce4-weather-plugin
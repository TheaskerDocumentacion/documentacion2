# Instalación Arch Linux sobre Btrfs

 * Formateo la partición
    ```bash
    # mkfs.btrfs /dev/sdc3
    ```
 * Monto la partición
    ```bash
    # mount -o compress=zstd /dev/sdc3 /mnt/arch
    ```
 * Creo los subvolumenes
    ```bash
    # mount -o compress=zstd /dev/sdc3 /mnt/arch
    # cd /mkt
    # btrfs sub cr /mnt/arch/@
    # btrfs sub cr /mnt/arch/@boot
    # btrfs sub cr /mnt/arch/@etc
    # btrfs sub cr /mnt/arch/@home
    # btrfs sub cr /mnt/arch/@tmp
    # btrfs sub cr /mnt/arch/@log
    # btrfs sub cr /mnt/arch/@pkg
    # btrfs sub cr /mnt/arch/@snapshots
    ```


## Bibliografía

 * https://www.muylinux.com/2022/01/27/archinstall-2-3-1/
 * https://www.arcolinuxd.com/installing-arch-linux-with-a-btrfs-filesystem/
 * https://wiki.archlinux.org/title/Installation_guide_(Espa%C3%B1ol)
 * https://wiki.archlinux.org/title/btrfs
 * https://www.nishantnadkarni.tech/posts/arch_installation/
 * https://github.com/Deebble/arch-btrfs-install-guide

### Opciones de montaje útiles del sistema de archivos Btrfs - Sugerencia para Linux
 * https://ciksiti.com/es/chapters/4271-useful-mount-options-of-the-btrfs-filesystem--linux-hint


### Optimizando fstab para discos SSD con Btrfs
 * https://elblogdelazaro.org/posts/2019-07-26-optimizando-fstab-para-discos-ssd--con-btrfs/
 * https://gist.github.com/yoyo308/9a4ae6a517597a698a19
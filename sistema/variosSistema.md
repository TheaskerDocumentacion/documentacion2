# Utilidades varias de Sistemas

## Limitar uso de CPU

    cpulimit -p <PID proceso> -l <porcentaje límite>

## Revisar errores de disco

    badblocks -v /dev/sda > /tmp/badblocks.txt

## Dotfiles

  * https:/It is possible to add devices to a multiple-device filesystem later on. See the Btrfs wiki article for more information.
Devices can be of different sizes. However, if one drive in a RAID configuration is bigger than the others, this extra space will not be used.
Some boot loaders such as Syslinux do not support multi-device file systems.
Btrfs does not automatically read from the fastest device, so mixing different kinds of disks results in inconsistent performance. See [1] for details./atareao.es/podcast/dotdrop-un-completo-gestor-de-dotfiles/ => Gestor de dotfiles
  
  
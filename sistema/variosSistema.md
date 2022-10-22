# Utilidades varias de Sistemas

## Limitar uso de CPU

    cpulimit -p <PID proceso> -l <porcentaje límite>

## Revisar errores de disco

    badblocks -v /dev/sda > /tmp/badblocks.txt

## Dotfiles

  * https://atareao.es/podcast/dotdrop-un-completo-gestor-de-dotfiles/ => Gestor de dotfiles
  
## Varios
 * ventoy => Aplicación para grabar isos en USB
 * Crear un fichero de ceros: `dd if=/dev/zero of=/archivogrande bs=1024 count=512k`
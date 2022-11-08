# Utilidades varias de Sistemas

## Limitar uso de CPU

    cpulimit -p <PID proceso> -l <porcentaje límite>

## Revisar errores de disco

    badblocks -v /dev/sda > /tmp/badblocks.txt

## Dotfiles

  * https://atareao.es/podcast/dotdrop-un-completo-gestor-de-dotfiles/ => Gestor de dotfiles

## Bash

### Tutorial sobre la terminal de Atareao.es

 * https://atareao.es/tutorial/terminal/


### Unificar el historial de bash

Agregar estas líneas al fichero `~/.bashrc`:

```bash
#unified bash history
shopt -s histappend 
PROMPT_COMMAND="${PROMPT_COMMAND:+$PROMPT_COMMAND$'\n'}history -a; history -c; history -r"
```

> Fuente: https://www.enmimaquinafunciona.com/pregunta/25760/pueden-unificar-archivos-de-historial-de-bash

## Varios
 * **ventoy** => Aplicación para grabar isos en USB
 * Crear un fichero de ceros: `dd if=/dev/zero of=/archivogrande bs=1024 count=512k`
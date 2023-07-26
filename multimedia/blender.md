# Blender

- [Blender](#blender)
  - [Atajos de teclado](#atajos-de-teclado)
    - [Para movernos dentro de la vista](#para-movernos-dentro-de-la-vista)
    - [Origin (Median point), cursor 3D y flechas de coordenadas](#origin-median-point-cursor-3d-y-flechas-de-coordenadas)
      - [Cambios de vista](#cambios-de-vista)
  - [Transformar objetos](#transformar-objetos)
    - [Herramienta mover objeto](#herramienta-mover-objeto)
    - [Herramienta de Rotar objeto](#herramienta-de-rotar-objeto)
    - [Escalar objeto](#escalar-objeto)
    - [Menú Snap (`Shift` + `s`)](#menú-snap-shift--s)
  - [Conjunto de objetos](#conjunto-de-objetos)
    - [Herencia de objetos](#herencia-de-objetos)
    - [Fusionar objetos](#fusionar-objetos)
    - [Agrupar objetos](#agrupar-objetos)
  - [Crear objetos](#crear-objetos)
  - [Edit mode](#edit-mode)
    - [Selecciones](#selecciones)
    - [Modificadores](#modificadores)
    - [Subdividir](#subdividir)
    - [Borrar y rellenar](#borrar-y-rellenar)
    - [Fusionar vértices](#fusionar-vértices)
    - [Suavizado](#suavizado)
    - [Diferencias de objetos (Boolean)](#diferencias-de-objetos-boolean)
      - [Knife Project](#knife-project)
  - [Cámara](#cámara)
  - [Varios](#varios)
  - [Pendiente de comprobar](#pendiente-de-comprobar)
  - [Bibliografía](#bibliografía)
    - [Enlaces de Blender España (Telegram)](#enlaces-de-blender-españa-telegram)


## Atajos de teclado
 * `F3` => Ayuda para encontrar acciones
 * `Q`(**Quick Favorites**) => Para guardar en favoritos
 * Crtl + space = Expande vista y oculta
 * Mover + `Shift` => más **precisión**
 * Mover + `Ctrl` => **snap** a otros objetos
 * `a`=> Seleccionar todos los objetos
 * `alt` + `a` => Deseleccionar todos los objetos
 * `x` => Eliminar objetos, aritas, vértices, etc.

### Para movernos dentro de la vista
 * Botón rueda => para movernos 
 * Shift + Botón rueda => Panea
 * Los botones del teclado numérico:
   * `1` => Frontal
   * `Ctrl` + 1 => Frontal invertido
   * `5` => Frontal perspectiva
   * `3` => Lateral
   * `Ctrl` + `3` => Lateral invertido
   * `7` => Vista superior
   * `Ctrl` +`7` => Vista superior invertido
   * `9` =>   Invertir la vista en la que estás
   * `2` y `8` => Girar verticalmente
   * `4` y `6` => Girar horizontalmente

### Origin (Median point), cursor 3D y flechas de coordenadas
Con el menú **Transform Pivot Point** permite elegir el punto de pivote para tus transformaciones. El punto de pivote es el punto alrededor del cual se rotarán, escalarán o moverán tus objetos.
 * `Shift` + `c` => Centrar el cursor 3D en el objeto
 * `Crtl` + `.` => Se activa la modificación del punto de origen
 * Botón derecho sobre el objeto + `Set origin` + <elegir opción> => Mueve el centro origen del objeto donde queramos
 * `Shift` + `s` => Menú Snap
 * Menú **Object** > **Set Origin** => Modificación del 'Origin' del objeto.
 * `Shift` + click derecho => Mueve el cursor donde queramos
 * Para tener en cuenta el cursor para las transformaciones podemos ir al Menú **Transform Pivot Point** > **3D cursor**
 * Panel `n` donde podemos mover el cursor
 * `Barra espaciadora` => Muestra las flechas de coordenadas para las transformaciones.

#### Cambios de vista
 * **Seleccionamos objeto** + **View** > **Frame selected** => Nos centra la vista en el objeto seleccionado. También el `.` del teclado numérico
 * `/` (teclado numérico) => Nos centra en el objeto y oculta todo lo demás
 * `z`=> Sale el menú de vista
 * Numpad `.` => Nos centra en el objeto seleccionado

## Transformar objetos
Cuando pulsamos `Shift` + `x | y | z `, la transformación afecta a las otras 2 coordenadas que no son la que se ha pulsado.

### Herramienta mover objeto
   * `g` => Movimiento en todas direcciones
     * `g` + `x`|`y`|`z` => Limita al eje
     * `g` + rueda central => Limita a los ejes

### Herramienta de Rotar objeto
 * `r` => Movimiento en todas direcciones
   * `r` + `x`|`y`|`z` => Limita al eje
   * `r` + rueda central => Limita a los ejes

### Escalar objeto
 * `s` => Movimiento en todas direcciones
   * `s` + `x`|`y`|`z` => Limita al eje
   * `s` + rueda central => Limita a los ejes

### Menú Snap (`Shift` + `s`)
Con estas herramientas, puedes alinear, posicionar y mover elementos de manera precisa 

## Conjunto de objetos
### Herencia de objetos
Se hace click primero en el objeto que quieres que sea el padre y luego se selecciona el resto. Luego pulsamos el menú **Objet** > **Parent** > **Object** (`Crtl` + `p`) y cuando transformemos el padre se transformarán también los hijos, pero no al revé. 
Para deshacer **Objet** > **Parent** > **Clar and Keep tronsformation**

### Fusionar objetos
 * Click derecho + **join** / `Ctrl` + `j`

### Agrupar objetos
Selección de objetos + botón derecho + `m` => Se añade a una nueva colección.

## Crear objetos
 * `Shift` + `d` => Duplicar objetos
 * Si se pulsa `Esc` después de duplicar deja el objeto el el mismo sitio que el original.
 * `Shift` + `a` => Menú de creación de objetos

## Edit mode
 * `Tab` => Cambiamos entre **Edit mode** y **Object mode**
 * `f` => Rellenar
 * `k` => knife. Cuchillo para recortar con líneas bezier

### Selecciones
Los objetos que creamos dentro del **Object mode** se añaden al objeto que tenemos seleccionado y es como uno solo.
 * `1` => Selección de vértice
 * `2` => Selección de arista
 * `3` => Selección de cara

 * Numpad `.` => Nos centra en el objeto seleccionado
 * `b` => Caja de selección

 * Selección de todo un objeto => Seleccionamos una cara del objeto + `L`

 * **Seleccionar todas las aristas contiguas** => `Shift`+ `Alt` + `Click`
 * `Crtl` + `i` => Invertir selecciónC

### Modificadores
 * `a` => Selecciona todo
 * `e` => Extruir
 * `Shif` + `e` => **"Extrude Along Normals"** => Esto significa que cada elemento se moverá en su propia dirección normal sin afectar a los demás.
 * `s` => Escalar
 * `Alt` + `s` => "Scale Along Normals" (Escalar a lo largo de las normales) o "Shrink/Fatten" (Encoger/Agrandar). Esta acción permite escalar una selección de vértices, aristas o caras a lo largo de sus normales individuales.
 * `i` => Insertar caras en la cara seleccionada (Inset). Pulsando `Ctrl` movemos la subdivisión creada
 * `Ctrl` + `b` => Bevel
 * **Seleccionar una región entre 2 loops (anillos de aristas)**:
   * Seleccionamos un loop con `Alt` + `Shift` + click y luego otro click en el segundo loop
   * Menu **Select** > **Select Loop** > **Select Loop Inner Region**
 * `Alt` + `b` => **"Clipping Border"**: Todo lo que se encuentre fuera de esa región no se mostrará ni se renderizará.

### Subdividir
 * `Botón derecho`+ **Subdivide**
 * Herramienta **Loop Cut** => Subdivide la pieza en 2. Si pinchas y arrastras con el ratón pones la división donde quieras.

### Borrar y rellenar
 * Para hacer un agujero correcto en una pieza, seleccionamos las caras de ambos lados que queremos agujerear, pulsamos **botón derecho** + **Birdge Faces**

 * Seleccionamos las caras o aristas colindantes y pulsamos `f`

### Fusionar vértices
 * Selecciono > Menú **Mesh** > **Merge** (`m`)

### Suavizado
 * Llave fija + **Subdivision Surface**
 * Botón derecho + **Shade Smooth**
 * Botón derecho + **Shade Smooth** + **Object Data Properties** > **Normals** > **Auto Smooth**

 * **Barra derecha de opciones** > **Object Data Properties** > **Normals** > **Auto Smooth**
 * Y después **menú Object** > **Shade Auto Smooth**

### Diferencias de objetos (Boolean)
 * `Shift` + `-` 
 * Seleccionamos el objeto principal > **Modifier Properties** > **Boolean** > Seleccionar el objeto cotador
 * **Object Properties** > **Viewport Display** > **Display AS** > Elegir cómo queremos verlo

#### Knife Project
 - Seleccionamos el objeto objetivo en **Object Mode**
 - Pulsamos `tab` para entrar en el **Edit mode**
 - Pulsamos `Ctrl` y hacemos click en el objeto cortador
 - Menú **Mesh** > **Knife Project**

## Cámara
 * `Ctrl` + `Alt` + `0` => Fija la cámara a la vista que hemos seleccionado

## Varios
 * Limpiar vértices y artitas duplicados
   - Seleccionamos todo pulsando `a`
   - Menú **Mesh** > **Clean Up** > **Merge by Distance** => Limpiar vértices 
<!-- Pendiente de comprobar -->
## Pendiente de comprobar 
 * Pulsar `g` 2 veces
 * `Shift` + `-` 

## Bibliografía
 * **Curso gratis de Udemy** => https://www.udemy.com/course/blender-la-guia-completa-para-novatos
 * **Curso blender creación de personajes** => https://cursos.uadla.com/curso/curso-de-blender
 * **Primeros pasos** => https://www.youtube.com/watch?v=S-NH7ia_
 * **Guia para principiantes - Objetos Mario Bros** => https://www.youtube.com/watch?v=O-tV7uBf5LI
 * **Modificador Boolean** => https://www.youtube.com/watch?v=cwOg7Az_TBo
 * **Guía materiales y texturas** => https://www.youtube.com/watch?v=7SdhsCpNuYY
 * **Crear tubos con sus curvas** => https://www.youtube.com/watch?v=y-hD-Z3JlYs
 * **Listas de videos en canal sobre Blender** => https://www.youtube.com/@str3dlok/videos
 * **Como hacer hierba** => https://www.youtube.com/watch?v=TExXtmwiAUs
 * **Alinear y pegar objetos** => https://www.youtube.com/watch?v=nuP2fRHJ1i8
 * **Grosor a objetos y grabados** => https://www.youtube.com/watch?v=UqfIkGveNe4
 * **Formas de restar o hacer agujeros a objetos** => https://www.youtube.com/watch?v=7OdCT5D-Gz4
 * **Crear un espejo** => https://www.youtube.com/watch?v=ZQIk3MTExaU

### Enlaces de Blender España (Telegram)
En este enlace vamos guardando todo el material que consideremos oportuno relacionado con Blender. Ya hay algunas carpetas creadas pero esta abierto a ampliaciones y modificaciones: https://mega.nz/#F!Uo4CVIDK!fBQMm_2wzc6PDZQny8lieA
Enlaces de interés:
https://texturehaven.com/
https://hdrihaven.com/
https://3dmodelhaven.com/
En este TRELLO se van recopilando todos los vídeo-tutoriales que se consideran interesantes y actualizados. Muy recomendable que los que os iniciáis con Blender lo miréis. 
https://trello.com/b/Nzmp6jSh/grupo-telegram-blender-espa%C3%B1a
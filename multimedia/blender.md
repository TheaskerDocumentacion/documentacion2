# Blender

## Atajos de teclado
 * `F3` => Ayuda para encontrar acciones
 * `Q`(**Quick Favorites**) => Para guardar en favoritos
 * Crtl + space = Expande vista y oculta
 * Mover + `Shift` => más **precisión**
 * Mover + `Ctrl` => **snap** a otros objetos
 * `a`=> Seleccionar todos los objetos
 * `alt` + `a` => Deseleccionar todos los objetos


### Para movernos dentro de la vista
 * Botón rueda => para movernos 
 * Shift + Botón rueda => Panea
 * Los botones del teclado numérico:
   * `1` => Frontal
   * `3` => Lateral
   * `7` => Vista superior
   * `9` =>   Invertir la vista en la que estás
   * `2` y `8` => Girar verticalmente
   * `4` y `6` => Girar horizontalmente

### Punto de origen y cursor
 * `Crtl` + `.` => Se activa la modificación del punto de origen
 * Botón derecho sobre el objeto + `Set origin` + <elegir opción> => Mueve el centro origen del objeto donde queramos
 * `Shift` + `s` => Menú

#### Cambios de vista
 * **Seleccionamos objeto** + **View** > **Frame selected** => Nos centra la vista en el objeto seleccionado. También el `.` del teclado numérico
 * `/` (teclado numérico) => Nos centra en el objeto y oculta todo lo demás
 * `z`=> Sale el menú de vista

## Transformar objetos

### Herramienta mover objeto
   * `g` => Movimiento en todas direcciones
     * `g` + `x`=> Limita al eje x
     * `g` + `y`=> Limita al eje y
     * `g` + `z`=> Limita al eje z
     * `g` + rueda central => Limita a los ejes

### Herramienta de Rotar objeto
 * `r` => Movimiento en todas direcciones
   * `r` + `x`=> Limita al eje x
   * `r` + `y`=> Limita al eje y
   * `r` + `z`=> Limita al eje z
   * `r` + rueda central => Limita a los ejes

### Escalar objeto
 * `s` => Movimiento en todas direcciones
   * `s` + `x`=> Limita al eje x
   * `s` + `y`=> Limita al eje y
   * `s` + `z`=> Limita al eje z
   * `s` + rueda central => Limita a los ejes

### Cursor
 * `Shift` + click derecho => Mueve el cursor donde queramos
 * Para tener en cuenta el cursor para las transformaciones podemos ir al Menú **Transform Pivot Point** > **3D cursor**

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

Los objetos que creamos dentro del **Object mode** se añaden al objeto que tenemos seleccionado y es como uno solo.
 * `1` => Selección de vértice
 * `2` => Selección de arista
 * `3` => Selección de cara

 * **Seleccionar todas las aristas contiguas** => `Shift`+ `Alt` + `Click`

 * `a` => Selecciona todo
 * `e` => Extruir
 * `s` => Escalar
 * `i` => Insertar caras en la cara seleccionada (Inset)
 * `Ctrl` + `b` => Bevel

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

### Diferencias de objetos
 * Seleccionamos el objeto principal > **Modifier Properties** > **Boolean** > Seleccionar el objeto cotador
 * **Object Properties** > **Viewport Display** > **Display AS** > Elegir cómo queremos verlo

## Camara

 * `Ctrl` + `Alt` + `0` => Fija la cámara a la vista que hemos seleccionado


## Bibliografía
 * **Primeros pasos** => https://www.youtube.com/watch?v=S-NH7ia_
 * **Guia para principiantes - Objetos Mario Bros** => https://www.youtube.com/watch?v=O-tV7uBf5LI
 * **Modificador Boolean** => https://www.youtube.com/watch?v=cwOg7Az_TBo
 * **Guía materiales y texturas** => https://www.youtube.com/watch?v=7SdhsCpNuYY
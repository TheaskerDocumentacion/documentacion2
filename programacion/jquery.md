# Jquery

[TOC]

## Selectores avanzados

Los filtros de atributos son aquellos que refinan los resultados de un selector según los atributos que tenga el elemento.

Podemos filtrar por atributo de la siguiente manera:

1. `[nombreDeAtributo]`: Este incluye elementos que tengan el atributo especificado;
2. `[nombreDeAtributo=valor]`: incluye los elementos que tengan el atributo solicitado y el valor asignado al mismo;
3. `[nombreDeAtributo!=valor]`: incluye los elementos que tengan el atributo solicitado y un el valor asignado al mismo que sea distinto al especificado;
4. `[nombreDeAtributo^=valor]`: incluye los elementos que tengan el atributo solicitado y un el valor asignado al mismo empiece con el especificado;
5. `[nombreDeAtributo$=valor]`: incluye los elementos que tengan el atributo solicitado y un el valor asignado al mismo empiece con el especificado;
6. `[nombreDeAtributo*=valor]`: incluye los elementos que tengan el atributo solicitado y contenga el valor especificado;
7. `[nombreDeAtributo][nombreDeAtributoN]`: incluye los elementos que tengan los atributos solicitados.


```javascript
<script type="text/javascript">

    $("document").ready(function() {

      // seleccionar todos los párrafos que tengan el atributo class
      $('p[class]');

      // seleccionar todos los párrafos que tengan el atributo id con el valor paragraph1
      $('p[id=paragraph1]');

      // seleccionar todos los párrafos cuyo id empiece por "para"
      $('p[id^=para]');

      // seleccionar todos los párrafos cuyo id empiece por "para" y tenga un atributo llamado align que contenga "center"
      $('p[id^=para][align*=center]');

    });

</script>
```


##Filtros de Contenido

Éstos permiten examinar el contenido de elementos seleccionados para determinar si deben ser incluidos o no en los resultados.

`:contains(texto)`: Filtra la selección para incluir solo los que elementos que contengan el texto especificado;
`:empty` Filtra la selección para incluir solo elementos vacios;
`:has(selector)`: Retorna elementos que contienen al menos un elemento con el selector especificado;
`:parent:` Encuentra elementos que son padres, es decir, que confinen al menos otro elemento.

```javascript
// seleccionar todos los párrafos que contengan la palabra "Luigi"
$('p:contains(Luigi)');
Ahora si probáramos con $(':contains(a)');, estaríamos seleccionando todos los elementos que contengas una letra "a" sin importar de que tipo sean. Entonces nos retornaría: p, p, body, ¿Por qué body?, porque como los padres contienen a los hijos entonces su contenido es considerado como propio. Tendriamos que hacer una búsqueda un poco mas especifica si quisiéramos solo los
```

Sigamos:

```javascript
// Seleccionar todos los párrafos que contienen al menos un hijo (incluyendo texto)
$('p:parent');

// Seleccionar todos los ul que contengan li con la clase "a"
$('ul:has(li[class=a])');
```


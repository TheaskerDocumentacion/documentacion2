# Codeacademy JQuery

Insertaremos el código de jquery cuando la página HTML esté completamente cargada:

```javascript
$(document).ready(
    function(){
    
    };
);
```

Cuando pasamos el ratón por el elemento se oculta

```javascript
$(document).ready(function(){
    $('div').mouseenter().fadeTo('slow',1);
});
```


## Modificar elementos de HTML

### Agregar y eliminar elementos de HTML

#### Crear elementos de HTML

Creamos un elemento y lo asociamos a una varible. Como se refiere a un elemento jquery le ponemos el signo '$' para diferenciarlo de otras variables

```javascript
$h1 = $('<h1>Hola</h1>');
```

#### Insertar elementos

`.append()` insertá el elemento especificado como el último hijo del elemento al que apunta. `.prepend()` inserta el elemento especificado como el primer hijo del elemento al que apunta. Si tenemos un div con clase `.info`

```javascript
$('.info').append('<p>¡Algo!</p>');
$('.info').prepend('<p>¡Algo!</p>');
```

`.appendTo()` hace lo mismo que `.append()`, pero invierte el orden de "lo que hay que agregar" y "donde agregarlo". El código

```javascript
$('<p>¡Algo!</p>').appendTo('.info');
```

tiene el mismo efecto que el código `.append()` anterior. .`prependTo()` tiene una relación parecida con `.prepend()`.

#### Antes y después

Podemos especificar en qué parte del DOM insertamos un elemento con las funciones `.before()` y `.after()`.
Agregamos un párrafo después del `<div>`con `id='#uno'`


```javascript
$('#uno').after('<p>xxx</p>')
```

#### Mover elementos

Creamos un nuevo elemento <p> que insertamos después del <div> con `id='uno'`.

Posteriormente lo movemos después del <div> con `id='dos'`.

```javascript
$(document).ready(function(){
    $('#uno').after('<p>xxx</p>');
    $('#dos').after($('p'));
});
```

#### Eliminar elementos

`.empty()` elimina el contenido y todos los descendientes de un elemento. Por ejemplo, si usás `.empty()` en un `'ol'`, también eliminarás todos sus `'li'` y su texto.
```javascript
$('p').remove();
```

### Modificar clases y contenido

#### Agregar o eliminar clases

`.addClass()` y `.removeClass()`, que se pueden usar para agregar o eliminar una clase de un elemento.

```javascript
$('#texto').addClass('resaltar');
```

#### Activar y desactivar clases
#### Cambiar tu estilo
#### Modificar el contenido

### Dominar las manipulaciones

#### Preparación
#### ¡Hacé clic en el botón, ya!
#### Agregar un cuerpo
#### Eliminá lo seleccionado

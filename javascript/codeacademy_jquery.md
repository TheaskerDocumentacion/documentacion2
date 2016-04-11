# Codeacademy JQuery

[TOC]

### Mover elementos

Creamos un nuevo elemento <p> que insertamos después del <div> con `id='uno'`.

Posteriormente lo movemos después del <div> con `id='dos'`.

```javascript
$(document).ready(function(){
    $('#uno').after('<p>xxx</p>');
    $('#dos').after($('p'));
});
```

### Eliminar elementos

`.empty()` elimina el contenido y todos los descendientes de un elemento. Por ejemplo, si usás `.empty()` en un `'ol'`, también eliminarás todos sus `'li'` y su texto.
```javascript
$('p').remove();
```
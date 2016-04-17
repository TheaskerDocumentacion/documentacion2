# JQuery Codeschool

[http://try.jquery.com/](http://try.jquery.com/)

## Searching the DOM

 * **Selectores hijos**: Hijos `li` directos de #tours -> `$("#tours>li")`
 * **Selectores múltiples**: Hijos de id=tours con clase asia y sale ->`$("#tours .asia, .sale")`
 * **Selector descendiente**: Todos los `li' descendientes del id=tour -> `$("#tour li")
 * **Selector primero** (`:first`) Selecciona el primer `li` del id=tours -> `$("#tours li:first")`
 * **Pseudo selector `:even`**: Seleccionamos los `li`impares hijos del id=tours -> `$("#tours>li:even")`

## Traversing the DOM

 * **Buscando dentro de una selección**: Buscamos la clase `.america` dentro del `id=vacations` -> `$("#vacations").find(".america")' 
 * **Filtering by traversing**: Buscar el primer `li`del id=vacations-> `$("#vacations li").first();`
  * Buscar el último `li`del id=vacations -> `$("#vacations li").last()`
 * **`prev()`**: Buscar el 'li' del id=vacations antes del último -> `$("#vacations>li:last").prev()'
 * **`parent()`**: Buscar en id=tours el padre donde se encuentra la clase `.featured` -> `$("#tours .featured").parent();`
 * **`children()`**: Todos los hijos de id=tours -> `$("#tours").children();`

## Manipulating the DOM

 * **Creating a DOM Node**: Crea un mensaje antes de la clase `.book`

```javascript
var message = $('<span>mensaje</span>');
$('.book').before(message);
```
 * **Adding to the DOM I**: Crea el mensaje después de la clase `.usa' -> `$('.usa').append(message);`
 * **Removing From the DOM**: Elimino la clase book -> `$('.book').remove();`
 
## Acting on Interaction

 * **Click Interaction**: Creo el evento `click` sobre cualquier boton:

```javascript
$(document).ready(function(){
  $('button').on('click', function() {
    var message = $('<span>Call 1-555-jquery-air to book this tour</span>');
    $('.usa').append(message);
    $('button').remove();
  });
});
```

## Refactor Using Traversing

 * **Removing the Clicked Button**: Borro el botón que hacemos click -> '$(this).remove()' 
 * **Relative Traversing I**: Añadir justo después del botón que pulsamos -> `$(this).after(message);`
 * **Relative Traversing II**: **`closest()`**: Esta función solo nos seleccionara el primer elemento padre encontrado con el selector dado.
 
```html
<div id="tours">
  <h1>Guided Tours</h1>
  <ul>
    <li class="usa tour">
      <h2>New York, New York</h2>
      <span class="details">$1,899 for 7 nights</span>
      <div>
        <button class="book">Book Now</button>
      </div>
    </li>
  </ul>
```

```javascript
$(document).ready(function() {
  $('button').on('click', function() {
    var message = $('<span>Call 1-555-jquery-air to book this tour</span>');
    $(this).closest(message);
    $(this).remove();
  });
});
```
 
 * **Relative Traversing III**
 
## Traversing and Filtering

 * **Traversing and Filtering**
 * **Fetching Data From the DOM I**
 * **Fetching Data From the DOM II**
 * **Refactoring**
 * **Better On Handlers**
 * **New Filter I**
 * **New Filter II**
 * **New Filter III**
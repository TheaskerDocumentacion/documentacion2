# JQuery Codeschool

[http://try.jquery.com/](http://try.jquery.com/)

## Traversing the DOM

### Searching the DOM

 * **Selectores hijos**: Hijos `li` directos de #tours -> `$("#tours>li")`
 * **Selectores múltiples**: Hijos de id=tours con clase asia y sale ->`$("#tours .asia, .sale")`
 * **Selector descendiente**: Todos los `li' descendientes del id=tour -> `$("#tour li")
 * **Selector primero** (`:first`) Selecciona el primer `li` del id=tours -> `$("#tours li:first")`
 * **Pseudo selector `:even`**: Seleccionamos los `li`impares hijos del id=tours -> `$("#tours>li:even")`

### Traversing the DOM

 * **Buscando dentro de una selección**: Buscamos la clase `.america` dentro del `id=vacations` -> `$("#vacations").find(".america")' 
 * **Filtering by traversing**: Buscar el primer `li`del id=vacations-> `$("#vacations li").first();`
  * Buscar el último `li`del id=vacations -> `$("#vacations li").last()`
 * **`prev()`**: Buscar el 'li' del id=vacations antes del último -> `$("#vacations>li:last").prev()'
 * **`parent()`**: Buscar en id=tours el padre donde se encuentra la clase `.featured` -> `$("#tours .featured").parent();`
 * **`children()`**: Todos los hijos de id=tours -> `$("#tours").children();`

## Working with the DOM

### Manipulating the DOM

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

### Refactor Using Traversing

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

Al hacer click en el boton (this) buscamos el primer padre del botón que tenga como clase `.tour` y añadimos el span de mensaje. -> `$(this).closest('.tour').append(message);`

```javascript
$(document).ready(function() {
  $('button').on('click', function() {
    var message = $('<span>Call 1-555-jquery-air to book this tour</span>');
    $(this).closest('.tour').append(message);
    $(this).remove();
  });
});
```
 
 * **Relative Traversing III**: Permito que el click se haga en el tag `li` por lo que ya no necesito el `closest()`, pero tengo que buscar el boton para elminarlo.

```javascript
$(document).ready(function() {
  $('.tour').on('click', function() {
    var message = $('<span>Call 1-555-jquery-air to book this tour</span>');
    $(this).append(message);
    $(this).find('button').remove();
  });
});
```
 
### Traversing and Filtering

 * **Traversing and Filtering** - **`.data()`**: jQuery nos permite asociar cualquier tipo de datos a un elemento del DOM o colección de ellos, para reutilizarlos en cualquier punto de un script evitando agujeros de memoria.

La sintaxis es muy sencilla:

```
.data( key, value );
.data( obj );
```

```html
<div id="tours">
  <h1>Guided Tours</h1>
  <ul>
    <li class="usa tour" data-discount="299">
      <h2>New York, New York</h2>
      <span class="details">$1,899 for 7 nights</span>
      <button class="book">Book Now</button>
    </li>
    <li class="europe tour" data-discount="176">
      <h2>Paris, France</h2>
      <span class="details">$2,299 for 7 nights</span>
      <button class="book">Book Now</button>
    </li>
    <li class="asia tour" data-discount="349">
      <h2>Tokyo, Japan</h2>
      <span class="details">$3,799 for 7 nights</span>
      <button class="book">Book Now</button>
    </li>
  </ul>
</div>
````

Recuperamos el valor de los datos y los guardamos en la variable **discount**. Cuando pulsamos el botón buscamos el padre de este con `.closest()` (`li`) y con el método `.data()` recuperamos los datos nombrados como `discount`:

```javascript
$(document).ready(function() {
  $('button').on('click', function() {
    var message = $('<span>Call 1-555-jquery-air to book this tour</span>');
    var discount = $(this).closest('.tour').data('discount');
    $(this).closest('.tour').append(message);
    $(this).remove();
    
  });
});
```

 * **Better On Handlers**: Usando selectores como parámetros en `.on()`: `$('.tour').on('click','button', function() { ... }`
 * **New Filter II**: Buscamos todos las clases `.tour` y filtramos con `filter()` las que tienen la clase `.on-sale' y a esas le asignamos la clase '.highlight' para resaltarlas: `$('.tour').filter('.on-sale').addClass('highlight');' 
 * **New Filter III**: Pero antes de resaltar nada, tendremos que eliminar la clase por si estaba ya aplicada:

```javascript
$(document).ready(function() {
  $('#filters').on('click', '.on-sale', function() {
    $('.highlight').removeClass('highlight');
    $('.tour').filter('.on-sale').addClass('highlight');
  });

  $('#filters').on('click', '.featured', function() {
    $('.highlight').removeClass('highlight');
    $('.tour').filter('.featured').addClass('highlight');
  });
  
});
```

## Listening to DOM events

### On DOM Load

 * **On DOM Load**
 * **On Load I**
 * **On Load II**
 * **Slide Effect I**
 * **Slide Effect II**

### Expanding on on()

 * **Expanding on on()**
 * **Mouseover I**
 * **Mouseover II**
 * **Mouseleave**
 * **Named Functions**

### Keyboard Events

 * **Keyboard Events**
 * **Keyup Event**
 * **Keyup Event Handler I**
 * **Keyup Event Handler II**
 * **Another Event Handler**

### Link Layover

 * **Link Layover**
 * **Link Events I**
 * **Link Events II**
 * **Event Parameter I**
 * **Event Parameter II**
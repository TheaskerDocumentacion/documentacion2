# jQuery: The Return Flight

## Ajax Basics

### Ajax Basics

 * **Ajax with Response**: Hacemos una llamada ajax y cuando recibimos los datos correctamente (`success`) lo asignamos a la clase ` .photos` con el método `.fadeIn`. Su sintaxis es: `$.ajax(url[, settings])`
 

```javascript
$(document).ready(function() { 
  $('#tour').on('click', 'button', function() { 
    $.ajax('/photos.html',{
      success: function(response){
        $('.photos').html(response).fadeIn();
      }
    });
  });
});
```

 * **$.get Shorthand**: Reducimos el método `$.ajax()` con el método reducido `$.get()`. Su sintaxis es: `$.get(url, success)`

```javascript
$(document).ready(function() { 
  $('#tour').on('click', 'button', function() { 
    $.ajax('/photos.html',{
      success: function(response){
        $('.photos').html(response).fadeIn();
      }
    });
  });
});
```

 * **Ajax Data**: Usando la opción `data`de la función `$.ajax` le pasamos la opción `location`. Los datos de esta información los sacaremos del elemento `data-location` del elemento `#tour` usando el método `data`.

```javascript
$(document).ready(function() {
  $("#tour").on("click", "button", function() {
    var location = $('#tour').data('location');
    $.ajax('/photos.html', {
      success: function(response) {
        $('.photos').html(response).fadeIn();
      },
      data: {"location": location}
    });
  });
});
```

### Ajax Options

 * **Ajax Options**
 * **Ajax with Errors**
 * **Setting a Timeout**
 * **More Ajax Callbacks**
 * **Event Delegation**
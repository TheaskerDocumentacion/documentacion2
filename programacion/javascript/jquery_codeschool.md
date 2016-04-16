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

 * **3.3 Creating a DOM Node**: Crea un mensaje antes de la clase `.book`

```javascript
var message = $('<span>mensaje</span>');
$('.book').before(message);
```

 * **3.4 Adding to the DOM I**
 * **3.5 Adding to the DOM II**
 * **3.6 Removing From the DOM**
 
## Acting on Interaction

 * **3.7 Acting on Interaction**
 * **3.8 Click Interaction**
 * **3.9 Acting on Click**
 * **3.10 On Page Load**
 
## Refactor Using Traversing

 * **3.11 Refactor Using Traversing**
 * **3.12 Removing the Clicked Button**
 * **3.13 Relative Traversing I**
 * **3.14 Relative Traversing II**
 * **3.15 Relative Traversing III**
 
## Traversing and Filtering

 * **3.16 Traversing and Filtering**
 * **3.17 Fetching Data From the DOM I**
 * **3.18 Fetching Data From the DOM II**
 * **3.19 Refactoring**
 * **3.20 Better On Handlers**
 * **3.21 New Filter I**
 * **3.22 New Filter II**
 * **3.23 New Filter III**
# JQuery Codeschool

[http://try.jquery.com/](http://try.jquery.com/)

 * **Selectores hijos**: Hijos `li` directos de #tours -> `$("#tours>li")`
 * **Selectores múltiples**: Hijos de id=tours con clase asia y sale ->`$("#tours .asia, .sale")`
 * **Selector descendiente**: Todos los `li' descendientes del id=tour -> `$("#tour li")
 * **Selector primero** (`:first`) Selecciona el primer `li` del id=tours -> `$("#tours li:first")`
 * **Pseudo selector `:even`**: Seleccionamos los `li`impares hijos del id=tours -> `$("#tours>li:even")`
 * **Buscando dentro de una selección**: Buscamos la clase `.america` dentro del `id=vacations` -> `$("#vacations").find(".america")' 
 * **Filtering by traversing**: Buscar el primer `li`del id=vacations-> `$("#vacations li").first();`
  * Buscar el último `li`del id=vacations -> `$("#vacations li").last()`
 * 
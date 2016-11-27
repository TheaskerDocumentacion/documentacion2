# Curso de Symfony 3 de Victor Robles

## Hola Mundo con Symfony 3

En la ruta `/src/AppBundle/Controller/DefaultController.php` añadimos esta función:

```php
/**
 * @Route("/hello-world", name="helloWorld")
 */
public function helloWorldAction(){
  echo "<h1>Hola Mundo</h1>";
  die();
}
```
## Crear controladores, vistas y rutas básicas

En el directorio `/src/AppBundle/Controller` creamos un nuevo fichero llamado `PruebasController.php`:

```php
<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PruebasController extends Controller
{
    /**
     * @Route("/pruebas/index", name="pruebasIndex")
     */
    public function indexAction(Request $request){
      // replace this example code with whatever you need
      return $this->render('AppBundle:pruebas:index.html.twig', array(
          'texto' => "Te lo envío desde la acción del controlador"
      ));
    }    
}
```

Para crear la vista en nuestro **bundle**, creamos los directorios donde estará nuestra vista. Creamos `/src/AppBundle/Resources`, dentro de este  `views` y dentro `pruebas` con lo que quedará ``/src/AppBundle/Resources/views/pruebas`. Dentro de este crearemos el fichero `index.html.twig`

```
{{texto}}
```

Las **rutas básicas** se pueden hacer en los comentarios del **phpdoc**, pero es mejor hacerlas en un fichero config que lo crearemos en la ruta `/src/AppBundle/Resources/config` y se llamará `routing.yml`:

```yaml

```
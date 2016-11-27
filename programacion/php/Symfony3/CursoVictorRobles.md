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
pruebas_index:
  path: /pruebas/index
  defaults: {_controller: AppBundle:Pruebas:index}
```

Además tendremos que añadir un enlace a este fichero de rutas en el fichero global de enrutado que está en `/app/config/routing.yml`, enlazando nuestro fichero de rutas:

```yml
rutas_bundle:
  resource: "@AppBundle/Resources/config/routing.yml"
  prefix: /

...
```

y con esto ya podremos quitar la ruta del comentario:

```
...
/**
 * @Route("/pruebas/index", name="pruebasIndex")
 */
...
```

## Rutas avanzadas

### Parámetros en el enrutado


Fichero de rutas donde pasamos configuramos los parámetros`/src/AppBundle/Resources/config/routing.yml`
```yaml
pruebas_index:
  path: /pruebas/{name}/{surname}
  defaults: {_controller: AppBundle:Pruebas:index}
```

Acción del controlador lo modificamos para que visualice los parámetros pasados por la url
`/src/AppBundle/Controller/PruebasController.php`
```php
...
public function indexAction(Request $request,$name,$surname){
  // replace this example code with whatever you need
  return $this->render('AppBundle:pruebas:index.html.twig', array(
      'texto' => $name." - ".$surname
  ));
}
...
```

Y en la url pondremos algo así: `http://localhost:8000/pruebas/parametro1/parametro2`, y nos mostrará en pantalla:

	parametro1 - parametro2

Si queremos que alguno de los parámetros sea opcional modificaremos el fichero de rutas de nuestro controlador:

```yaml
pruebas_index:
  path: /pruebas/{name}/{surname}
  defaults: {_controller: AppBundle:Pruebas:index, surname:Segura}
```

url = `http://localhost:8000/pruebas/parametro1`
resultado = parametro1 - Segura

También podemos poner requerimientos con expresiones regulares:
```yaml
pruebas_index:
  path: /pruebas/{lang}/{name}/{page}
  # name y page opcionales y asignación de valor por defecto
  defaults: {_controller: AppBundle:Pruebas:index, name:nombre_defecto, page:1}
  methods: [GET]
  requirements:
    # una o varias letras con expresiones regulares
    name: "[a-zA-Z]*"
    # uno o varios números enteros
    page: \d+
    # uno de estos valores
    lang: es|es|fr
```

## Redirecciones

Redirección con una ruta ya creada:

```php
public function indexAction(Request $request,$name,$page,$lang){
  return $this->redirect($this->generateUrl("helloWorld"));
  // replace this example code with whatever you need
  return $this->render('AppBundle:pruebas:index.html.twig', array(
      'texto' => $name." - ".$page." // Idioma elegido: ".$lang
  ));
}
```

Redirección a una ruta directa:
```php
return $this->redirect($request->getBaseUrl()."/hello-world?hola=true");
```

## Recoger variables GET y POST

Añadimos en el fichero de rutas los métodos por los que voy a recibir información (GET y/o POST)
`/src/AppBundle/Resources/config/routing.yml`
```yaml
pruebas_index:
  path: /pruebas/{lang}/{name}/{page}
  # name y page opcionales y asignación de valor por defecto
  defaults: {_controller: AppBundle:Pruebas:index, name:nombre_defecto, page:1}
  methods: [GET,POST]
  requirements:
    # una o varias letras con expresiones regulares
    name: "[a-zA-Z]*"
    # uno o varios números enteros
    page: \d+
    # uno de estos valores
    lang: es|en|fr
```

En nuestro controlador recibimos las variables y las mostramos con **var_dump()**:

`/src/AppBundle/Controller/PruebasController.php`
```php
public function indexAction(Request $request,$name,$page,$lang){
    //return $this->redirect($request->getBaseUrl()."/hello-world?hola=true");
    var_dump($request->query->get("hola"));
    var_dump($request->get('hola-post'));
    die();
    // replace this example code with whatever you need
    return $this->render('AppBundle:pruebas:index.html.twig', array(
        'texto' => $name." - ".$page." // Idioma elegido: ".$lang
    ));
  }
```

## Creación de Bundles

Con el comando de la consola de Symfony:

	php bin/console generate:bundle --namespace=MiBundle --format=yml

Si queremos que Symfony no cargue un bundle que tenemos pero sin eliminarlo, tenemos que comentar la línea que hay en el fichero `/app/AppKernel.php` en el array de bundles

## Plantillas y bloques

Para crear plantillas de forma global, las podemos definir en el directorio `/app/Resources/views`. Allí tenemos ya una plantilla creada por defecto llamada `base.html.twig`.

El sistema de plantillas de twig funciona con bloques del estilo a:

```twig
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}{% endblock %}
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    </head>
    <body>
        {% block body %}{% endblock %}
        {% block javascripts %}{% endblock %}
    </body>
</html>
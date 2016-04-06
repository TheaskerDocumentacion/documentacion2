# Novedades en ES6

## Variables let

**let** permite declarar variables limitando su alcance (scope) al bloque, declaración, o expresión donde se está usando. Lo anterior diferencia  la expresión let de la palabra reservada **var** , la cual define una variable global o local en una función sin importar el ámbito del bloque.

```javascript
(function() {
    let x = 'Hola Dani';
    
    if(true) {
        let x = 'Hola Joan';
    }
    console.log(x);  // Imprime en consola Hola Dani
})();
```

## Constantes

Declaración de una constante de solo lectura.

```javascript
(function() {
    const HELLO = 'hello world';
    HELLO = 'hola mundo';
    // Dará ERROR, ya que es de sólo lectura
})();
```
```javascript
(function() {
    const PI;
    PI = 3.15;
    // Dará ERROR, ya que ha de asignarse un valor en la declaración
})();
```


## Enlaces

[http://slides.com/joanleon/ecmascript-2015](http://slides.com/joanleon/ecmascript-2015)
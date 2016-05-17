# Programación avanzada de aplicaciones para dispositivos móviles en HTML5 para dispositivos móviles en HTML5 con Javascrip y CSS3

 * **Profesor**: Julio Sánchez (PUE).
 * **Encargado del CTA**: pedro@aragon.es

csharp

password máquina virtual -> "cangetin"

## Sublime Text 2.

### Plugins
 * **SublimeLinter**: Y en las opciones del plugin cambiamos el valor de: ```"sublimelinter": "true",```
 * **emmet**
 * **html5 bundle**

Pero necesitaremos algunos módulos:
```bash
sudo apt-get install nodejs npm
sudo apt-get install nodejs.legacy
sudo npm install -g csslint
sudo npm install -g jshint
```

## html

### viweport

Le preguntamos al dispositivo en el que se visualiza su anchura y le decimos que ocupe toda su anchura
```html
<meta name"viewport" content="width=device-width initial-scale=1.0">
```

Gracias a esto podremos trabajar con porcentajes para conseguir un comportamiento responsivo


## CSS

```css
* {
	margin: 0%;
	padding: 0%;
}
```

http://caniuse.com/ --> para saber si segun que cosas se van a poder usar o no

 * **display**: podemos hacer que los elementos en vez de que vayan unos debajo de otros, este comportamiento cambie.

	display: inline-block;
 
  * **clear**: resetea los float.
 
 
 ## mediaquery
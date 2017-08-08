# Angular4

## Instalación de Angular4 con Angular CLI

Instalamos angular-cli:

`npm install angular-cli`

Creamos el proyecto con angular-cli

`ng new nuevo-proyecto-angular`

### Actualización de angular-cli

```bash
npm uninstall -g @angular/cli
npm cache clean
npm install -g @angular/cli@lastest
```

Proyecto local

```bash
rm -r node_modules dist
npm install --save-dev @angular/cli@lastest
npm install
```

## Componente

`fruta.component.ts`
```javascript
import { Component, OnInit } from '@angular/core';

@Component({
    selector: 'app-fruta',
    templateUrl: 'fruta.component.html',
    styleUrls: ['fruta.component.css']
})

export class ConfiguracionComponent {
    public nombre: string;
    public edad: number;
    public mayorDeEdad: boolean;
    public trabajos: Array<string>;
    public trabajos: Array<any>;

    contructor(){
        public nombre: string = "Componente Fruta";
        public edad: number = 66;
        public mayorDeEdad: boolean = ture;
        public trabajos: Array<string> = ['Carpintero', 'Albañil', 'Fontanero'];
        public trabajos: Array<any> = ['Carpintero', 45, 'Fontanero'];
    }
}
```

`fruta.component.html`
```html
<h1>Titulo componente fruta</h1>
<p>{{nombre}}</p>
<p>{{edad}}</p>
<p>{{mayorDeEdad}}</p>
<p>{{trabajos}}</p>
```

`app.module.ts`
```javascript
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

import { AppComponent } from './app.component';
import { FrutaComponent } from './fruta/fruta.component';

@NgModule({
  declarations: [ AppComponent, FrutaComponent],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
```
`app.component.html`
```html
<h1>{{title}}</h1>
<app-fruta>
```

## Enlaces

 * [http://www.formacionwebonline.com/introduccion-angular-2-primera-aplicacion/](http://www.formacionwebonline.com/introduccion-angular-2-primera-aplicacion/)
 
 * [http://angularmexico.com/blog/intro-angular2/](http://angularmexico.com/blog/intro-angular2/)


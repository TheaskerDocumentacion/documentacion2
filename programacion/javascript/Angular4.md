# Angular4

<!-- TOC -->

- [Angular4](#angular4)
    - [Instalación de Angular4 con Angular CLI](#instalación-de-angular4-con-angular-cli)
        - [Actualización de angular-cli](#actualización-de-angular-cli)
    - [Componente](#componente)
        - [ngOninit](#ngoninit)
    - [Modelo de datos](#modelo-de-datos)
    - [Directivas](#directivas)
        - [ngIf](#ngif)
        - [ngFor](#ngfor)
        - [Directivas de atributo `ngSwitch` / `ngStyle`](#directivas-de-atributo-ngswitch--ngstyle)
        - [Directiva de atributo `ngStyle`](#directiva-de-atributo-ngstyle)
        - [Directiva de atributo `ngClass`](#directiva-de-atributo-ngclass)
        - [Directivas de evento](#directivas-de-evento)
            - [Two way data-binding](#two-way-data-binding)
            - [(click)](#click)
    - [Routing](#routing)
        - [Paso de parámetros por la url en las rutas](#paso-de-parámetros-por-la-url-en-las-rutas)
        - [Redirecciones de rutas](#redirecciones-de-rutas)
    - [Servicios](#servicios)
    - [Pipes](#pipes)
        - [Custom Pipes](#custom-pipes)
    - [Formularios y validaciones](#formularios-y-validaciones)
    - [Servicios con peticiones HTTP](#servicios-con-peticiones-http)
    - [Enlaces](#enlaces)

<!-- /TOC -->

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
    selector: 'app-persona',
    templateUrl: 'persona.component.html',
    styleUrls: ['persona.component.css']
})

export class PersonaComponent implements OnInit{
    

    contructor(
        public nombre: string,
        public edad: number,
        public mayorDeEdad: boolean,
        public trabajos: Array<string>,
        public trabajos: Array<any>
    ){
        this.nombre: string = "Componente Fruta";
        this.edad: number = 66;
        this.mayorDeEdad: boolean = ture;
        this.trabajos = ['Carpintero', 'Albañil', 'Fontanero'];
        this.trabajos: Array<any> = ['Carpintero', 45, 'Fontanero'];
    }

    ngOninit(){
        this.actualizarDatos("Mauricio", 44);
    }

    actualizarDatos(let nombre: string, let edad: number){
        this.nombre = nombre;
        this.edad = edad;
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
import { PersonaComponent } from './fruta/fruta.component';

@NgModule({
  declarations: [ AppComponent, PersonaComponent],
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
<app-persona>
```

### ngOninit

Este es el primer método que se ejecuta en un componente. Se usa para llamar a métodos que queremos que se ejecuten al comienzo de la llamada a la clase.

```javascript
import { Component, OnInit } from '@angular/core';

...

export class PersonaComponent implements OnInit{
    ngOninit(){
        this.actualizarDatos("Mauricio", 44);
    }

    actualizarDatos(let nombre: string, let edad: number){
        this.nombre = nombre;
        this.edad = edad;
    }
}
```

## Modelo de datos

`empleado.ts`
```javascript
export class Empleado{
    constructor(
        public nombre: string,
        public edad: number,
        public cargo: string,
        public contratado: boolean
    ){}
}
```

`empleado.component.ts`
```javascript
import { Component, OnInit } from '@angular/core';
import { Empleado } from './empleado';

@Component({
    selector: 'app-empleado',
    template: '<p>{{empleado.nombre}}</p>'
})

export class EmpleadoComponent{
    public empleado: Empleado;
    public trabajadores: Array<Empleado>;

    constructor(){
        this.empleado = new Empleado('Mauricio', 44, 'cocinero', true);
        this.trabajadores = [
            new Empleado('Mauricio', 44, 'cocinero', true),
            new Empleado('Sergio', 43, 'soldado', true)
            new Empleado('Eva', 37, 'restauradora', true);
            new Empleado('Gema', 34, 'ayudante de cámara', true);
        ];
    }
}
```

## Directivas

Son funcionalidades para las vistas insertadas en el html.

### ngIf

```html
<ul *ngIf="trabajador-externo === true">
    ...
    <li *ngIf="trabajadores[0].contratado == true">Está contratado</li>
    <li *ngIf="trabajadores[0].contratado == false">No está contratado</li>
</ul>
```

### ngFor

Con esta directiva podemos iterar cualquier array. Con `index` sabremos el número de índice, muy util para poder eliminar elementos.

```html
<ul>
    <li *ngFor="let empleado of trabajadores; let i = index">
        <strong>Empleado {{i+1}}</strong>
        <ul>
            <li>{{empleado.nombre}}</li>
            <li>{{empleado.edad}}</li>
            <li>{{empleado.cargo}}</li>
            <li *ngIf="empleado.contratado == true">Está contratado</li>
            <li *ngIf="empleado.contratado == false">NO Está contratado</li>
        </ul>
    </li>
</ul>
```

### Directivas de atributo `ngSwitch` / `ngStyle`

```html
<h3>Colores switch</h3>
<ul [ngSwitch]="color">
    <li *ngSwitchCase="'red'" [ngStyle]="{
        'background': color, 
        'color': 'white',
        'padding': '10px'
        }">Es de color ROJO</li>
    <li *ngSwitchCase="'green'" [ngStyle]="{
        'background': color, 
        'color': 'white',
        'padding': '10px'
        }">Es de color VERDE</li>
    <li *ngSwitchCase="'blue'" [ngStyle]="{
        'background': color, 
        'color': 'white',
        'padding': '10px'
        }">Es de color AZUL</li>
</ul>
```

### Directiva de atributo `ngStyle`

Con la condición ternaria comprobamos que el color seleccionado en el input es 'red' y entonces modificamos el estilo `border`.

```html
<pre 
    [style.border] = "colorSeleccionado == 'red' ? '5px solid black' : '1px solid blue'">
    <strong>Color elegido: </strong>{{colorSeleccionado}}
</pre>
```

### Directiva de atributo `ngClass`

```css
.fondoAzul { border: 5px solid ligthblue;}
.fondoVerde { border: 5px solid ligthgreen;}
.letraGrande { font-size: 30px; }
```
```html
<pre 
    [ngClass] = "{
        fondoAzul: colorSeleccionado == 'blue',
        fondoVerde: colorSeleccionado == 'green',
    }"
    <strong>Color elegido: </strong>{{colorSeleccionado}}
</pre>
```

También podemos hacer que se asignen cases por defecto fijas, pasándole un array de clases.
```html
<pre [ngClass] = "[fondoAzul','letra']"> </pre>
```

### Directivas de evento

#### Two way data-binding

`app.module.ts`
```javascript
import { FormsModule } from '@angular/forms';
...
@NgModule({
    imports: [
        FormsModule
    ]
})
```
```html
<h3>Selector de colores (two way data binding)</h3>
<input type="text" [(ngModel)]="colorSeleccionado" />
<pre><strong>Color elegido: </strong>{{colorSeleccionado}}</pre>
<div [ngStyle]="{
    'background': colorSeleccionado,
    'width': '200px',
    'height': '200px',
    'float': 'right',
    'margin-right': '69%'
    }"></div>
<div style="clear: both"></div>
```

#### (click)

Llamamos a un método cuando el evento click es llamado.
```html
<button (click)="metodo()"></button>
```

## Routing

Tenemos que tener la etiqueta `<base href="/">`en el body del `index.html`.

Creamos el fichero `app.routing.ts`:
```javascript
import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

// Importar componentes
import { EmpleadoComponent } from './empleado/empleado.component';
import { FrutaComponent } from './fruta/fruta.component';
import { HomeComponent } from './home/home.component';
import { ContactoComponent } from './contacto/contacto.component';

const appRoutes: Routes = [
    {path: '', component: HomeComponent},
    {path: 'empleado', component: EmpleadoComponent},
    {path: 'fruta', component: FrutaComponent},
    {path: 'home', component: HomeComponent},
    {path: 'contacto', component: ContactoComponent},
    {path: 'contacto/:page', component: ContactoComponent},
    {path: '**', component: HomeComponent}
];

export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);
```

Y en `app.module.ts`
```javascript
...
import { routing, appRoutingProviders } from './app.routing';
...
@NgModule({
    ...
    imports: [
    ...
    routing
    ],
    providers: [appRoutingProviders],
    bootstrap: [AppComponent]
})
```

En la vista tendremos que usar la directiva **`<router-outlet></router-outlet>`** que carga dentro de esta etiqueta el componente correspondiente a la ruta actual que estoy eligiendo. Con esta directiva podemos crear un menu de navegación.
```html
<nav>
    <a [routerLink]="[ '/home' ]" routerLinkActive="activado"> Home </a> - 
    <a [routerLink]="[ '/fruta' ]" routerLinkActive="activado"> Fruta </a> - 
    <a [routerLink]="[ '/empleado' ]" routerLinkActive="activado"> Empleado </a> - 
    <a [routerLink]="[ '/contacto' ]" routerLinkActive="activado"> Contacto </a>
</nav>

<hr/>
<router-outlet></router-outlet>
```
```css
.activado { font-weight: bold; background: yellow; }
```

Con el atributo `routerLiknActive` le decimos la clase o clases de css que queremos que asigne cuando estamos en la opción del menú activo, pasandole un array de strings de nombres de clases.

### Paso de parámetros por la url en las rutas

En el fichero `app.routing..ts` definimos la ruta con el parámetro:

```javascript
...
const appRoutes: Routes = [
    ...
    {path: 'contacto/:page', component: ContactoComponent},    
];

export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);
```

Luego en el componente correspondiente, `contacto.component.ts` recogemos el parámetro pasado en la url:
```javascript
import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';

@Component({
    selector: 'contacto',
    templateUrl: './contacto.component.html'
})

export class ContactoComponent implements OnInit{
    public parametro;

    constructor(
        private _route: ActivatedRoute,
        private _router: Router
    ){}

    ngOnInit(){
        
        this._route.params.forEach((params: Params )=>{
            console.log('this._route.params: ', this._route.params);
            console.log(params);
            this.parametro = params['page'];
        })
    }
}
```



### Redirecciones de rutas

```javascript
    redirigir(){
        this._router.navigate(['/contacto','parametro2']);
    }

    redirigirHome(){
        this._router.navigate(['/home']);
    }
```

## Servicios

Sirven para tener acceso a los datos desde cualquier componente y nos facilitan la reutilización de código.

Creo el fichero del serivcio en `services/ropa.service.ts`:
```javascript
import { Injectable } from '@angular/core';

@Injectable()
export class RopaService {
    private nombre_prenda: string;

    constructor(){
        this.nombre_prenda = 'Pantalón vaquero';
    }

    prueba(nombre_prenda) {
        this.nombre_prenda = nombre_prenda;
        return this.nombre_prenda;
    }
}
```

Y para usarlo en un componente:
```javascript
import { Component, OnInit } from '@angular/core';
import { RopaService } from '../services/ropa.service';

@Component({
    selector: 'home',
    templateUrl: './home.component.html',
    providers: [RopaService]
})

export class HomeComponent implements OnInit{
    public titulo = 'Página principal';

    constructor(
        private _ropaService: RopaService
    ) {}

    ngOnInit() {
        console.log('this._ropaService.prueba(): ', this._ropaService.prueba('prenda'));
    }
}
```

## Pipes

Tuberías o filtros que nos proveen de pequeñas funcionalidades en las vistas, como transformar fechas, convertir un string a mayúsculas o minúsculas, etc.

**Fechas:**
```html
<p>{{fecha| date: 'dd/MM/yyyy'}}</p>
<p>{{fecha| date: 'fullDate'}}</p>
```

**Manipulación de strings:**
```html
<p>{{fecha| date: 'fullDate' | uppercase | lowercase}}</p>
```

### Custom Pipes

Primero creamos la "Pipe":

`conversor.pipe.ts`
```javascript
import { Pipe, PipeTransform} from '@angular/core';

@Pipe({ name: 'conversor' })
export class ConversorPipe implements PipeTransform {
    transform(value: string, por: string): string {
        let value_one = parseInt(value);
        let value_two = parseInt(por);
        let result = `La multiplicación: ${value_one}x${value_one} = ${value_one*value_two}`;

        return result;
    }
}
```

Luego, para poder usarla en toda la aplicación la tenemos que de importar en `app.module.ts`
```javascript
...
import { ConversorPipe } from './pipes/conversor.pipe';

@NgModule({
  declarations: [
    ...
    ConversorPipe
  ],
  ...
})
export class AppModule { }
```

Ahora ya podemos usar la pipe 'conversor'
```html
<p>{{5 | conversor: 7}}</p>
```

## Formularios y validaciones

Para crear formularios, deberían estar ligados a un modelo de datos:
`coche.ts`
```javascript
export class Coche {
    constructor(
        public nombre: string,
        public caballaje: string,
        public color: string
    ) {}
}
```

`coche.component.ts`
```javascript
import { Component, OnInit } from '@angular/core';
import { Coche } from './coche';

@Component({
    selector: 'app-coches',
    templateUrl: './coches.component.html'
})

export class CochesComponent{
    public coche: Coche;
    public coches: Array<Coche>;

    constructor(){
        this.coche = new Coche('', '', '');
        this.coches = [
            new Coche('Seat Panda', '120', 'Banco'),
            new Coche('Renault clio', '110', 'Azul')
        ];
    }

    onSubmit(){
        console.log('this.coche: ', this.coche);
        this.coches.push(this.coche);
        this.coche = new Coche('', '', '');
    }
}
```

`coche.component.html`
```html
<h1>Componente de coches</h1>
<style>
    div {float: left;}
    form{ width: 200px; margin-right: 30px;}
    input[type="text"], span {
        display: block;
        width: 100%;
    }
    
</style>
<div style="float: left">
    <form #formCoche="ngForm" (ngSubmit)="onSubmit()">
        <p>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" #nombre="ngModel" [(ngModel)]="coche.nombre" required>
            <span *ngIf="nombre.touched && !nombre.valid">
                El nombre del coche es inválido
            </span>
        </p>
        <p>
            <label for="caballaje">Caballaje: </label>
            <input type="text" name="caballaje" #caballaje="ngModel" [(ngModel)]="coche.caballaje" required pattern="[0-9]+">
            <span *ngIf="caballaje.touched && !caballaje.valid">
                El caballaje no es válido
            </span>
        </p>
        <p>
            <label for="color">Color: </label>
            <input type="text" name="color" #color="ngModel" [(ngModel)]="coche.color" required pattern="[a-zA-Z#]+">
            <span *ngIf="color.touched && !color.valid">
                El color no es válido
            </span>
        </p>

        <input type="submit" value="guardar" [disabled]="!formCoche.form.valid">
    </form>
</div>
<div>
    <h4>Listado de coches</h4>
    <ul>
        <li *ngFor="let coche of coches">
            {{coche.nombre}} - {{coche.caballaje}} - {{coche.color}} 
        </li>
    </ul>
</div>
```

## Servicios con peticiones HTTP

Creamos un servicio para usar las peticiones http por ajax:

`peticiones.service.ts`
```javascript
import { Injectable } from '@angular/core';
import { Http, Response, Headers } from '@angular/http';
import 'rxjs/add/operator/map';
import { Observable } from 'rxjs/Observable';

@Injectable()
export class PeticionesService {
    public url: string;

    constructor(
        private _http: Http
    ) {
        this.url = 'https://jsonplaceholder.typicode.com/posts';
    }

    getArticulos(){
        return this._http.get(this.url).map(res => res.json());
    }
}
```

Luego en el componente importamos el servicio y lo inyectamos desde el constructor para poder usarlo:
```javascript
import { Component, OnInit } from '@angular/core';
import { PeticionesService } from '../services/peticiones.service';

@Component({
    ...
    providers: [PeticionesService]
})

export class CochesComponent implements OnInit{
    public articulos: Array<any>;

    constructor(
        private _peticionesService: PeticionesService
    ){}

    ngOnInit(){
        this._peticionesService.getArticulos().subscribe(
            result => {
                this.articulos = result;
                if(!this.articulos){
                    console.log('Error en en servidor o no hay registros.');
                }
            },
            error => {
                var errorMessage = <any>error;
                console.log('errorMessage: ', errorMessage);
            }
        )
    }
}
```



## Enlaces

 * [http://www.formacionwebonline.com/introduccion-angular-2-primera-aplicacion/](http://www.formacionwebonline.com/introduccion-angular-2-primera-aplicacion/)
 
 * [http://angularmexico.com/blog/intro-angular2/](http://angularmexico.com/blog/intro-angular2/)


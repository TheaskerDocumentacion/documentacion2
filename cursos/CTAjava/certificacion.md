# Certificación Java

## Construyendo bloques de Java

### Paquetes

  * En el exámen no pondrán nombres de paquetes no válidos.

## Tipos primitivos en Java

Keyword 	Type 							Example 
----------	---------						---------
boolean 	true or false 					true 
byte 		8-bit integral value 			123 
short 		16-bit integral value 			123 
int 		32-bit integral value 			123 
long 		64-bit integral value 			123 
float 		32-bit floating-point value 	123.45f 
double 		64-bit floating-point value 	123.456 
char 		16-bit Unicode value 			'a'

Un float requiere la letra `f` siguiendo al número para que Java sepa que es un float. 

## Referencia de tipos

Podemos asignar la referencia de 2 modos:

  * Una referencia puede ser asignada a otro objeto del mismo tipo.
  * Una referencia puede ser asignada a un nuevo objeto usando la palabras `new`

En la referencia de tipos, podemos asignar `null`, pero a un primitivo si le asignamos null, no compila.

## Operadores Java

### Operadores aritméticos

Operator 							Symbols and examples 
--------------------				--------------------------
Post-unary operators 				expression++, expression-- 
Pre-unary operators 				++expression, --expression
Other unary operators 				+, -, ! 
Multiplication/Division/Modulus 	*, /, % 
Addition/Subtraction 				+, - 
Shift operators 					<<, >>, >>> 
Relational operators 				<, >, <=, >=, instanceof 
Equal to/not equal to 				==, != 
Logical operators 					&, ^, | 
Short-circuit logical operators 	&&, || 
Ternary operators 					boolean expression ? expression1 : expression2 
Assignment operators 				=, +=, -=, *=, /=, %=, &=, ^=, !=, <<=, >>=, >>>=

Todos los operadores aritméticos pueden aplicarse a cualquier primitiva Java, excepto boolean y String. Además, sólo los operadores de adición + y + = pueden aplicarse a los valores de String, lo que da como resultado la concatenación de String.

### Promoción numérica



Reglas Numéricas de Promoción

  1. Si dos valores tienen diferentes tipos de datos, Java automáticamente promoverá uno de los valores al mayor de los dos tipos de datos.
  2. Si uno de los valores es entero y el otro es de punto flotante, Java promoverá automáticamente el valor entero al tipo de datos del valor de punto flotante.
  3. Los tipos de datos más pequeños, a saber byte, short y char, se promueven primero a int siempre que se usen con un operador aritmético binario de Java, incluso si ninguno de los operandos es int.
  4. Después de que se haya producido toda promoción y los operandos tengan el mismo tipo de datos, el valor resultante tendrá el mismo tipo de datos que sus operandos promocionados.

### Trabajando con Operadores Unitarios

Unary operator 	Description 
--------------	-------------------------------------------------------------------------
+ 				Indicates a number is positive, although numbers are assumed 
 				to be positive in Java unless accompanied by a negative unary operator 
- 				Indicates a literal number is negative or negates an expression 
++ 				Increments a value by 1 
-- 				Decrements a value by 1 
! 				Inverts a Boolean’s logical value

### Utilizando operador binario adicional

#### Componiendo Operadores de Asignación

```java
long x = 10;
int y = 5;
y = y * x; // No compila -> Castea primero y a long y lo multiplica por x, 
							luego intenta meter el resultado long a y que es int
y *= x; // Compila -> Castea x a long, hace la multiplicación de 2 valores long y luego castea el resultado a int.

```

#### Operadores relacionales

< 		Strictly less than 
<= 		Less than or equal to 
> 		Strictly greater than 
>= 		Greater than or equal to

Relational instanceof operator 
-----------------------------------
a instanceof b 		True if the reference that a points to is an instance of 
					a class, subclass, or class that implements a Particular 
					interface, as named in b

### Operadores lógicos

El operador lógico AND
x		y		resultado
true	true	true
true	false	false
false	true	false
false	false	false

El operador lógico OR
x		y	resultado
true	true	true
true	false	true
false	true	true
false	false	false

El operador lógico NOT
x		resultado
true	false
false	true

El operador exclusivo OR
x		y		resultado
true	true	false
true	false	true
false	true	true
false	false	false

Para recordar esta tabla:
  * AND es sólo TRUE si ambos operandos son TRUE.
  * OR es sólo FLASE si ambos operandos son FALSE.
  * OR EXCLUSIVO es sólo TRUE si los operandos son diferentes.

Los operadores lógicos && y || se usan como "corto circuito". Los operadores de cortocircuito son casi idénticos a los operadores lógicos, & y |, respectivamente, excepto que el lado derecho de la expresión nunca puede ser evaluado si el resultado final puede ser determinado por el lado izquierdo de la expresion.

### Operadores de Igualdad

Los operadores de igualdad se utilizan en uno de tres escenarios:
  1. Cuando comparamos dos tipos primitivos, si son de tipos diferentes el de menor tipo se "promociona" al de mayor. 5 == 5.00 es true ya que 5 promociona de 'double'.
  2. Comparando 2 valores booleanos.
  3. Comparando 2 objetos, incluyendo null y String.

Las comparaciones por igualdad se limitan a estos tres casos, por lo que no se puede mezclar y
Tipos de concordancia. Por ejemplo, cada uno de los siguientes resultaría en un error de compilador:
```java
boolean x = true == 3; // DOES NOT COMPILE
boolean y = false != "Giraffe"; // DOES NOT COMPILE
boolean z = 3 == "Kangaroo"; // DOES NOT COMPILE
```

Para la comparación de objetos, el operador de igualdad se aplica a las referencias a los objetos,
No los objetos a los que apuntan. Dos referencias son iguales si y sólo si apuntan a la misma
Objeto o ambos apuntan a null. 

## Entendiendo las declaraciones de Java

Un bloque de código en Java es un grupo de cero o más sentencias encerradas entre llaves, ({}), y se puede utilizar en cualquier lugar en una sola sentencia es permitido.

## switch

Data types supported by switch statements include the following:
  * int and Integer
  * byte and Byte
  * short and Short
  * char and Character
  * int and Integer
  * String
  * enum values

### Valores constantes en tiempo de compilación

Los valores en cada sentencia `case`de ser constantes en tiempo de compilación. Esto significa que sólo puedes usar literales, contantes enum, o constantes finales del mismo tipo de dato. `Constante final` quiere decir que debe ser marcada con el modificador `final` e inicializada con un valor literal en la misma expresión declarada.

```java
private int getSortOrder(String firstName, final String lastName) {
    String middleName = "Patricia";
    final String suffix = "JR";
    int id = 0;
    switch (firstName) {
        case "Test":
            return 52;
        case middleName: // DOES NOT COMPILE
            id = 5;
            break;
        case suffix:
            id = 0;
            break;
        case lastName: // DOES NOT COMPILE
            id = 8;
            break;
        case 5: // DOES NOT COMPILE
            id = 7;
            break;
        case 'J': // DOES NOT COMPILE
            id = 10;
            break;
        case java.time.DayOfWeek.SUNDAY: // DOES NOT COMPILE
            id = 15;
            break;
    }
    return id;
}
```

### for-each

El tipo de dato de la parte derecha del for-each tiene que implementar la clase `java.lan.Iterable` para este exámen sólo List y ArrayList

## Entendiendo el control de flujo avanzado

### Nested Loops

```java
System.out.println();
OUTER_LOOP: for (int[] item : myComplexArray){
    INNER_LOOP: for (int elem : item){
        System.out.print(elem + "\t");
    }
    System.out.println();
}
```
Si bien este tema no está en el examen OCA, es posible agregar etiquetas opcionales para controlar y bloquear estructuras.

### La sentencia `break`

La sentencia `break`tranfiere el control a la sentencia que lo encierra.

```java
optionalLabel: loop (booleanExpression){
	...
	break optionalLabel;
}
```

### La sentencia `continue`

Transfiere el control a la expressión booleana para que determine si el bucle debería continuar o no.

```java
optionalLabel: loop (booleanExpression){
	...
	continue optionalLabel;
}
```
```
**Advanced flow control usage** 
			Allows optional labels	Allows break statement	Allows continue statement
if 			Yes * 					No 						No 
while 		Yes 					Yes 					Yes 
do while 	Yes 					Yes 					Yes 
for 		Yes 					Yes 					Yes 
switch 		Yes 					Yes 					No 
* Labels are allowed for any block statement, including those that are preceded with an if-then statement.
```

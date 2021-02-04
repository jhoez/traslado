<?php

/*

 /^a/ a se encuentra en la primera posicion del texto.
 /a$/ a se encuentra en la ultima posicion del texto.
 /.../ tres primeros caracteres
 /^.o/ el primer caracter seguido de cualquier caracter pero que siga una "o".
 /[]/ se utiliza para rangos
 /[0-9]/ evalua si existe numeros entre el 0 y 9
 /[a-z]/ evalua si existen letras entre la a y z
 /[a-zA-Z]/ evalua si existen letras entre la a y z
 /^H[a-z]/ empieza con H y despues cualquier letra entre a y z
 /\s/ evalua si existe algun espacio.
 /\w/ es igual que /[a-zA-Z0-9] evalua si existe cualquier valor alfanumerico
 /\d/ evalua si existe numeros
 /[aeiou]|[é]/ig evalua si existen vocales, e tildada y se utiliza lo siguiente " | /ig "
 /a+/ evalua si existe una o mas veces a.
 /a+/g evalua si existe "a" repetida y que aparezcan todas las apariciones.
 /a?/g evalua si aparece "a" o no aparece "a".
 | operador logico "o"
    controladores
      i = insensible a mayusculas y minusculas.
      g = todas las apariciones.
      m = multilinea.
    estructuras de repeticion o operadores de repeticion.
      + = cantidad de caracteres que se repetitan.
      ? = aparece el alfanumerico o no tiene que aparecer el alfanumerico.
      * = aparece cero o mas veces el caracter que le precede.
*/


1. Metacaracteres fuera de los corchetes:


Metacarácter 	Descripción
    \        	escape
    ^        	inicio de string o línea
    $        	final de string o línea
    .        	coincide con cualquier carácter excepto nueva línea
    [        	inicio de la definición de clase carácter
    ]        	fin de la definición de clase carácter
    |        	inicio de la rama alternativa
    (        	inicio de subpatrón
    )        	fin de subpatrón
    ?        	amplía el significado del subpatrón, cuantificador 0 ó 1, y hace lazy los cuantificadores greedy
    *        	cuantificador 0 o más
    +        	cuantificador 1 o más
    {        	inicio de cuantificador mín/máx
    }        	fin de cuantificador mín/máx


2. Metacaracteres dentro de los corchetes:

Metacarácter 	Descripción
    \        	carácter de escape general
    ^        	niega la clase, pero sólo si es el primer carácter
    -        	indica el rango de caracteres
?>

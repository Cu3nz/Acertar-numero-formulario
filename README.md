# Acertar-numero-formulario
Acertar un numero a traves de post en un formulario. 

<p>Formulario para acertar un numero a traves de un formulario con el metodo POST y con Sesiones</p>
<p>En la imagen de abajo se ve el numero que tienes que acertar para quitar esto puedes ir a la linea y borrarla o comentarla.</p>
<h1>Formulario en cuestion</h1>

![Captura de pantalla 2023-10-08 a las 11 20 01](https://github.com/Cu3nz/Acertar-numero-formulario/assets/145379555/835edbe7-909b-4e53-9752-6de8b15db3f9)

<h1>Mensaje de error cuando se introduce un numero que no esta entre 1 y 100</h1>

![Captura de pantalla 2023-10-08 a las 11 26 40](https://github.com/Cu3nz/Acertar-numero-formulario/assets/145379555/cb95e95b-f044-4b15-a252-842ec92e1200)



<p>El formulario contiene las siguientes validaciones y funcionalidades </p>

<ol>
  <li>Funciones</li>
  <ul>
    <li>En este caso solo lleva una funcion, la cual es la encargada de mostrar los mensajes de error que se almacenan en las sesiones (linea x )</li>
  </ul>
  <li>Creacion de un numero aleatorio</li>
  <ul>
    <li>Este numero aleatorio se tiene que almacenar en una sesion, por lo tanto primero tenemos que comprobar si hay una creada o no, en el caso de que no, se creara con un numero aleatorio entre 1 y 100</li>
    <li>Una vez creada, esa sesion se almacena en la variable $numero</li>
  </ul>
  <li>Un contador de intentos</li>
  <ul>
    <li>Este contador de intentos solo empezara si el numero que introduce el usuario esta entre 1 y 100, si no mostrara un mensaje de error mencionado anteriormente (ver imagen Mensaje de error cuando se introduce un numero que no esta entre 1 y 100) </li>
    <li>Pasa lo mismo que con la sesion de numero aleatorio, primero se comprueba que no haya una creada, si no la hay se crea con el valor a 0</li>
  </ul>

  <li>Comprobacion de que el usuario ha pulsado el boton de enviar</li>
  <ul>
    <li>Si el usuario ha pulsado el boton de enviar realizamos la siguiente validaciones y funcionalidades:</li>
    <ul>
      <li>El numero que se introduce por teclado mediante el input de formulario lo pasamos a entero con protecciones para que no se pueda ejecutar codigo js y otros lenguajes mediante el input y borrando los espacios antes y despues del numero</li>
      <li>Realizamos la validacion mediante un rango para que muestre un error si el numero no esta entre el rango de 1 y 100</li>
      <li>Si esta creamos una sesion que almacena un mensaje de error.</li>
    </ul>
    <li>Si no , es porque el usuario ha introducido un numero entre 1 y 100:</li>
    <ul>
      <li>Si el numero que introduce el usuario por teclado es mayor al numero que tiene que acertar, incrementamos el contador y mostramos un mensaje de que tiene que introducir un numero menor y con el numero de intentos (que lleva el usuario )</li>
      <li>Si el numero que introduce el usuario por teclado es menor al numero que tiene que acertar, incrementamos el contador y mostramos un mensaje de que tiene que introducir un numero mayor y con el numero de intentos (que lleva el usuario)</li>
      <li>Si el numero que introduce el usuario es el que tiene que acertar, muestra un mensaje de que ha acertado y con el numero de intentos  y definimos una sesion con nombre reset a true</li>
    </ul>
  </ul>
  <li>Codigo HTML</li>
  <ul>
    <li>Lo primero que nos vamos a encontrar es un script para que se pueda escribir de forma automatica en el input del numero sin tener que hacer click con el raton en el input cuando se pulse el boton de enviar</li>
    <li>Debajo del input donde se introduce el numero, hay una funcion llamada mostrarErrores la cual muestra el error de la segunda imagen (el que esta en rojo)</li>
    <li>En el input con name <b>pista_number</b> mostramos la sesion info, la cual almacena el mensaje de si tiene que escribir un numero mayor, menor o que ha acertado con el numero de intentos</li>
    <li>En el boton de enviar hay una sesion llamada reset, si existe es porque el usuario ha acertado el numero, por lo tanto el boton de enviar se deshabilita para que no pueda volver a pulsarlo </li>
    <li>El boton de Cambiar numero, lo unico que hace es llevarte a una pagina la cual destruye todas las sesiones que se hayan creado.</li>
  </ul>
</ol>




<?php
session_start();
//$numero = 60;

//todo Funcion para mostrar los mensajes de error.

function mostrarErrores($error_val){
    if (isset($_SESSION[$error_val])){
        echo "<p class='mt-2 text-red-700 text-sm italic'>{$_SESSION[$error_val]}</p>"; //? muestra el mensaje de error
        unset($_SESSION[$error_val]);
    }
}

//todo hacer el numero aleatorio mediante una sesion, para que cada vez que se recarge la pagina devuelva el mismo numero aleatorio.  

if (!isset($_SESSION['num_aleatorio'])){ //* Si no existe una sesion con el nombre " num_aleatorio"
    $_SESSION['num_aleatorio'] = random_int(1,100); //? Creamos la sesion y le definimos un numero aleatorio entre 1 y 100.
}


//todo Almacenamos el numero aleatorio en la varaible $numero

$numero =  $_SESSION['num_aleatorio']; //? Almacenamos la sesion que contiene los numeros aleatorios en $numero.



//todo Si no existe la sesion de contador de intentos la creamos y la definimos a 0, esto pasa cuando le damos al boton de reset o nos metemos por primera vez en la pagina.
if (!isset($_SESSION['contador_intentos'])){
    $_SESSION['contador_intentos'] = 0;
}

//Todo Si existe un post del boton de login, es porque el usuario ha hecho click en el boton de enviar.
if (isset($_POST['btnlogin'])){
    $numero_input = (int) trim(htmlspecialchars($_POST['numero'])); //? Almacenamos el numero que ha introducido el usuario por el input en la variable $numero_input

    //todo Validamos los numeros que se pueden introducir mediante un rango

    //* Si el numero que ha introducido el usuario es menor o igual a 0 , O, el numero que ha introducido es mayor a 100
    if ($numero_input <= 0 || $numero_input > 100){
        $_SESSION['fuera_rango'] = "Has introducido un numero fuera del rango del 1 al 100"; //? Guardamos en una sesion el mensaje de error, lo mostramos en la linea (76)
    } else { //* Si no es que el usuario ha introducido un numero que esta entre el 1 y el 100

        //todo Vamos a mostrar mensajes segun si el numero que introduce el usuario esta cerca o lejos del numero que tiene que acertar y ademas vamos a incrementar el contador.

       if ($numero_input > $numero){ //? Si el numero que introduce el usuario es mayor al numero que tiene que acertar ($numero):
        // ? Incrementamos el contador de intentos
        $_SESSION['contador_intentos'] = $_SESSION['contador_intentos'] += 1; 
        //? Mostramos un mensaje que dice que tienes que escribir un numero MENOR y los numeros de intentos que llevas
        $_SESSION['info_number'] = "Tienes que introducir un numero MENOR , llevas: " . $_SESSION['contador_intentos'] . " intentos";

       } else if ($numero_input < $numero){ //? Si el numero que introduce el usuario es menor al numero que tiene que acertar ($numero):
        // ? Incrementamos el contador de intentos
        $_SESSION['contador_intentos'] = $_SESSION['contador_intentos'] += 1;        
        //? Mostramos un mensaje que dice que tienes que escribir un numero MAYOR y los numeros de intentos que llevas
        $_SESSION['info_number'] = "Tienes que introducir un numero MAYOR , llevas: " . $_SESSION['contador_intentos'] . " intentos";

       } else { //! Si no, es porque ha acertado el numero.
        $_SESSION['contador_intentos'] = $_SESSION['contador_intentos'] += 1;
        $_SESSION['info_number'] = "Has acertado el numero con: " . $_SESSION['contador_intentos'] . " intentos";
        $_SESSION['reset'] = true; //? Vamos a utilizar esta sesion para que cuando acertemos el numero, desactivar el boton de enviar, que solo este disponible el boton de cambiar de numero.
       }

    }
}




?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CDN Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Script para que cada vez que le de al boton de enviar, pueda escribir en el input de forma automatica, sin necesidad de hacer click con el raton en el input cada vez que le de al boton de enviar-->
    <script>
    window.onload = function() {
        document.getElementById('numero').focus();
    };
</script>

    <title>Procesar el formulario en la misma pagina</title>
</head>



<body bgcolor="#000" text="#fff">


    <style>
        a:hover{ /**Para saber cuando estoy encima del link , sale el tipico subrayado de link */
            text-decoration: underline;
        }
    </style>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Acertar Numero 
                        <p class="acertar_num">El numero que tienes que acertar es:</p><?php echo $numero ?> <!--//todo $numero almacena el numero aleatorio-->
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div>
                            <label for="numero" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Introduce el numero</label>
                            <input type="number" name="numero" id="numero" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Por ejemplo: 20" required="">

                            <?php
                            
                               /* if(isset($_SESSION['fuera_rango'])){
                                    echo "<p class='mt-2 text-red-700 text-sm italic'>{$_SESSION['fuera_rango']}</p>"; //? muestra el mensaje de error  
                                unset($_SESSION['fuera_rango']);
                                }*/
                                mostrarErrores('fuera_rango');

                            ?>

                        </div>
                        <div>
                            <!--//! Muestra un mensaje dando la pista del numero-->
                            <label for="mensaje" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pista para aceptar el numero</label>
                            <input type="number" name="pista_number" id="numero" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly placeholder="<?php echo $_SESSION['info_number'];?>">

                        </div>

                        <br>
                        <button type="submit" name="btnlogin" class="w-auto text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="width: 100px;"<?php if(isset($_SESSION['reset'])) echo "disabled"; ?>>Enviar</button> <!--//? Si existe la sesion de reset es porque el numero ha sido acertado, por lo tanto, desactivamos el boton de enviar -->

                        <button type="reset" name="btnreset" class="w-auto text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm  py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" style="width: 150px;"><a href="reset.php" title="Se borrara los intentos que llevas">Cambiar Número</a></button> <!--Boton que cambia el numero, ya que destruye las sesiones-->
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
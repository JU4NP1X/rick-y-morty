# Explorador de API de Rick & Morty
Versión alfa 1

API Laravel de Rick y Morty es una aplicación web desarrollada backend en PHP, usando el Framework Laravel que implementa la API pública de Rick y Morty y agrega ejemplos de usabilidad, navegación, consulta y gestión CRUD.

Esta aplicación se desarrolló con el objeto de cumplir la evaluación técnica para la búsqueda de desarrolladores junior y senior fullstack en Datatraffic.

Se utilizó una arquitecura Cliente / Servidor básica con un desarrollo basado en componentes CDD.

## INSTALACION
    Realizar los siguentes pasos en otra carpeta:
    - git clone https://gitlab.com/jjyepez/rick-y-morty-api
    - cd rym_app

- ### FRONTEND
    En la raíz de la nueva carpeta hacer lo sigueinte:
    - cd ./client
    - npm install

- ### BACKEND
    #### Ubuntu/Zorin (es requerido tener instalada la extensión de PHP sqlite3):
        - $ sudo apt install openssl php-common php-curl php-json php-mbstring php-mysql php-xml php-zip
        - $ composer install 

    #### Windows (es necesario tener XAMPP o WAMPP):
        - > composer install 

## COMPILACIÓN FRONTEND
- Para compilar React (cuando haya sido modificado) se debe ejecutar npm run build en ./client

## EJECUCION
- ### FRONTEND
    - npm run start:dev

- ### BACKEND
    
-   #### Ubuntu/Zorin:
    $ php artisan serve
    
-   #### Windows:
    > php artisan serve


## KNOWN ISSUES
- La ruta específica "/characters/2" crea una redirección inexistente ( en vez de sobre escribirla) exclusivamente cuando está el "2" al final, no se encuentra estipulada en la hoja de rutas, aún eliminando todas las rutas y redirecciones sigue ocurriendo el problema, agrega la nueva ruta después /characters/, quedando /characters/crud/characters/2, cuando se espera que quede /crud/characters/2. No se ha conseguido el motivo, se espera que pueda ser un caso borde en Laravel, también se sospecha un problema en cache (se trató de borrar pero persiste), el problema no se ha llegado a registrar con niguna otra dirección ni redirección, es exclusivo con "/characters/2". ~~Posiblemente el problema sea culpa de Morty.~~

## STACK UTILIZADO
- PHP
- Laravel
- Composer
- GIT
- apt
- Visual Studio Code
- Doxygen

## AUTOR
- Juan P. Herrera (@JU4NP1X)

## FECHA DE ÚLTIMA ACTUALIZACIÓN
03/06/2021

por @JU4NP1X
    
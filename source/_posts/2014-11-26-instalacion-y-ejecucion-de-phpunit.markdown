---
layout: post
title: "Instalaci&oacute;n y ejecuci&oacute;n de phpunit"
date: 2014-11-26 08:49
comments: true
categories: [php, phpUnit, TDD, composer]
---
<p>Esta vez vamos a ver como instalar y ejecutar phpunit usando el administrador de dependencias <a href="https://getcomposer.org/" target="_blank">composer</a>.</p>
<!-- more -->
<h2>Instalar composer</h2>
<p>Estas instrucciones son ejecutadas en un equipo con sistema operativo Ubuntu 14.04.1 LTS</p>
<p align="justify">Composer es un manejador de dependencias para PHP y sirve para administrar librer&iacute;as de terceros o propias en nuestros proyectos de PHP.
Composer es capaz de de instalar las librer&iacute;as que requieres para tu proyecto y si esas librer&iacute;as dependen de otras tambi&eacute;n es capaz de resolver las dependencias y descargar todo lo que necesites.</p>
<p><i><a href="http://pear.phpunit.de/" target="_blank">En diciembre de 2014 el canal de pear para phpunit será desconectado.</a></i>.</p>
<p>Dentro de la carpeta del proyecto ejecutar el siguiente comando:</p>
{% codeblock Instalar phpUnit usando Composer - Linux %}
php -r "readfile('https://getcomposer.org/installer');" | php
{% endcodeblock %}
<p>Una vez ejecutado, dentro de la carpeta del proyecto debe estar el archivo: composer.phar</p>
<p>Dentro de la carpeta padminfo2 crear el archivo: composer.json y agregar las siguientes líneas:</p>
{% codeblock Instalar phpUnit usando Composer - json %}
{
    "require-dev": {
    "phpunit/phpunit": "3.7.*",
    "phpunit/dbunit": ">=1.2"    
    }
}
{% endcodeblock %}
<p>Dentro de la carpeta padminfo2 ejecutar:</p>
{% codeblock Instalar phpUnit usando Composer - Linux %}
php composer.phar update
{% endcodeblock %}
<p>Este comando creará la carpeta vendor y dentro de esta iniciará la descarga de las librerías necesarias para el uso de  phpunit.</p>
<p>Verificar que phpunit esta correctamente instalado, ejecutar dentro de la carpeta padminfo2</p>
{% codeblock Instalar phpUnit usando Composer - Linux %}
php vendor/bin/phpunit --version
{% endcodeblock %}
<h2>Instalar SqLite in memory</h2>
<ul>
<li>No se necesita nada instalado o configurado. </li>
<li>Sólo se necesita la base de datos durante la ejecución de las pruebas.</li>
<li>Es más rápido y no requiere ningún permiso de directorio / archivo para trabajar.</li>
<li>Se puede usar cualquier motor de base de datos.</li>
</ul>
{% codeblock Instalar phpUnit usando Composer - Linux %}
sudo apt-get install sqlite php5-sqlite
{% endcodeblock %}
<p>si hay algún error ejecutar antes:</p>
{% codeblock Instalar phpUnit usando Composer - Linux %}
sudo apt-get update
{% endcodeblock %}
<h2>Ejecutar las pruebas</h2>
<p>Las pruebas unitarias se pueden ejecutar de varias formas, entre ellas vamos a mencionar:</p>
<ul>
<li>Consola de comandos.</li>
<li>Como un programa de <a href="https://eclipse.org/pdt/" target="_blank">eclipse</a>.</li>
<li><a href="http://piece-framework.com/projects/makegood/wiki" target="_blank">MakeGood</a>.</li>
</ul>
<h3>Ejecutar las pruebas >> Consola de comandos.</h3>
<p align="justify"> Permite ejecutar la prueba desde una consola de comandos, simplemente se debe llamar el ejecutable de phpunit que esta dentro de la carpeta de las librerias que el composer descarg&oacute;</p>
{% codeblock Instalar phpUnit usando Composer - Linux %}
jbermudez@xxxxxxxxx:/yyy/yyy/yyyy/carpetaproyecto$ vendor/bin/phpunit  rutatest/PruebaTest.php

PHPUnit 3.7.38 by Sebastian Bergmann.
Configuration read from /yyy/yyy/yyyy/carpetaproyecto/tests/phpunit.xml
......
Time: 2.1 seconds, Memory: 4.75Mb

OK (6 tests, 9 assertions)
{% endcodeblock %}

<h3>Ejecutar las pruebas >> Como un programa de eclipse.</h3>

<p>Crear dentro de la carpeta del proyecto de eclipse el archivo: phpunitconsole.sh</p>
<p>Agregar las siguientes líneas:</p>
{% codeblock Instalar phpUnit usando Composer - Linux %}
#!/bin/bash
FNAME=$(echo $1 | cut -c 2-)
cd rutaproyecto;
carpetaproyecto/vendor/bin/phpunit  $FNAME;
Dar permisos de ejecución al archivo sh:
chmod 777 phpunitconsole.sh
{% endcodeblock %}
<p>Click en el icono de configuración de herramientas >> Crear un nuevo programa  >> En la pestaña common activar la opción External Tools </p>
<img src="/images/paso1.jpg" alt="Ejecuión desde línea de comandos"/>
<img src="/images/paso4.jpg"  alt="Make agregar la librer&iacute;a"/>
<h3>Ejecutar las pruebas >> Make Good.</h3>

<p>En eclipse:</p>
<p>
Window → Preferences → PHP → PHP libraries  , Agregar una nueva librería, llamarla composer.</p>
<p>En la misma ventana presionar en Add External Folder y buscar la carpeta donde esta el Vendor del composer</p>
<p>En las propiedades del proyecto:</p>
<p>Php include Path  →  Libraries →  Add library → User library → Elegir la libraria composer</p>

<img src="/images/makegoodpaso1.jpg"  alt="Make agregar la librer&iacute;a"/>

Hasta pronto !!!


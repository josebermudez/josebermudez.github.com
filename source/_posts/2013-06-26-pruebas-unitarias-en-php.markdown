---
layout: post
title: "Pruebas unitarias en PHP"
date: 2013-06-26 09:38
comments: true
categories: [php, phpUnit, TDD]
---
Bueno, el pasado 26 de junio particip&eacute; en el <a href="http://agilescolombia.org/2013/05/16/agile-open-medellin-junio-22-de-2013/" title="Agile Open Medell&iacute;n" target="_blank">Agile Open Medell&iacute;n</a> y entre los asistentes se plante&oacute; 
un dojo sobre <b>"creaci&oacute;n de pruebas unitaras para Php"</b>, all&iacute; not&eacute; que a pesar de que existen
herramientas para realizar las pruebas unitarias en este lenguage, no son tan conocidas como para Java.

Entonces mi primer post va a dar a conocer las herramientas para realizar las pruebas unitarias de nuestros proyecto Php 
y en  pr&oacute;ximos post vamos a usar estas herramientas para construir un ejemplo pr&aacute;ctico.
<!-- more -->
Para realizar las pruebas unitarias tenemos que contar con:
<ul>
<li>Servidor Apache y php:
<ol>
        <li><a href="http://www.uwamp.com/en/" title="Uwamp" target="_blank">Uwamp</a> ( mi preferido )</li>
        <li><a href="http://www.apachefriends.org/es/xampp.html" title="xampp" target="_blank">xampp</a></li>
    </ol>
</li>
</ul>
Y debemos instalar, si aun no lo tenemos: 
<ul>
<li>PEAR <a href="http://pear.php.net/" title="PEAR" target="_blank">P&aacute;gina oficial</a> </li>
<li>PHPUnit <a href="http://phpunit.de/manual/current/en/index.html" title="PHPUnit" target="_blank">P&aacute;gina oficial</a></li>
</ul>
Y un editor que nos permita escribir y realizar nuestra pruebas:
<ul>
<li>Netbeans <a href="https://netbeans.org/" title="Netbeans" target="_blank">P&aacute;gina oficial</a> </li>
<li>Eclipse <a href="http://www.eclipse.org/" title="Eclipse" target="_blank">P&aacute;gina oficial</a></li>
</ul>


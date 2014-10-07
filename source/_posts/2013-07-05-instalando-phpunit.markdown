---
layout: post
title: "Instalando PhpUnit"
date: 2013-07-05 08:54
comments: true
categories: [php, phpUnit, TDD]
---
<p>Vamos a instalar la herramienta que nos permitir&aacute; realizar nuestras pruebas unitarias.</p>
<p>Para esto debemos tener previamente en nuestra maquina el entorno de desarrollo PEAR, espero en pr&oacute;ximos post escribir un poco de 
como instalar y para que sirve ese framework.</p>
<!-- more -->
Para instalar phpUnit debemos ejecutar la siguiente l&iacute;nea de comando:

{% codeblock Instalar phpUnit usando PEAR - Windows %}
pear install -a pear.phpunit.de/PHPUnit ( Windows )
{% endcodeblock %}
Se debe ver algo como esto:

{% img /images/cmd-instalar-phpunit.png 350 350 'CMD-windows' 'CMD-windows' %}

Una vez terminado el proceso ejecutamos el siguiente comando:
{% codeblock Instalar phpUnit usando PEAR - Windows %}
pear clear-cache
{% endcodeblock %}
Y por &uacute;ltimo verificamos la versi&oacute;n de nuestro phpUnit ejecutando el siguiente comando:
{% codeblock Instalar phpUnit usando PEAR -Windows %}
phpunit --version
{% endcodeblock %}
Listo hemos terminado, ahora solo nos basta empezar a escribir nuestras pruebas unitarias para que la vida
como programadores se nos haga mas f&aacute;cil.

Hasta pronto !!!


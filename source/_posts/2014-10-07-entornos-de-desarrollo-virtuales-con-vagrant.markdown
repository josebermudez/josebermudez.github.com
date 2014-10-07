---
layout: post
author: "Jose Joaquin Bermudez Correa"
title: "Entornos de desarrollo virtuales con vagrant"
date: 2014-10-07 09:02
comments: true
categories: [vagrant,php]
---
<p>
Vagrant es una herramienta de código abierto, que nos permite crear y configurar automáticamente
entornos de desarrollo ajustados a la necesidad de la persona o del equipo de trabajo.
<!-- more -->
En las empresas donde he trabajado recuerdo que en los primeros días siempre me encuentro con la tarea
de tener que configurar mi equipo de trabajo con las herramientas que me hacen la vida de programador mas sencilla.
Bueno eso ya no va mas con esta herramienta que he conocido y que nos da unas enormes ventajas, ya que de una manera rápida podemos construir nuestros
entornos de desarrollo el cual podemos "destruir" a nuestro antojo.</p>
<p>Algunas ventajas Vagrant:</p>
<ul>
<li>Configurar entornos de desarrollo idénticos al de test, producción.</li>
<li>Mantener el mismo software instalado en las maquinas del equipo.</li>
<li>Personalización automática del entorno de trabajo.</li>
<li>Múltiples versiones del lenguaje de programación, ( PHP 5.3, PHP 5.4, PHP 5.2 ).</li>
<li>Crear ambiente desechables para probar el código en una plataforma específica. ( linux, windows, etc.)./li>
</ul>
<p>Requisitos para la instalación:</p>
<ul>
<li><a href="https://www.virtualbox.org/" target="_blank">Instalar virtualbox</a></li>
<li><a href="http://downloads.vagrantup.com/" target="_blank">Instalador de Vagrant</a></li>
</ul>
<p>Una vez instalado el vagrant procedemos a la configuración:</p>
<ul>
<li>Crear el Vagrantfile ( vagrant init ).</li>
<li>Obtener la caja ( vagrant box add mi_caja url_de_la_caja ) <a href="http://www.vagrantbox.es/" target="_blank">aquí</a> se pueden descargar múltiples cajas.</li>
<li>Configurar el Vagranrfile con los datos de la caja.</li>
<li>Iniciar la maquina ( vagrant up ).</li>
</ul>
<p>En la página oficial de vagrant se puede encontrar más <a href="https://docs.vagrantup.com/v2/getting-started/index.html" target="_blank">información</a> </p>

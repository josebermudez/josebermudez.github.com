---
layout: post
title: "PhpUnit + TDD un ejemplo pr&aacute;ctico"
date: 2013-07-12 07:21
comments: true
categories: [php, phpUnit, TDD]
---
<p>
Para entender mejor el tema de las pruebas unitarias en PHP vamos a crear un ejemplo donde 
demostaremos la utilidad y los beneficios que las pruebas tempranas trae para el desarrollo de un producto de software, ademas descrubriremos mediante TDD como podemos ir construyendo paso a paso nuestro c&oacute;digo productivo y lo mejor, con menos posibilidades de fallo.</p>
<!-- more -->
<p>Ahora si manos a la obra, vamos a suponer que nuestro sprint back log nos entrega el siguiente requisito (historia de usuario):
</p>
<p>
<strong>Como</strong> visitante del portal<br/> 
</p>
<p>
<strong>Yo quiero</strong> realizar las operaciones b&aacute;sicas de la aritm&eacute;tica<br/> 
</p>
<p>
<strong>De manera que</strong> pueda sumar, dividir, restar o multiplicar dos n&uacute;meros.<br/> 
</p>
Ya tenemos nuestro requisto:
" debemos realizar un modulo que esta en un portal web que nos permita
realizar las operaciones b&aacute;sicas de la aritm&eacute;tica ".<br/>
<span> cual seria nuestro primer paso?</span>
</p>
<p>
Normalmente nuestra respuesta ser&iacute;a: realizar el diagrama de clases, o empezar  a escribir c&oacute;digo, 
aqui es donde viene el cambio de chip, lo primero que tenemos que hacer es:<br/>
<strong> &iexcl; Escribir la prueba !</strong>
</p>
De acuerdo a la historia de usuario vamos a analizar que necesitamos:
<ul>
<li>Una clase que contenga los m&eacute;todos para las operaciones b&aacute;sicas.</li>
<li>Un m&eacute;todo para sumar que reciba 2 n&uacute;meros y retorne 1 n&uacute;mero que es la suma de los 2 par&aacute;metros de entrada.</li>
<li>Un m&eacute;todo para restar que reciba 2 n&uacute;meros y retorne 1 n&uacute;mero que es la resta de los 2 par&aacute;metros de entrada.</li>
<li>Un m&eacute;todo para dividir que reciba 2 n&uacute;meros y retorne 1 n&uacute;mero que es el cociente de la divisi&oacute;n de los 2 par&aacute;metros de entrada.</li>
<li>Un m&eacute;todo para multiplicar que reciba 2 n&uacute;meros y retorne 1 n&uacute;mero que es el resultado de la multiplicacipon de 2 n&uacute;meros.</li>
</ul>
<p>
Ya con una idea inicial de que funciones debe tener nuestro script, entonces creamos nuestra prueba la vamos a llamar: <blockquote>ArithmeticBasicOperationsTest</blockquote>
{% codeblock Test phpUnit usando Php lang: PHP%}
<?php
class ArithmeticBasicOperationsTest extends PHPUnit_Framework_TestCase{
    
}
{% endcodeblock %}
La clase de prueba extiende de una clase llamada PHPUnit_Framework_TestCase y es la que nos indica que estamos programando un test y nos permite usar todas las caracter&iacute;sticas de PhpUnit.
</p>
<p>
{% codeblock Test phpUnit usando Php lang: PHP%}
class ArithmeticBasicOperationsTest extends PHPUnit_Framework_TestCase{
     /**
     * Clase que contiene los m&eacute;todos b&aacute;sicos de operaci&oacute;n
     * 
     * @var ArithmeticBasicOperations 
     */
    protected $arithmeticBasicOperations;
     /**
     * M&eacute;todo que se ejecuta por cada test
     * 
     * Se ejecuta al iniciar cada test, se usa para inicializar el objeto a
     * que se le va a realizar las pruebas asi como los set de datos a usar.
     * 
     * @author  Jos&eacute; Joaqu&iacute;n Berm&uacute;dez Correa <jose.bermudez.correa@gmail.com>
     * @version 1.0
     * 
     * @return void;
     * 
     */
    protected function setUp()
    {
        //Instanciamos el objeto que vamos a probar
        $this->arithmeticBasicOperations = new ArithmeticBasicOperations();
    }
}
{% endcodeblock %}
Todo script de test debe sobreescribir el m&eacute;todo setUp que se encuentra en la clase <blockquote>PHPUnit_Framework_TestCase</blockquote>
</p>
<p>Para el pr&oacute;ximo post vamos a empezar a codificar nuestro test para probar la funcionalidad de sumar</p>
---
layout: post
title: "PhpUnit + TDD un ejemplo pr&aacute;ctico III"
date: 2013-07-26 07:40
comments: true
categories: [php, phpUnit, TDD]
---
<p>
En esta tercera entrega continuaremos con los test para el requisito de las operaciones matem&aacute;ticas.
Vamos a agregar m&aacute;s casos de prueba:
<ul>
<li>
    Los par&aacute;metros de entrada son un n&uacute;mero entero y un n&uacute;mero decimal.
</li>
<li>
    Los par&aacute;metros de entrada son dos n&uacute;meros decimales.
</li>
<li>
    Los par&aacute;metros de entrada son 1 n&uacute;mero entero negativo y un n&uacute;mero entero positivo.
</li>
<li>
    Los par&aacute;metros de entrada son 2 n&uacute;mero enteros negativos.
</li>
<li>
    Los par&aacute;metros de entrada son 1 letra del alfabeto y 1 n&uacute;mero entero.
</li>
<li>
    Los par&aacute;metros de entrada son Null y 1 n&uacute;mero entero.
</li>
<li>
   Los par&aacute;metros de entrada son 1 boolean falso y 1 n&uacute;mero entero.
</li>
<li>
   Los par&aacute;metros de entrada son 1 boolean true y 1 n&uacute;mero entero.
</li>
</ul>

</p>
<!-- more -->
<h2>Agregamos los nuevos casos al test</h2>
{% codeblock Test phpUnit usando Php lang: PHP%}
<?php
include_once dirname(__FILE__) . '/ArithmeticBasicOperations.php';
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

    /**
     * Test de la funci&oacute;n que realiza la suma
     * 
     * @dataProvider dataProviderAdd
     * 
     */
    public function testAdd($numberOne,$numberTwo,$result)
    {        
        $this->assertEquals(
            $result,            
                $this->arithmeticBasicOperations->add(
                    $numberOne,
                    $numberTwo
            )
        );
    }
    /**
     * Set de datos de prueba para el m$eacute;todo getReportList
     * 
     * @return array
     */
    public function dataProviderAdd()
    {
        return array(
                //primer set de datos para el test
                array(1,2,3),
                //Los par&aacute;metros de entrada son un número entero y un n&uacute;mero decimal
                array(1,2.5,3.5),
                //Los par&aacute;metros de entrada son dos n&uacute;meros decimales
                array(1.25,2.50,3.75),
                //Los par&aacute;metros de entrada son 1 n&uacute;mero entero negativo 
                //y un n&uacute;mero entero positivo
                array(-5,17,12),
               //Los par&aacute;metros de entrada son 2 n&uacute;mero enteros negativos
                array(-5,-16,-21),   
                // Los par&aacute;metros de entrada son 1 letra del alfabeto y 1 n&uacute;mero entero
                array("a",25,0),
                // Los par&aacute;metros de entrada son Null y 1 n&uacute;mero entero
                array(null,36,0),
                // Los par&aacute;metros de entrada son 1 boolean falso y 1 n&uacute;mero entero
                array(false,21,0),
                // Los par&aacute;metros de entrada son 1 boolean true y 1 n&uacute;mero entero
                array(true,21,0),                            
        );
    }
}
{% endcodeblock %}
<p> Si ejecutamos el test con nuestros nuevos casos de prueba, hay set de datos de entrada
que producen fallos en el test, por ejemplo el caso 9 retorna 22 y estamos esperando que retornara 21, con esta prueba se ha detectado que un booleano en una suma se comporta como un 0 si el valor es false y como un 1 si el valor es true, entonces que debemos hacer ?<br/> <strong>modificar nuestro c&oacute;digo para hacer pasar el nuevo caso de prueba</strong>. 
{% img /images/casos_prueba_fallidos.png 676 318 'ejecutando test phpUnit' 'ejecutando test phpUnit' %}
</p>
<p>El c&oacute;digo productivo queda de la siguiente forma:</p>
{% codeblock Funci&oacute;n aritm&eacute;tica usando Php lang: PHP%}
<?php

/**
 *  ArithmeticBasicOperations.php
 *
 * PHP Version 5.3.0
 * 
 * @category  Class 
 * @author    Jos&eacute; Joaqu&iacute;n Berm&uacute;dez Correa <jose.bermudez.correa@gmail.com>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   SVN: $Id$ 
 * 
 */

/**
 *  ArithmeticBasicOperations.php
 *
 *
 * @category  Class 
 * @author    Jos&eacute; Joaqu&iacute;n Berm&uacute;dez Correa <jose.bermudez.correa@gmail.com>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   Release: $Id$ 
 * 
 */
class ArithmeticBasicOperations
{

    /**
     * Constructor de la clase
     *      
     * @return void
     * @access public
     * 
     */
    public function __construct()
    {
        
    }

    /**
     * Funcion desctructora 
     *      
     * @return void
     * @access public
     * 
     */
    public function __destruct()
    {
        
    }
    /**
     * Funci&oacute;n que suma 2 n&uacute;meros
     * @param float $floNumberOne
     * @param float $floNumberTwo
     * @return float
     */
    public function add($floNumberOne,$floNumberTwo)
    {
        $floTotal = 0;
        if(is_numeric($floNumberOne) && is_numeric($floNumberTwo)){
            $floTotal = $floNumberOne+$floNumberTwo;
        }
        return $floTotal;
    }

}
{% endcodeblock %}
<p>Si ejecutamos ahora el test:</p>
{% img /images/casos_prueba_satisfactorio.png 668 88 'ejecutando test phpUnit' 'ejecutando test phpUnit' %}
<p>Todas las pruebas han pasado, ahora hemos abarcado mas escenarios y se ha asegurado que nuestra fucnci&oacute;n de sumar esta correcta.<br/>Podemos agregar otros casos, como:  
<ul>
<li>
    La entrada es una array.</li>
     <li>Un objeto StdClass.</li> 
    <li>Cualquier otro tipo de dato. </li>
</ul>
para verificar que la funci&oacute;n add se comporta correctamente.</p>
<p>Para el pr&oacute;ximo post vamos a implementar la funci&oacute;n de resta, agregando interaci&oacute;n con un webservice donde aprenderemos a usar Mock y Stubs.</p>

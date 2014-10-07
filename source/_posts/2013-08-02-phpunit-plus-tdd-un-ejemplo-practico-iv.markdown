---
layout: post
title: "PhpUnit + TDD un ejemplo pr&aacute;ctico IV"
date: 2013-08-02 07:50
comments: true
categories: [php, phpUnit, TDD. Mock, stubs, webservice]
---
<p>
En esta entrega vamos a ver como podemos usar mocks y stubs para realizar nuestras pruebas unitarias.
<!-- more -->
<h2>Stubs</h2>
<p>Un stub es un objeto que sustituye al objeto real y retorna determinados valores ya definidos.</p>
<p>Con un ejemplo nos puede quedar mas claro el concepto:<br/>
<p>Vamos a crear el test para el m&eacute;todo que nos va a permitir restar 2 n&uacute;meros, pero resulta que el m&eacute;todo que vamos a probar internamente invoca una clase que muy amablemente un proveedor amigo va a desarrollar, la clase de nuestro amigo aun no esta terminada, aqu&iacute; es donde entra el concepto del stub, nosotros podemos asegurar que nuestro m&eacute;todo de resta pasa los test sin necesidad de contar con la clase externa.
</p>
<p>La clase de nuestro proveedor amigo se llama: Subtracting, el m&eacute;todo que debemos usar se llama subs y recibe dos par&aacute;metros n&uacute;mero enteros y retorna un n&uacute;mero entero, con esta informaci&oacute;n nos basta para definir nuestra clase Stub
{% codeblock Stub lang: PHP%}
<?php

class Subtracting
{
    public function subs()
    {
        
    }
}
?>
{% endcodeblock %}
</p>
Ahora podemos crear nuestro test
{% codeblock Test phpUnit usando Php lang: PHP%}
<?php
include_once dirname(__FILE__) . '/ArithmeticBasicOperations.php';
include_once dirname(__FILE__) . '/Subtracting.php';
class ArithmeticBasicOperationsTest extends PHPUnit_Framework_TestCase{
...
  /**
     * Test de la funci&oacute;n que realiza la resta
     * 
     * @dataProvider dataProviderSub
     * 
     */
    public function testSub($numberOne,$numberTwo,$result)
    {        

        // Creamos el stub para la clase Subtracting.
        $stub = $this->getMock('Subtracting'); 
        // Configuramos el stub
        $stub->expects($this->any())
             ->method('sub')
             ->will($this->returnValue(5));
                 
        $this->assertEquals(
            $result,            
                $this->arithmeticBasicOperations->sub(
                    $numberOne,
                    $numberTwo,
                    $stub
            )
        );
    }
 /**
     * Set de datos de prueba para el m&eacute;todo Sub
     * 
     * @return array
     */
    public function dataProviderSub()
    {
        return array(
                //primer set de datos para el test
                array(7,2,5)                
        );
    }

...
}
{% endcodeblock %}
<ul>
<li>Con la instrucci&oacute;n getMock estamos creando un mock de una clase ya definidida</li>
<li>Con la m&eacute;todo expects podemos definir los escenarios y la respuesta que necesitamos del objeto stub</li>
<li>Con la funci&oacute;n method definimos el m&eacute;todo que vamos a sustituir</li>
<li>Con el m&eacute;todo will definimos la respuesta esperada</li>
</ul>
Si ejecutamos nuestro test va a fallar, entonces escribamos el c&oacute;digo productivo que lo hace pasar.
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
...
 /**
     * 
     * @param float $floNumberOne
     * @param float $floNumberTwo
     * @param Substracting $objSubstracting 
      * 
     * @return float
     */
    public function sub($floNumberOne,$floNumberTwo, $objSubstracting)
    {
        $floTotal = 0;
        if(is_numeric($floNumberOne) && is_numeric($floNumberTwo)){
            $floTotal = $objSubstracting->sub($floNumberOne,$floNumberTwo);
        }
        return $floTotal;
    }
...
}
{% endcodeblock %}
<p>Si ejecutamos el test este pasa y sin necesidad de tener la clase Substracting desarrollada. Podemos modificar el valor de lo que la funci&oacute;n retorna y as&iacute; verificar diferentes escenarios, o crear cuantos test necesitemos modificando el valor del m&eacute;todo will</p>
<h2>Mocks</h2>
<p>Un mock es un objeto que sustituyen a los objeto reales y que es capaz de comportarse de una manera determinada, un mock se usa cuando queremos verificar que un m&eacute;todo ha sido invocado o que la clase ha sido correctamente usada, en PhpUnit los stub y mocks se definien usando la misma instrucci&oacute;n getMock, para dejarlo mas claro miremos un ejemplo: </p>
{% codeblock Test phpUnit Mocks usando Php lang: PHP%}
<?php
include_once dirname(__FILE__) . '/ArithmeticBasicOperations.php';
include_once dirname(__FILE__) . '/Subtracting.php';
class ArithmeticBasicOperationsTest extends PHPUnit_Framework_TestCase{
...
   /**
     * Test de la funci&oacute;n que realiza la resta usando mock
     * 
     * @dataProvider dataProviderSubMock
     * 
     */
    public function testSubMock($numberOne,$numberTwo,$result)
    {        

        // Creamos el stub para la clase Subtracting.
        $stub = $this->getMock('Subtracting'); 
        // Configuramos el stub
        $stub->expects($this->exactly(2))
             ->method('sub')
             ->will($this->returnValue(5));
                 
        $this->assertEquals(
            $result,            
                $this->arithmeticBasicOperations->sub(
                    $numberOne,
                    $numberTwo,
                    $stub
            )
        );
    }
 /**
     * Set de datos de prueba para el m&eacute;todo Sub
     * 
     * @return array
     */
    public function dataProviderSubMock()
    {
        return array(
                //primer set de datos para el test
                array(7,2,5)                
        );
    }
...
}
{% endcodeblock %}
<p>El test intenta verificar que la funci&oacute;n Sub de la clase Subtracting es llamada 2 veces $this->exactly(2) </p>
{% img /images/ejecuta_mock_falla.png 657 199 'Usando Mocks phpUnit' 'Usando Mocks phpUnit' %}
<p>El test falla ya que la funci&oacute;n Sub solo es llamada una vez</p>

<p>Para el pr&oacute;ximo post vamos a ver como realizar test independientes que usen llamados a WebServices.</p>

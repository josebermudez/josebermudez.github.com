---
layout: post
author: "Jose Joaquin Bermudez Correa"
title: "PhpUnit + TDD un ejemplo pr&aacute;ctico V"
date: 2013-09-13 07:57
comments: true
categories: [php, phpUnit, TDD. Mock, stubs, webservice]
---
<p>
En esta entrega vamos crear un test donde debemos conectarnos a un WebService para obtener informaci&oacute;n.
<!-- more -->
Cuando nuestra test se debe realizar sobre una funcionalidad que se conecta a un WS para interactuar debemos mantener la independencia de nuestro test, es decir, un falla en la comunicaci&oacute;n con el WS o una comunicaci&oacute;n lenta, o que el servicio aun no esta disponible en desarrollo no debe ser impedimento para demostrar que mi funcionalidad es correcta.
Para resolver este problema podemos usar los Stubs y as&iacute; simular las repuestas del ws. <br/>Veamos un ejemplo.
<p>Vamos a crear el test para el m&eacute;todo que nos va a permitir dividir 2 n&uacute;meros enteros, pero resulta que esta funcionalidad nos la provee un WS que nos hemos encontrado en internet y nos evita tener que implementar hacer una complicada l&oacute;gica para dividir 2 n&uacute;meros.<br/>
El WS tiene un m&eacute;todo que se llama dividir y recibe 2 par&aacute;metros, n&uacute;meros enteros y retorna el cociente de la divisi&oacute;n.<br/>
Nuestra funci&oacute;n para consumir el servicio es la siguiente:
</p>
{% codeblock ArithmeticBasicOperations lang: php %}
<?php

class ArithmeticBasicOperations
{        
    public function divide(SoapClient $objSoap, $intNumberOne = 0,
        $intNumberTwo = 0)
    {
        try {
            $intDivResult = $objSoap->divide($intNumberOne, $intNumberTwo);
            return $intDivResult;
        } catch (Exception $e) {
            var_dump($e);
        }
    }

}
?>
{% endcodeblock %}
<p>Algo importante es que debemos descargar el wsdl a nuestro ambiente de desarrollo, ya que este contiene la descripci&oacute; de los m&eacute;todos, entradas y salidas del WebService y a partir de all&iacute; es que se crea el stub, para nuestro ejemplo el wsdl es el siguiente: </p>
{% codeblock divide lang: XML%}
<?xml version="1.0"?>
<definitions xmlns="http://schemas.xmlsoap.org/wsdl/" xmlns:tns="http://localhost/switchWs/index.php" xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap-enc="http://schemas.xmlsoap.org/soap/encoding/" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" name="Service" targetNamespace="http://localhost/switchWs/index.php">
    <types>
        <xsd:schema targetNamespace="http://localhost/switchWs/index.php"/>
    </types>
    <portType name="ServicePort">
        <operation name="divide">
            <documentation>Funci&#xF3;n que divide dos n&#xFA;meros y retorna el cociente</documentation>
            <input message="tns:divideIn"/>
            <output message="tns:divideOut"/>
        </operation>
    </portType>
    <binding name="ServiceBinding" type="tns:ServicePort">
        <soap:binding style="rpc" transport="http://schemas.xmlsoap.org/soap/http"/>
        <operation name="divide">
            <soap:operation soapAction="http://localhost/switchWs/index.php#divide"/>
            <input>
                <soap:body use="encoded" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" namespace="http://localhost/switchWs/index.php"/>
            </input>
            <output>
                <soap:body use="encoded" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" namespace="http://localhost/switchWs/index.php"/>
            </output>
        </operation>
    </binding>
    <service name="ServiceService">
        <port name="ServicePort" binding="tns:ServiceBinding">
            <soap:address location="http://localhost/switchWs/index.php"/>
        </port>
    </service>
    <message name="divideIn">
        <part name="intNumberOne" type="xsd:int"/>
        <part name="intNumerTwo" type="xsd:int"/>
    </message>
    <message name="divideOut">
        <part name="return" type="xsd:int"/>
    </message>
</definitions>
{% endcodeblock %}
<p>Ahora escribamos el test:</p>
{% codeblock ArithmeticBasicOperationsTest lang: PHP%}
<?php
include_once dirname(__FILE__) . '/ArithmeticBasicOperations.php';
class ArithmeticBasicOperationsTest extends PHPUnit_Framework_TestCase{
   
     ...
      /**
     * Test de la funci&oacute;n que realiza la divisi&oacute;n
     * 
     * @dataProvider dataProviderDivide
     * 
     */
    public function testDivide($stubSoapObject,$numberOne,$numberTwo,$result)
    {        
        $this->assertEquals(
            $result,            
                $this->arithmeticBasicOperations->divide(
                    $stubSoapObject,
                    $numberOne,
                    $numberTwo
            )
        );
    }
    /**
     * Set de datos de prueba para el m&eacute;todo divide
     * 
     * @return array
     */
    public function dataProviderDivide()
    {
        //crea el mock desde el wsdl del servicio
        $stubSoapObject = $this->getMockFromWsdl(
          'divide.wsdl'
        );       
        
        $stubSoapObject->expects($this->any())
                     ->method('divide')
                     ->will($this->returnValue(1));
        return array(
                //primer set de datos para el test
                array($stubSoapObject,5,5,1),
                      
        );
    }
    ...
}
?>
{% endcodeblock %}
<p> 
La funci&oacute;n que genera el stub desde la definici&oacute;n del WebService (wsdl) es : getMockFromWsdl, como par&aacute;metro se le env&iacute;a la ruta donde esta el archivo wsdl, usanto el m&eacute;todo expects definimos cual es el nombre de la funci&oacute;n del servicio que se a a usar y el valor que retorna. en nuestro caso sabemos que la divisi&oacute;n 5/5 debe retornar el valor 1 y esto lo indicamos con : $this->returnValue(1), si la respuesta del WebService es mas compleja, debemos crear la respuesta y agregarla a la instrucci&oacute;n $this->returnValue($objetoComplejo):
</p>
{% img /images/test_stub_ws.png 663 175 'Usando Stubs phpUnit WebServices' 'Usando Stubs phpUnit WebServices' %}
<p>El test pasa ya que definimos que el WS retorna 1 y que el resultado que esperamos es 1</p>
<p>Con este ejemplo hemos demostrado como realizar test sobre funcionalidades que deben conectarse a servicios externos y como nuestro test sigue siendo independiente ya que no necesita conectarse al WebService externo</p>

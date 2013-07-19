<?php

/**
 *  ArithmeticBasicOperations.php
 *
 * PHP Version 5.3.0
 * 
 * @category  Class
 * @package   Canal_Online
 * @author    José Joaquín Bermúdez Correa <jjbermudez@cognox.com>
 * @copyright 2012 UNE EPM Telecomunicaciones S.A. <www.une.com.co>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   SVN: $Id$
 * @link      http://www.une.com.co
 * 
 */

/**
 *  ArithmeticBasicOperations.php
 *
 * !!! ESCRIBE AQUI LOS COMENTARIOS DE LA CLASE ¡¡¡
 *
 * @category  Class
 * @package   Canal_Online
 * @author    José Joaquín Bermúdez Correa <jjbermudez@cognox.com>
 * @copyright 2012 UNE EPM Telecomunicaciones S.A. <www.une.com.co>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   Release: $Id$
 * @link      http://www.une.com.co
 * 
 */
class ArithmeticBasicOperations
{

    /**
     * Constructor de la clase
     * 
     * @author  José Joaquín Bermúdez Correa <jjbermudez@cognox.com> 
     * @copyright 2012 UNE EPM Telecomunicaciones S.A.     
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
     * @author  José Joaquín Bermúdez Correa <jjbermudez@cognox.com>     
     * @copyright 2012 UNE EPM Telecomunicaciones S.A.     
     * @return void
     * @access public
     * 
     */
    public function __destruct()
    {
        
    }
    /**
     * 
     * @param type $intNumberOne
     * @param type $intNumberTwo
     * @return type
     */
    public function add($intNumberOne,$intNumberTwo)
    {
       return  $intNumberOne+$intNumberTwo;
    }

}

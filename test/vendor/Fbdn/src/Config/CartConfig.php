<?php
namespace Fbdn\Config;
/**
 * CartConfig short summary.
 *
 * CartConfig description.
 *
 * @version 1.0
 * @author Francesco
 */
class CartConfig
{
    const CART_IMAGE_URL = __DIR__.'\..\..\..\img\gif\cart.gif';
    const CART_URL = __DIR__.'\..\..\..\carrello.php';
    const CART_AJAX_URL = __DIR__.'\..\..\..\ajax.php';

    function __construct(){}

    public function __toString(){
        return self::CART_IMAGE_URL;
    }
}
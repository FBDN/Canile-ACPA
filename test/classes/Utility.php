<?php

/**
 * @author Francesco
 *
 */
class Utility
{
    /**
     * <pre>Static Function: Utility::countItem()</pre>
     * @author Francesco
     * @param No Parameters
     * @return Return the value of item inside the Shopping Cart.
     */
    public static function countItem()
    {
        if (session_status() === PHP_SESSION_ACTIVE && !empty($_SESSION['cart_item']) ) {
            if (isset($_SESSION['cart_item'])) {
                //var_dump($_SESSION['cart_item']);
                return array_sum(array_column($_SESSION['cart_item'], 'quantity'));
            }
        }else{
            unset($_SESSION['cart_item']);
        }
    }
    /**
     * <pre>Static Function: Utility::countItemString()</pre>
     * @author Francesco
     * @param No Parameters
     * @return Return the value of item inside the Shopping Cart followed by the Name.
     */
  /*   public static function countItemString()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            if (isset($_SESSION['cart_item']) && $_SESSION['cart_item'] !== 0) {
                if(self::countItem()==1){
                    echo array_sum(array_column($_SESSION['cart_item'], 'quantity'))." Fotografia";
                }else{
                    echo array_sum(array_column($_SESSION['cart_item'], 'quantity'))." Fotografie";
                }
               }
        }else{
            unset($_SESSION['cart_item']);
        }
    } */
}
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyFilter
 *
 * @author admin
 */
class MyFilter extends CFilter
{
    protected function preFilter ($filterChain)
    {
        // logic being applied before the action is executed       
        echo "-->MyFilter-->pre";
        return true; // false if the action should not be executed
    }
    protected function postFilter ($filterChain)
    {
        echo "-->MyFilter-->post";
    }
}

?>

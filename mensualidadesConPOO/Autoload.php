<?php
    function autoload($clase){
        include_once($clase . ".php");
    }
    spl_autoload_register("autoload");
?>
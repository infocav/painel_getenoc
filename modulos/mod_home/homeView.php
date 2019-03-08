<?php

class homeView extends classView {

    function __construct() {
        parent::__construct();
        $this->setDirModulo(dirname(__FILE__));
        
      
    }
    
    function login()
    {
        parent::setTags('left', null);
    }

}

?>
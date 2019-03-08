<?php

class boot
{
    
  
    private $modulo;
    private $view;
    private $option;
    
    function __construct($option)
    {
        $this->option = $option;
        $this->modulo = $option['modulo'];
        $this->view = $option['view'];
    }
    
    
    function load()
    {
        if (!$this->getModulo() )
        {
           
				//ULTIMA COISA A SER CHAMADA   
//                $clView = new classView();
//                $clView->display(); 
//                
//                
            $this->moduloLoad("home",$this->getOption());
           //require_once (PATH_TEMPLATES .DS.'index.php');

        }
        else
        {
           $this->moduloLoad($this->getModulo(),$this->getOption());
        }
        
        	
         
            
    }

    function moduloLoad($modulo, $options)
    {
        require_once (PATH_MODULOS.DS.'mod_'.$modulo.DS.'index.php');
        $modulo = $modulo.'Controller';
        $moduloController = new $modulo($options);
        $moduloController->run();
    }
    
   
    
  
    function getOption()
    {
        return $this->option;
    }
    
    
    
    
    function getModulo()
    {
        return $this->modulo;
    }
    
    function getView()
    {
        return $this->view;
    }
    
    
    
    function setModulo($modulo)
    {
        $this->modulo = $modulo;
    }
    
    function setView($view)
    {
        $this->view = $view;
    }
 	
    
}

?>

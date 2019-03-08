<?php

class classFile
{
    
 private $modulo;
    private $view;
    private $option;
    private $tp;
    private $tags = array(
            'titulo' => 'Meu template',
            'cabecalho' => 'CABECALHO',
            'menu' => 'MENU',
            'conteudo' => 'CONTEUDO',
            'coluna1' => 'COLUNA1',
            'coluna2' => 'COLUNA2',
            'coluna3' => 'COLUNA3',
            'rodape' => 'RODAPE'
        ); 
     private $_output;    
    private $_template;
    private $dirModulo;


    function classFile()
    {
       $this->setDirModulo(dirname(__FILE__));
    }

    function setTags($key, $valor)
    {
        $this->tags[$key] = $valor;
    }
    
    
    function display($tpl = null)
     {
        $result = $this->loadTemplate($tpl);
        
        echo $result;
     }

    
    function loadTemplate($tpl = null)
    {
        
        
            $this->_template = PATH_TEMPLATES.DS.'index.php';
            $tplParse = new templateParser($this->_template);
            $tplParse->parseTemplate($this->tags);
            /**ob_start();
            include $this->_template;

            $this->_output = ob_get_contents();
            ob_end_clean();
            
            
            return $this->_output;      
        **/
           return $tplParse->display();
        
        /**$tp->parseTemplate($tags);
        echo $tp->display();
    **/
    }

    function loadViewTemplate($tpl = null, $position)
    {
        
        $view = get_class($this);
        $diretorio = $this->getDirModulo();

        if ($tpl ==null)
        {
            $tpl = $diretorio.DS.$view.'Template.php';
        }
        else
        {
            $tpl = $diretorio.DS.$tpl;
        }
        
       // echo $tpl;
        //echo dirname($this);
        ob_start();

        include($tpl);
        //O conteúdo deste buffer interno é copiado na variável $content
        $content=ob_get_contents();
        //descartar o conteúdo do buffer.
        ob_end_clean();

        $this->setTags($position, $content);
        
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

    function setDirModulo($dirModulo)
    {
        $this->dirModulo = $dirModulo;
    }

    function getDirModulo()
    {
        return $this->dirModulo;
    }
    
      
  
    
}

?>

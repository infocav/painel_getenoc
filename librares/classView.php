<?php

class classView {

    private $modulo;
    private $view;
    private $option;
    private $tp;
    private $tags = array(
        'titulo' => 'Meu template',
        'cabecalho' => 'CABECALHO',
        'menu' => 'MENU',
        'left' => 'LEFT',
        'conteudo' => 'CONTEUDO',
        'coluna1' => 'COLUNA1',
        'coluna2' => 'COLUNA2',
        'coluna3' => 'COLUNA3',
        'rodape' => 'RODAPE',
        'msg' => "",
        'grafico' => ""
    );
    private $_output;
    private $_template;
    private $dirModulo;
    private $dados = "TESTE DADOS";

    function __construct() {
        $this->setDirModulo(dirname(__FILE__));
        
        
        $this->setTags('left', '<ul class="nav" id="side-menu">
                   
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Cadastros<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?modulo=gNoc&view=cadastro">Cadastro de Usuário</a>
                                </li>
                                <li>
                                    <a href="?modulo=gNoc&view=gEmpresa">Gerenciar Empresa</a> 
                                </li>
                                
                            </ul>
                        </li>



                       
                    </ul>');
        
    }

    function setTags($key, $valor) {
        $this->tags[$key] = $valor;
    }

    function mostrarMsg() {
        return "MENSAGEM TESTE";
    }

    function display($tpl = null) {
        $result = $this->loadTemplate($tpl);

        echo $result;
    }

    function loadTemplate($tpl = null) {


        $this->_template = PATH_TEMPLATES . DS . 'index.php';
        $tplParse = new templateParser($this->_template);
        $tplParse->parseTemplate($this->tags);
        /*         * ob_start();
          include $this->_template;

          $this->_output = ob_get_contents();
          ob_end_clean();


          return $this->_output;
         * */
        return $tplParse->display();

        /*         * $tp->parseTemplate($tags);
          echo $tp->display();
         * */
    }

    function loadViewTemplate($tpl = null, $position) {

        $view = get_class($this);
        $diretorio = $this->getDirModulo();

        if ($tpl == null) {
            $tpl = $diretorio . DS . $view . 'Template.php';
        } else {
            $tpl = $diretorio . DS . $tpl;
        }

        // echo $tpl;
        //echo dirname($this);
        ob_start();

        include($tpl);
        //O conteúdo deste buffer interno é copiado na variável $content
        $content = ob_get_contents();
        //descartar o conteúdo do buffer.
        ob_end_clean();

        $this->setTags($position, $content);
    }

    function getTp() {
        return $this->tp;
    }

    function get_output() {
        return $this->_output;
    }

    function get_template() {
        return $this->_template;
    }

    function getDados() {
        return $this->dados;
    }

    function setDados($dados) {
        $this->dados = $dados;
    }

    function setTp($tp) {
        $this->tp = $tp;
    }

    function set_output($_output) {
        $this->_output = $_output;
    }

    function set_template($_template) {
        $this->_template = $_template;
    }

    function getOption() {
        return $this->option;
    }

    function getModulo() {
        return $this->modulo;
    }

    function getView() {
        return $this->view;
    }

    function setModulo($modulo) {
        $this->modulo = $modulo;
    }

    function setView($view) {
        $this->view = $view;
    }

    function setDirModulo($dirModulo) {
        $this->dirModulo = $dirModulo;
    }

    function getDirModulo() {
        return $this->dirModulo;
    }

}

?>

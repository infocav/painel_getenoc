
<STYLE type="text/css">  
    <!--  

    .legend {
        width: 10em;
        border: 1px solid black;
    }

    .legend .title {
        display: block;
        margin-bottom: 0.5em;
        line-height: 1.2em;
        padding: 0 0.3em;
    }

    .legend .color-sample {
        display: block;
        float: left;
        width: 1em;
        height: 1em;
        border: 2px solid; /* Comment out if you don't want to show the fillColor */
        border-radius: 0.5em; /* Comment out if you prefer squarish samples */
        margin-right: 0.5em;
    } 

    -->  
</STYLE>

<script type="text/javascript">

</script>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cadastro de Usuários.
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form role="form" class="formCadastro" id="formCadastro" method="POST" action="index.php" >
                    <div class="col-lg-6">
                        <input type="hidden" name="modulo" value="gNoc">
                        <input type="hidden" name="action" value="cadastrar">
                        <div class="form-group">
                            <label>Nome de usuário: </label>
                            <input class="form-control" placeholder="" value="" name="username" required>
                            <label>Email: </label>
                            <input class="form-control" id="email" placeholder="exemplo@empresa.com.br" value="" name="email" required>
                            <div class="row">
                                <div class="col-sm-6">
                                    <span id="vEmail" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Email Válido<br>

                                </div> 

                            </div>
                            <label>Primeiro nome: </label>
                            <input class="form-control" placeholder="" value="" name="surname" required>
                            <label>Último nome: </label>
                            <input class="form-control" placeholder="" value="" name="givenName" required>
                            <label>Empresa: </label>
                            <input class="form-control" placeholder=""  value="" name="company" required>
                            <label for="senha1" >Senha: </label>

                            <input type="password" class="form-control" id="senha1" name="senha" placeholder="Senha" required>
                            <label for="senha2" >Redigite a Senha: </label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8 Caracteres<br>
                                    <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Uma Letra Maiúscula
                                </div>
                                <div class="col-sm-6">
                                    <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Uma Letra Minúscula<br>
                                    <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Um Número
                                </div>
                            </div>
                            <input type="password" class="form-control" id="senha2" name="senha" placeholder="Redigite a Senha" required>
                            <div class="row">
                                <div class="col-sm-12">
                                    <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Senhas Iguais
                                </div>
                            </div>
  
                            <input class="btn btn-primary" type="submit" id="btnCadastrar"  value="Cadastrar" /> 
                            
                            <input class="btn btn-primary" type="submit" id="btnBuscarUsuario"  value="Cadastrar" />

                        </div>

                    </div>

                </form>

            </div>

            <div class="panel-body">
                <form role="form" class="formBuscar" id="formBuscar" method="POST" action="index.php" >
                    <div class="col-lg-6">
                        <input type="hidden" name="modulo" value="gNoc">
                        <input type="hidden" name="action" value="buscar">
                        <div class="form-group">
                            <label>Nome de usuário: </label>
                            <input class="form-control" placeholder="" value="" name="username" required>
                            <label>Email: </label>
                            <input class="form-control" id="email" placeholder="exemplo@empresa.com.br" value="" name="email" required>
                            <div class="row">
                                <div class="col-sm-6">
                                    <span id="vEmail" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Email Válido<br>

                                </div> 

                            </div>
                           
                            <label for="senha1" >Senha: </label>
                            <input type="password" class="form-control" id="senha1" name="senha" placeholder="Senha" required>
                           
                            <input class="btn btn-primary" type="submit" id="btnBuscar"  value="Buscar" /> 
                            
                         

                        </div>

                    </div>

                </form>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div  >
                                <label>Debug</label>
                                <textarea id="debug" class="form-control" rows="5"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->   


<!-- jQuery -->
<script src="templates/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="templates/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="templates/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<script src="modulos/mod_gNoc/js/cadastro.js"></script>
<script src="modulos/mod_gNoc/js/utilitarios.js"></script>
<!-- Custom Theme JavaScript -->
<script src="templates/dist/js/sb-admin-2.js"></script>

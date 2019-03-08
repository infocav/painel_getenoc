<script src="modulos/mod_gNoc/js/jquery-3.3.1.js"></script>

<script src="modulos/mod_gNoc/js/jquery.mask.js"></script>
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


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Editar Empresa
            </div>
            <div id="mensagem">
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form role="form" class="formEditEmpresa" id="formEditEmpresa" method="POST" action="index.php" >

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Empresa
                            </div>

                            <input type="hidden" name="modulo" value="gNoc">
                            <input type="hidden" name="action" value="cadEmpresa">

                            <div class="form-group">
                                <label>ID: </label>
                                <input class="form-control" placeholder="" value="" id="id" name="id" readonly="readonly"> 

                                <label>Cnpj: </label>
                                <input class="form-control form-control-lg form-control-borderless"  itemprop="obrEmp" type="text" placeholder=""  id="cnpj" name="cnpj" required maxlength="14" readonly="readonly"  > 


                                <label>Razao Social: </label>
                                <input class="form-control" placeholder=""  itemprop="obrEmp" value="" id="razao_social" name="razao_social" required maxlength="49" readonly="readonly"> 
                                <label>Nome Fantasia: </label>
                                <input class="form-control" placeholder=""  itemprop="obrEmp" value="" id="nome_fantasia" name="nome_fantasia" required maxlength="49" readonly="readonly"> 
                                <label>Alias: </label>
                                <input class="form-control" placeholder="" itemprop="obrEmp" id="alias" value="" name="alias" required maxlength="19" readonly="readonly">  
                                <label>Endereco: </label>
                                <input class="form-control" placeholder="" itemprop="obrEmp" id="endereco" value="" name="endereco" required maxlength="49" readonly="readonly"> 
                                <HR>
                                <div class="row "><label >Resposável Técnico</label> </div>

                                <label>Primeiro nome: </label>
                                <input class="form-control" placeholder=""  itemprop="obrEmp" id="surname" value="" name="surname" required maxlength="49" readonly="readonly">
                                <label>Último nome: </label>
                                <input class="form-control" placeholder="" itemprop="obrEmp" id="givenName" value="" name="givenName" required maxlength="49" readonly="readonly">
                                <label>Email administrativo: </label>
                                <input class="form-control" id="email" id="email"  itemprop="obrEmp" placeholder="exemplo@empresa.com.br" value="" name="email" required maxlength="49" readonly="readonly">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <span id="vEmail" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Email Válido<br>

                                    </div> 

                                </div>


                                <a class="btn btn-primary" href="index.php?modulo=gNoc&view=gEmpresa" role="button">Voltar</a>

                            </div>

                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Ações
                            </div>
                            <button  type="submit" class="btn btn-primary btn-block" name ="btn_cadastrar_empresa" value="btn_cadastrar_empresa" id="btn_cadastrar_empresa">Cadastrar Empresa
                                <div id="wait_btn_cadastrar_empresa" style="display:none;width:69px;height:89px;border:0px solid black">
                                    <img src='modulos/mod_gNoc/js/imagens/load.gif' width="24" height="24" />
                                </div>
                                <span id="v_btn_cadastrar_empresa" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            </button>

                            <button type="submit" class="btn btn-primary btn-block" name="btn_criar_ldap" value="btn_criar_ldap" id="btn_criar_ldap">Criar LDAP
                                <div id="wait_btn_criar_ldap" style="display:none;border:0px solid black">
                                    <img src='modulos/mod_gNoc/js/imagens/load.gif' width="24" height="24" />
                                </div>
                                <span id="v_btn_criar_ldap" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            </button>


                            <button type="submit" class="btn btn-primary btn-block" name="btn_criar_bd_zabbix" value="btn_criar_bd_zabbix" id="btn_criar_bd_zabbix">Criar Banco Zabbix
                                <div id="wait_btn_criar_bd_zabbix" style="display:none;border:0px solid black">
                                    <img src='modulos/mod_gNoc/js/imagens/load.gif' width="24" height="24" />
                                </div>
                                <span id="v_btn_criar_bd_zabbix" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            </button>

                            <button type="submit" class="btn btn-primary btn-block" name="btn_criar_docker_zabbix" value="btn_criar_docker_zabbix" id="btn_criar_docker_zabbix">Criar Docker Zabbix
                                <div id="wait_btn_criar_docker_zabbix" style="display:none;border:0px solid black">
                                    <img src='modulos/mod_gNoc/js/imagens/load.gif' width="24" height="24" />
                                </div>
                                <span id="v_btn_criar_docker_zabbix" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            </button>

                            <button type="submit" class="btn btn-primary btn-block"  name="btn_criar_front_zabbix" value="btn_criar_front_zabbix" id="btn_criar_front_zabbix">Criar Front End Zabbix
                                <div id="wait_btn_criar_front_zabbix" style="display:none;border:0px solid black">
                                    <img src='modulos/mod_gNoc/js/imagens/load.gif' width="24" height="24" />
                                </div>
                                <span id="v_btn_criar_front_zabbix" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            </button>

                            <button type="submit" class="btn btn-primary btn-block"  name="btn_criar_usuarios_zabbix" value="btn_criar_usuarios_zabbix" id="btn_criar_usuarios_zabbix">Criar Usuários Ldap Zabbix
                                <div id="wait_btn_criar_usuarios_zabbix" style="display:none;border:0px solid black">
                                    <img src='modulos/mod_gNoc/js/imagens/load.gif' width="24" height="24" />
                                </div>
                                <span id="v_btn_criar_usuarios_zabbix" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            </button>

                            <button type="submit" class="btn btn-primary btn-block"  name="btn_integra_zabbix_grafana" value="btn_integra_zabbix_grafana" id="btn_integra_zabbix_grafana">Integração Grafana Zabbix
                                <div id="wait_btn_integra_zabbix_grafana" style="display:none;border:0px solid black">
                                    <img src='modulos/mod_gNoc/js/imagens/load.gif' width="24" height="24" />
                                </div>
                                <span id="v_btn_integra_zabbix_grafana" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            </button>


                            <button type="submit" class="btn btn-primary btn-block"  name="btn_all" value="btn_all" id="btn_all">Executar todos
                                <div id="wait_btn_all" style="display:none;border:0px solid black">
                                    <img src='modulos/mod_gNoc/js/imagens/load.gif' width="24" height="24" />
                                </div>
                                <span id="v_btn_all" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            </button>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Usuários
                            </div>
                            <span class="table-add float-right mb-3 mr-2" >
                                <button type="button" id="btnNewUser"  readonly="readonly" class="fa fa-plus fa-2x" data-toggle="modal" data-target="#cadastrarUsuariosModal" ></button>
                            </span>


                            <div class="modal fade" id="cadastrarUsuariosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Novo Usuário</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="form-group">
                                            <label>Nome de usuário: </label>
                                            <input class="form-control" placeholder="" itemprop="obrUser" value="" name="usernameUser" required>
                                            <label>Email: </label>
                                            <input class="form-control" id="emailUser" placeholder="exemplo@empresa.com.br" itemprop="obrUser" value="" name="emailUser" required>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <span id="vEmailUser" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Email Válido<br>

                                                </div> 

                                            </div>
                                            <label>Primeiro nome: </label>
                                            <input class="form-control" placeholder="" itemprop="obrUser" value="" name="surnameUser" required>
                                            <label>Último nome: </label>
                                            <input class="form-control" placeholder="" itemprop="obrUser" value="" name="givenNameUser" required>

                                            <label for="senha1" >Senha: </label>

                                            <input type="password" class="form-control" itemprop="obrUser" id="senha1" name="senhaUser" placeholder="Senha" required>
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
                                            <input type="password" class="form-control" itemprop="obrUser" id="senha2" name="senhaUser" placeholder="Redigite a Senha" required>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Senhas Iguais
                                                </div>
                                            </div>



                                        </div>                 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary" name="btn_cadastrar_usuario" value="btn_cadastrar_usuario" id="btn_cadastrar_usuario">Cadastrar Usuário
                                                <div id="wait_btn_cadastrar_usuario" style="display:none;border:0px solid black">
                                                    <img src='modulos/mod_gNoc/js/imagens/load.gif' width="24" height="24" />
                                                </div>
                                                <span id="v_btn_cadastrar_usuario" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <table class="table table-hover" id="lista_usuarios">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Tipo</th>

                                    </tr>
                                </thead>

                            </table>

                        </div>

                    </div>

                    <div class="col-lg-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Sistemas
                            </div>
                            <a class="btn btn-primary btn-block" target="_blank" href="#" role="button" id="btn_acessar_zabbix" >Zabbix
                                <span id="v_btn_acessar_zabbix" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            </a>
                            <a class="btn btn-primary btn-block" target="_blank" href="#" role="button" id="btn_acessar_grafana">Grafana
                                <span id="v_btn_acessar_grafana" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            </a>




                        </div>
                    </div>

                </form>
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

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->   



<script src="modulos/mod_gNoc/js/editarEmpresa.js"></script>
<script src="modulos/mod_gNoc/js/utilitarios.js"></script>
<script src="modulos/mod_gNoc/js/cadastroUsuario.js"></script>





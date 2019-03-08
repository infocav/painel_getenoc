
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
                Gerenciamento de Empresas.
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
                 <span class="table-add float-right mb-3 mr-2"><a href="index.php?modulo=gNoc&view=cadEmpresa" class="text-success"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a></span>
            
                <table class="table table-hover" id="lista_empresa">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Alias</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">opt</th>
                        </tr>
                    </thead>
                    
                </table>
                 
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

<script src="modulos/mod_gNoc/js/gerenciarEmpresa.js"></script>
<!-- Custom Theme JavaScript -->
<script src="templates/dist/js/sb-admin-2.js"></script>


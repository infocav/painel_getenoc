
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
                Login
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form role="form" class="formLogin" id="formLogin" method="POST" action="index.php" >
                    <div class="col-lg-6">
                        <input type="hidden" name="modulo" value="home">
                        <input type="hidden" name="action" value="logar">
                        <div class="form-group">
                            <label>Nome de usuário: </label>
                            <input class="form-control" placeholder="" value="" name="username" required>
                            
                            <label for="senha" >Senha: </label>

                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                            
                            
                            <input class="btn btn-primary" type="submit" id="btnLogar"  value="Entrar" />

                        </div>

                    </div>

                </form>

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


<!-- Custom Theme JavaScript -->
<script src="templates/dist/js/sb-admin-2.js"></script>

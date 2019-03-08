  <!-- Função para o grafico -->
    <script src="templates/js/Chart/Chart.min.js"></script>
   <script type="text/javascript">
    var options = {
        responsive:true,
        //Boolean - Whether to fill the dataset with a colour
        datasetFill : true ,
     

        };

                        var data = {
                         labels: ["2012","2013","2014","2015"],
                            datasets: [
                            {
                                label: "Dados reais",
                                fillColor: "rgba(220,220,220,0.2)",
                                strokeColor: "rgba(220,220,220,1)",
                                pointColor: "rgba(220,220,220,1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(220,220,220,1)",
                                data: [4713096,5157569,5521256,1408009]},
                            {
                                label: "Dados previstos",
                                fillColor: "rgba(110, 44, 44, 0.2)",
                                strokeColor: "rgba(110, 44, 44, 0.6)",
                                pointColor: "rgba(110, 44, 44, 0.6)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(110, 44, 44, 0.6)",
                                data: [5269228.8106614,5300375.8039957,5320743.5433425,4987706.2958338] }]};
</script>

  <script type="text/javascript">
    window.onload = function(){
        var ctx = document.getElementById("GraficoLine").getContext("2d");
        var LineChart = new Chart(ctx).Line(data, options);
        //alert(LineChart.generateLegend());
    };
    </script>

 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Estimativa dos dados ...</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Gráfico valor real X valor estimado pela rede.
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                               <canvas id="GraficoLine" style="width:100%;"></canvas>
                           
                        </div>
                        <!-- /.panel-body -->
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
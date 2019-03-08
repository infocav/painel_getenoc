/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




//function montarGrafico(data, options){
//        var ctx = document.getElementById("GraficoLine").getContext("2d");
//        var LineChart = new Chart(ctx).Line(data, options);
//        legend(document.getElementById("lineLegend"), data);
//    };
//    
//function montarGrafico2(data, options){
//        var ctx = document.getElementById("GraficoLine2").getContext("2d");
//        var LineChart = new Chart(ctx).Line(data, options);
//        legend(document.getElementById("lineLegend2"), data);
//    };
    
    
// sets chart segment data for previously rendered charts
function _resetChartData(chart, new_segments) {
    // remove all the segments
    while (chart.segments.length) {
        chart.removeData();
    };

    // add the new data fresh
    new_segments.forEach (function (segment, index) {
        chart.addData(segment, index);
    });
    alert('Atualizando');
   chart.update(); 
 
};

// when I want to reset my data I call
//_resetChartData(some_chart, new_data_segments);
    

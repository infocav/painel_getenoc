/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var LineChart;
var LineChart2;
var data;
var data2;

var dados2;
var obj ;

 var options = {
                responsive:true
            };


 window.onload = function(){
        
 }; 
// Inicia o jQuery
$(function(){

	// Cria uma variável que vamos utilizar para verificar se o
	// formulário está sendo enviado
	//var enviando_formulario = false;
	                                    
	// Captura o evento de submit do formulário
	$('.upload').submit(function(){
		
		// O objeto do formulário
		var obj = this;
		
		// O objeto jQuery do formulário
		var form = $(obj);
		
		// O botão de submit
		var submit_btn = $('.upload :submit');
		
		// O valor do botão de submit
		var submit_btn_text = submit_btn.val();

		// Dados do formulário
		var dados = new FormData(obj);
		
		// Retorna o botão de submit ao seu estado natural
		function volta_submit() {
			// Remove o atributo desabilitado
			submit_btn.removeAttr('disabled');
			
			// Retorna o texto padrão do botão
			submit_btn.val(submit_btn_text);
			
			// Retorna o valor original (não estamos mais enviando)
			//enviando_formulario = false;
		}
		
		// Não envia o formulário se já tiver algum envio
		//if ( ! enviando_formulario  ) {		
		
			// Envia os dados com Ajax
			$.ajax({
				// Antes do envio
				beforeSend: function() {
					// Configura a variável enviando
					//enviando_formulario = true;
					
					// Adiciona o atributo desabilitado no botão
					submit_btn.attr('disabled', true);
					
					// Modifica o texto do botão
					submit_btn.val('Enviando...');
					
					// Remove o erro (se existir)
					//$('.error').remove();
				}, 
				
				// Captura a URL de envio do form
				url: form.attr('action'),
				
				// Captura o método de envio do form
				type: form.attr('method'),
				
				// Os dados do form
				data: dados,
				
				// Não processa os dados
				processData: false,
				
				// Não faz cache
				cache: false,
				
				// Não checa o tipo de conteúdo
				contentType: false,

				// Se enviado com sucesso
				success: function( dados ) {	
					volta_submit();
                                        
                                        
                        //dados2 = dados;

                        obj = JSON.parse(dados);
                      // alert( obj[3]);
                       // dados2 = obj[3];
                        
                        data = {
                        labels: obj.labels,
                        datasets: [
                            {
                                label: "Dados reais",
                                fillColor: "rgba(220,220,220,0.2)",
                                 strokeColor: "rgba(220,220,220,1)",
                                 pointColor: "rgba(220,220,220,1)",
                                 pointStrokeColor: "#fff",
                                 pointHighlightFill: "#fff",
                                 pointHighlightStroke: "rgba(220,220,220,1)",
                                data: obj.real
                            },
                            {
                                 label: "Dados previstos",
                                 fillColor: "rgba(110, 44, 44, 0.2)",
                                 strokeColor: "rgba(110, 44, 44, 0.6)",
                                 pointColor: "rgba(110, 44, 44, 0.6)",
                                 pointStrokeColor: "#fff",
                                 pointHighlightFill: "#fff",
                                 pointHighlightStroke: "rgba(110, 44, 44, 0.6)",
                                data: obj.previsto
                            }
                        ]
                        };
                       
                       
                       
                       
                        
                         data2 = {
                        labels: obj[0],
                        datasets: [
                            {
                                label: "Erro",
                              fillColor: "rgba(110, 44, 44, 0.2)",
                                 strokeColor: "rgba(110, 44, 44, 0.6)",
                                 pointColor: "rgba(110, 44, 44, 0.6)",
                                 pointStrokeColor: "#fff",
                                 pointHighlightFill: "#fff",
                                 pointHighlightStroke: "rgba(110, 44, 44, 0.6)",
                                data: obj.erro
                            }
                        ]
                        };
                         
                       resetCanvas();
                       
                       debug(obj.erro);
                                       
                                     
				

				},
				// Se der algum problema
				error: function (request, status, error) {
					// Volta o botão de submit
					volta_submit();
					
					// E alerta o erro
					alert("Um erro aconteceu ao processar: "+request.responseText);
				}
			});
		//}
		
		// Anula o envio convencional
		return false;
		
	});
        
        
        
        $('.teste').submit(function(){
		
		// O objeto do formulário
		var obj = this;
		
		// O objeto jQuery do formulário
		var form = $(obj);
		
		// O botão de submit
		var submit_btn = $('.upload :submit');
		
		// O valor do botão de submit
		var submit_btn_text = submit_btn.val();

               
		
		// Anula o envio convencional
		return false;
		
	});
});

function debug(data)
{
    $("textarea#debug").val(data);
}

function resetCanvas() {
    
        $('#GraficoLine').remove(); 
        $('#lineLegend').remove();
        $('#graficoCanvas').append('<canvas id="GraficoLine" style="width:100%;"></canvas><div id="lineLegend"></div>');
  
        
        var ctx = document.getElementById("GraficoLine").getContext("2d");
        LineChart = new Chart(ctx).Line(data, options);
        legend(document.getElementById("lineLegend"), data);
        
        
       // $("textarea#debug").val(dados2.trim());
    
//        $('#GraficoLine2').remove(); // this is my <canvas> element
//        $('#lineLegend2').remove();
//        $('.panel-body').append('<canvas id="GraficoLine2" style="width:100%;"></canvas><div id="lineLegend2"></div>');
//  
//        var ctx2 = document.getElementById("GraficoLine2").getContext("2d");
//        LineChart2 = new Chart(ctx2).Line(data2, options);
//        legend(document.getElementById("lineLegend2"), data2);
      
};


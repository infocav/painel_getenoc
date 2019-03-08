

// convert string to JSON
//  response = JSON.parse(response);

$(function () {


    $.ajax({

        url: "index.php?modulo=gNoc&action=listarEmpresas",

        // Se enviado com sucesso
        success: function (dados) {

            debug(dados);
            
            sessionStorage.jsonEmpresas = dados;

            
            var response = JSON.parse(dados);
            $.each(response, function (i, empresa) {
                var $tr = $('<tr>').append(
                        $('<th scope="row">').text(empresa.ID),
                        $('<td>').text(empresa.alias),
                        $('<td>').text(empresa.nome_fantasia),
                        $('<td>').text(empresa.cnpj),
                            $('<td>').html(' <span class="table-add float-right mb-3 mr-2"><a href="javascript:func('+empresa.ID+')" id="btnEditar" class="text-success"><i class="fa fa-edit fa-2x" aria-hidden="true"></i></a></span>')
                        ).appendTo('#lista_empresa');

            });



        },
        // Se der algum problema
        error: function (request, status, error) {


            // E alerta o erro
            alert("Um erro aconteceu ao processar: " + request.responseText);
        }
    });
  

});


function func(id)
{
    $.ajax({

        url: "index.php?modulo=gNoc&action=getEmpresaById&id=" + id,

        // Se enviado com sucesso
        success: function (dados) {

            //debug(dados);

            sessionStorage.jsonEmpresas = dados;
            window.location.href = 'index.php?modulo=gNoc&view=editEmpresa';

        },
        // Se der algum problema
        error: function (request, status, error) {


            // E alerta o erro
            alert("Um erro aconteceu ao processar: " + request.responseText);
        }
    });
}


function debug(data)
{
    $("textarea#debug").val(data);
}
;


debug(sessionStorage.jsonEmpresas);
var obj = JSON.parse(sessionStorage.jsonEmpresas);
populaFormCadastroEmpresa(obj);

var botao_all = false;

$("#btn_all").click(function () {
    botao_all = true;
    if (!checarInputs())
    {
        return false;
    }
    $("#btn_cadastrar_empresa").trigger('click');
    return false;
});

$("#btn_cadastrar_empresa").click(function () {

    if (!checarInputs())
    {
        return false;
    }
    var btn_act = $(this).attr("id");
    obj = document.getElementById("formEditEmpresa");
    var form = $(obj);
    var submit_btn = $('#' + btn_act);
    var submit_btn_text = submit_btn.val();
    var dados = new FormData(obj);
    dados.append('sub_act', btn_act);

    debug(dados);
    function volta_submit() {
        $("#wait_" + btn_act).css("display", "none");
        submit_btn.removeAttr('disabled');

    }
    $.ajax({
        beforeSend: function () {
            submit_btn.attr('disabled', true);
            submit_btn.val('Enviando...');
            $("#wait_" + btn_act).css("display", "inline");
        },
        url: 'index.php',
        type: 'POST',
        data: dados,
        processData: false,
        cache: false,
        contentType: false,
        async: true,

        success: function (dados) {

            volta_submit();
            debug(dados);
            obj = JSON.parse(dados);
            populaFormCadastroEmpresa(obj);
            var objEmpresa = JSON.parse(obj["empresa"].empresa);

            if (objEmpresa.id)
            {
                if (botao_all)
                {
                    $("#btn_criar_ldap").trigger('click');
                }
            }

        },
        // Se der algum problema
        error: function (request, status, error) {
            // Volta o botão de submit
            volta_submit();
            $("#mensagem").empty();
            $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao Cadastrar a Empresa!</strong>  </div>');

            $("#v_" + btn_act).removeClass("glyphicon-ok");
            $("#v_" + btn_act).addClass("glyphicon-remove");
            $("#v_" + btn_act).css("color", "#FF0004");

            submit_btn.removeAttr('disabled');

        }
    });
    return false;

});


$("#btn_criar_ldap").click(function () {

    if (!checarInputs())
    {
        return false;
    }
    var btn_act = $(this).attr("id");
    obj = document.getElementById("formEditEmpresa");
    var form = $(obj);
    var submit_btn = $('#' + btn_act);
    var submit_btn_text = submit_btn.val();
    var dados = new FormData(obj);
    dados.append('sub_act', btn_act);

    debug(dados);

    function volta_submit() {

        $("#wait_" + btn_act).css("display", "none");

    }

    $.ajax({
        beforeSend: function () {
            submit_btn.attr('disabled', true);
            submit_btn.val('Enviando...');
            $("#wait_" + btn_act).css("display", "inline");

        },
        // Captura a URL de envio do form
        url: 'index.php',
        // Captura o método de envio do form
        type: 'POST',
        // Os dados do form
        data: dados,
        // Não processa os dados
        processData: false,
        // Não faz cache
        cache: false,
        // Não checa o tipo de conteúdo
        contentType: false,
        async: true,
        // Se enviado com sucesso
        success: function (dados) {

            volta_submit();
            debug(dados);
            obj = JSON.parse(dados);
            populaFormCadastroEmpresa(obj);
            var objEmpresa = JSON.parse(obj["empresa"].empresa);
            if (objEmpresa.usuarios[0].st_ldap === "S")
            {
                if (botao_all)
                {
                    $("#btn_criar_bd_zabbix").trigger('click');
                }

            }

        },
        // Se der algum problema
        error: function (request, status, error) {

            // Volta o botão de submit
            volta_submit();
            $("#mensagem").empty();
            $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao Cadastrar a Empresa!</strong>  </div>');

            $("#v_" + btn_act).removeClass("glyphicon-ok");
            $("#v_" + btn_act).addClass("glyphicon-remove");
            $("#v_" + btn_act).css("color", "#FF0004");

            //   submit_btn.removeAttr('disabled');

        }
    });
    return false;

});


$("#btn_criar_bd_zabbix").click(function () {

    if (!checarInputs())
    {

        return false;
    }
    var btn_act = $(this).attr("id");
    obj = document.getElementById("formEditEmpresa");
    var form = $(obj);
    var submit_btn = $('#' + btn_act);
    var submit_btn_text = submit_btn.val();
    var dados = new FormData(obj);
    dados.append('sub_act', btn_act);

    debug(dados);
    // Retorna o botão de submit ao seu estado natural
    function volta_submit() {
        $("#wait_" + btn_act).css("display", "none");
    }

    $.ajax({
        // Antes do envio
        beforeSend: function () {
            submit_btn.attr('disabled', true);
            submit_btn.val('Enviando...');
            $("#wait_" + btn_act).css("display", "inline");
        },
        // Captura a URL de envio do form
        url: 'index.php',
        // Captura o método de envio do form
        type: 'POST',
        // Os dados do form
        data: dados,
        // Não processa os dados
        processData: false,
        // Não faz cache
        cache: false,
        // Não checa o tipo de conteúdo
        contentType: false,
        async: true,
        // Se enviado com sucesso
        success: function (dados) {

            volta_submit();
            debug(dados);
            obj = JSON.parse(dados);
            populaFormCadastroEmpresa(obj);

            var objEmpresa = JSON.parse(obj["empresa"].empresa);
            if (objEmpresa.zabbix.st_db_zbx === 'S')
            {

                if (botao_all)
                {
                    $("#btn_criar_docker_zabbix").trigger('click');
                }
            }


        },
        // Se der algum problema
        error: function (request, status, error) {

            // Volta o botão de submit
            volta_submit();
            $("#mensagem").empty();
            $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao Cadastrar a Empresa!</strong>  </div>');

            $("#v_" + btn_act).removeClass("glyphicon-ok");
            $("#v_" + btn_act).addClass("glyphicon-remove");
            $("#v_" + btn_act).css("color", "#FF0004");

        }
    });
    return false;

});


$("#btn_criar_docker_zabbix").click(function () {

    if (!checarInputs())
    {

        return false;
    }
    var btn_act = $(this).attr("id");
    obj = document.getElementById("formEditEmpresa");
    var form = $(obj);
    var submit_btn = $('#' + btn_act);
    var submit_btn_text = submit_btn.val();
    var dados = new FormData(obj);
    dados.append('sub_act', btn_act);

    debug(dados);

    function volta_submit() {
        $("#wait_" + btn_act).css("display", "none");
    }

    $.ajax({
        // Antes do envio
        beforeSend: function () {
            submit_btn.attr('disabled', true);
            submit_btn.val('Enviando...');
            $("#wait_" + btn_act).css("display", "inline");

        },
        // Captura a URL de envio do form
        url: 'index.php',
        // Captura o método de envio do form
        type: 'POST',
        // Os dados do form
        data: dados,
        // Não processa os dados
        processData: false,
        // Não faz cache
        cache: false,
        // Não checa o tipo de conteúdo
        contentType: false,
        async: true,
        // Se enviado com sucesso
        success: function (dados) {

            volta_submit();

            debug(dados);
            obj = JSON.parse(dados);
            populaFormCadastroEmpresa(obj);

            var objEmpresa = JSON.parse(obj["empresa"].empresa);
            if (objEmpresa.zabbix.st_docker_zbx === 'S')
            {
                if (botao_all)
                {
                    $("#btn_criar_front_zabbix").trigger('click');
                }

            }

        },
        // Se der algum problema
        error: function (request, status, error) {

            // Volta o botão de submit
            volta_submit();
            $("#mensagem").empty();
            $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao Cadastrar a Empresa!</strong>  </div>');

            $("#v_" + btn_act).removeClass("glyphicon-ok");
            $("#v_" + btn_act).addClass("glyphicon-remove");
            $("#v_" + btn_act).css("color", "#FF0004");

            //   submit_btn.removeAttr('disabled');

        }
    });
    return false;
});


$("#btn_criar_front_zabbix").click(function () {

    if (!checarInputs())
    {

        return false;
    }
    var btn_act = $(this).attr("id");
    obj = document.getElementById("formEditEmpresa");
    var form = $(obj);
    var submit_btn = $('#' + btn_act);
    var submit_btn_text = submit_btn.val();
    var dados = new FormData(obj);
    dados.append('sub_act', btn_act);

    debug(dados);

    // Retorna o botão de submit ao seu estado natural
    function volta_submit() {
        $("#wait_" + btn_act).css("display", "none");

    }
    $.ajax({
        // Antes do envio
        beforeSend: function () {
            submit_btn.attr('disabled', true);
            submit_btn.val('Enviando...');
            $("#wait_" + btn_act).css("display", "inline");
        },

        // Captura a URL de envio do form
        url: 'index.php',
        // Captura o método de envio do form
        type: 'POST',
        // Os dados do form
        data: dados,
        // Não processa os dados
        processData: false,
        // Não faz cache
        cache: false,
        // Não checa o tipo de conteúdo
        contentType: false,
        async: true,
        // Se enviado com sucesso
        success: function (dados) {

            volta_submit();
            debug(dados);
            obj = JSON.parse(dados);
            populaFormCadastroEmpresa(obj);

            var objEmpresa = JSON.parse(obj["empresa"].empresa);
            if (objEmpresa.zabbix.st_front_zbx === "S")
            {
                if (botao_all)
                {
                    $("#btn_criar_usuarios_zabbix").trigger('click');
                }

            }
        },
        // Se der algum problema
        error: function (request, status, error) {

            // Volta o botão de submit
            volta_submit();
            $("#mensagem").empty();
            $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao Cadastrar a Empresa!</strong>  </div>');

            $("#v_" + btn_act).removeClass("glyphicon-ok");
            $("#v_" + btn_act).addClass("glyphicon-remove");
            $("#v_" + btn_act).css("color", "#FF0004");

            //   submit_btn.removeAttr('disabled');

        }
    });
    return false;
});


$("#btn_criar_usuarios_zabbix").click(function () {

    if (!checarInputs())
    {

        return false;
    }
    var btn_act = $(this).attr("id");
    obj = document.getElementById("formEditEmpresa");
    var form = $(obj);
    var submit_btn = $('#' + btn_act);
    var submit_btn_text = submit_btn.val();
    var dados = new FormData(obj);
    dados.append('sub_act', btn_act);

    debug(dados);

    // Retorna o botão de submit ao seu estado natural
    function volta_submit() {
        $("#wait_" + btn_act).css("display", "none");
    }
    $.ajax({
        // Antes do envio
        beforeSend: function () {
            submit_btn.attr('disabled', true);
            submit_btn.val('Enviando...');
            $("#wait_" + btn_act).css("display", "inline");
        },

        // Captura a URL de envio do form
        url: 'index.php',
        // Captura o método de envio do form
        type: 'POST',
        // Os dados do form
        data: dados,
        // Não processa os dados
        processData: false,
        // Não faz cache
        cache: false,
        // Não checa o tipo de conteúdo
        contentType: false,
        async: true,
        // Se enviado com sucesso
        success: function (dados) {

            volta_submit();
            debug(dados);
            obj = JSON.parse(dados);
            populaFormCadastroEmpresa(obj);

            var objEmpresa = JSON.parse(obj["empresa"].empresa);
            if (objEmpresa.zabbix.st_user_ldap_zabbix === "S")
            {

                if (botao_all)
                {
                    $("#btn_integra_zabbix_grafana").trigger('click');
                }

            }

        },
        // Se der algum problema
        error: function (request, status, error) {

            // Volta o botão de submit
            volta_submit();
            $("#mensagem").empty();
            $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao Cadastrar a Empresa!</strong>  </div>');

            $("#v_" + btn_act).removeClass("glyphicon-ok");
            $("#v_" + btn_act).addClass("glyphicon-remove");
            $("#v_" + btn_act).css("color", "#FF0004");

            submit_btn.removeAttr('disabled');

        }
    });
    return false;
});


$("#btn_integra_zabbix_grafana").click(function () {

    if (!checarInputs())
    {

        return false;
    }
    var btn_act = $(this).attr("id");
    obj = document.getElementById("formEditEmpresa");
    var form = $(obj);
    var submit_btn = $('#' + btn_act);
    var submit_btn_text = submit_btn.val();
    var dados = new FormData(obj);
    dados.append('sub_act', btn_act);

    debug(dados);

    // Retorna o botão de submit ao seu estado natural
    function volta_submit() {
        $("#wait_" + btn_act).css("display", "none");
    }

    $.ajax({
        // Antes do envio
        beforeSend: function () {
            submit_btn.attr('disabled', true);
            submit_btn.val('Enviando...');
            $("#wait_" + btn_act).css("display", "inline");
        },

        // Captura a URL de envio do form
        url: 'index.php',
        // Captura o método de envio do form
        type: 'POST',
        // Os dados do form
        data: dados,
        // Não processa os dados
        processData: false,
        // Não faz cache
        cache: false,
        // Não checa o tipo de conteúdo
        contentType: false,
        async: true,

        // Se enviado com sucesso
        success: function (dados) {

            volta_submit();
            debug(dados);
            obj = JSON.parse(dados);
            populaFormCadastroEmpresa(obj);

        },
        // Se der algum problema
        error: function (request, status, error) {

            // Volta o botão de submit
            volta_submit();
            $("#mensagem").empty();
            $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao Cadastrar a Empresa!</strong>  </div>');

            $("#v_" + btn_act).removeClass("glyphicon-ok");
            $("#v_" + btn_act).addClass("glyphicon-remove");
            $("#v_" + btn_act).css("color", "#FF0004");

            submit_btn.removeAttr('disabled');

        }
    });

    return false;

});


$("#btn_cadastrar_usuario").click(function () {

    if (!checarInputsUsuarios())
    {

        return false;
    }

    var btn_act = $(this).attr("id");
    obj = document.getElementById("formEditEmpresa");
    var form = $(obj);
    var submit_btn = $('#' + btn_act);
    var submit_btn_text = submit_btn.val();
    var dados = new FormData(obj);
    dados.append('sub_act', btn_act);

    debug(dados);

    // Retorna o botão de submit ao seu estado natural
    function volta_submit() {
        $("#wait_" + btn_act).css("display", "none");

    }

    $.ajax({
        // Antes do envio
        beforeSend: function () {
            // Configura a variável enviando
            //enviando_formulario = true;

            // Adiciona o atributo desabilitado no botão
            //submit_btn.attr('disabled', true);

            // Modifica o texto do botão
            //submit_btn.val('Enviando...');

            //  $("#wait_" + btn_act).css("display", "inline");

            // Remove o erro (se existir)
            //$('.error').remove();
        },

        // Captura a URL de envio do form
        url: 'index.php',

        // Captura o método de envio do form
        type: 'POST',

        // Os dados do form
        data: dados,

        // Não processa os dados
        processData: false,

        // Não faz cache
        cache: false,

        // Não checa o tipo de conteúdo
        contentType: false,

        async: true,

        // Se enviado com sucesso
        success: function (dados) {

            volta_submit();

            // debug(dados);
            // debugger;
            debug(dados);
            obj = JSON.parse(dados);
            populaFormCadastroEmpresa(obj);





        },
        // Se der algum problema
        error: function (request, status, error) {

            // Volta o botão de submit
            volta_submit();
            $("#mensagem").empty();
            $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao Cadastrar o Usuário!</strong>  </div>');

            $("#v_" + btn_act).removeClass("glyphicon-ok");
            $("#v_" + btn_act).addClass("glyphicon-remove");
            $("#v_" + btn_act).css("color", "#FF0004");

            //   submit_btn.removeAttr('disabled');

        }
    });

    return false;

});


function populaFormCadastroEmpresa(obj)
{

    var todosOk = true;

    mostrarMensagens(obj);
    var objEmpresa = JSON.parse(obj["empresa"].empresa);

    // console.log(obj);

    $("input#id").val(objEmpresa.id);
    $("input#cnpj").val(objEmpresa.cnpj);
    $("input#razao_social").val(objEmpresa.razao_social);
    $("input#nome_fantasia").val(objEmpresa.nome_fantasia);

    $("input#alias").val(objEmpresa.alias);
    $("input#endereco").val(objEmpresa.endereco);

    $("input#surname").val(objEmpresa.usuarios[1].surname);
    $("input#givenName").val(objEmpresa.usuarios[1].givenName);
    $("input#email").val(objEmpresa.usuarios[1].email);


    if (!objEmpresa.id)
    {
        $("#v_btn_cadastrar_empresa").removeClass("glyphicon-ok");
        $("#v_btn_cadastrar_empresa").addClass("glyphicon-remove");
        $("#v_btn_cadastrar_empresa").css("color", "#FF0004");
        $("#btn_cadastrar_empresa").removeAttr('disabled');
        todosOk = false;

    } else {
        $("#v_btn_cadastrar_empresa").removeClass("glyphicon-remove");
        $("#v_btn_cadastrar_empresa").addClass("glyphicon-ok");
        $("#v_btn_cadastrar_empresa").css("color", "#00A41E");
        $("#btn_cadastrar_empresa").attr('disabled', true);



    }


    if (objEmpresa.usuarios[0].st_ldap === "N")
    {
        $("#v_btn_criar_ldap").removeClass("glyphicon-ok");
        $("#v_btn_criar_ldap").addClass("glyphicon-remove");
        $("#v_btn_criar_ldap").css("color", "#FF0004");
        $("#btn_criar_ldap").removeAttr('disabled');
        todosOk = false;



    } else {
        $("#v_btn_criar_ldap").removeClass("glyphicon-remove");
        $("#v_btn_criar_ldap").addClass("glyphicon-ok");
        $("#v_btn_criar_ldap").css("color", "#00A41E");
        $("#btn_criar_ldap").attr('disabled', true);


    }

    $("#lista_usuarios tr").remove();
    $.each(objEmpresa.usuarios, function (i, usuario) {
        var $tr = $('<tr>').append(
                $('<th scope="row">').text(usuario.id),
                $('<td>').text(usuario.username),
                $('<td>').text(usuario.tipo_usuario),
                $('<td>').html(' <span class="table-add float-right mb-3 mr-2"><a href="javascript:func(' + usuario.id + ')" id="btnEditar" class="text-success"><i class="fa fa-edit fa-2x" aria-hidden="true"></i></a></span>')
                ).appendTo('#lista_usuarios');

    });





    if (objEmpresa.zabbix.st_db_zbx === 'N')
    {
        $("#v_btn_criar_bd_zabbix").removeClass("glyphicon-ok");
        $("#v_btn_criar_bd_zabbix").addClass("glyphicon-remove");
        $("#v_btn_criar_bd_zabbix").css("color", "#FF0004");

        $("#btn_criar_bd_zabbix").removeAttr('disabled');
        todosOk = false;


    } else {
        $("#v_btn_criar_bd_zabbix").removeClass("glyphicon-remove");
        $("#v_btn_criar_bd_zabbix").addClass("glyphicon-ok");
        $("#v_btn_criar_bd_zabbix").css("color", "#00A41E");
        $("#btn_criar_bd_zabbix").attr('disabled', true);

    }


    if (objEmpresa.zabbix.st_docker_zbx === 'N')
    {
        $("#v_btn_criar_docker_zabbix").removeClass("glyphicon-ok");
        $("#v_btn_criar_docker_zabbix").addClass("glyphicon-remove");
        $("#v_btn_criar_docker_zabbix").css("color", "#FF0004");
        $("#btn_criar_docker_zabbix").removeAttr('disabled');
        todosOk = false;


    } else {
        $("#v_btn_criar_docker_zabbix").removeClass("glyphicon-remove");
        $("#v_btn_criar_docker_zabbix").addClass("glyphicon-ok");
        $("#v_btn_criar_docker_zabbix").css("color", "#00A41E");
        $("#btn_criar_docker_zabbix").attr('disabled', true);

    }


    if (objEmpresa.zabbix.st_front_zbx === "N")
    {
        $("#v_btn_criar_front_zabbix").removeClass("glyphicon-ok");
        $("#v_btn_criar_front_zabbix").addClass("glyphicon-remove");
        $("#v_btn_criar_front_zabbix").css("color", "#FF0004");
        $("#btn_criar_front_zabbix").removeAttr('disabled');
        todosOk = false;


    } else {
        $("#v_btn_criar_front_zabbix").removeClass("glyphicon-remove");
        $("#v_btn_criar_front_zabbix").addClass("glyphicon-ok");
        $("#v_btn_criar_front_zabbix").css("color", "#00A41E");
        $("#btn_criar_front_zabbix").attr('disabled', true);

    }


    if (objEmpresa.zabbix.st_user_ldap_zabbix === "N")
    {
        $("#v_btn_criar_usuarios_zabbix").removeClass("glyphicon-ok");
        $("#v_btn_criar_usuarios_zabbix").addClass("glyphicon-remove");
        $("#v_btn_criar_usuarios_zabbix").css("color", "#FF0004");
        $("#btn_criar_usuarios_zabbix").removeAttr('disabled');
        todosOk = false;


    } else {
        $("#v_btn_criar_usuarios_zabbix").removeClass("glyphicon-remove");
        $("#v_btn_criar_usuarios_zabbix").addClass("glyphicon-ok");
        $("#v_btn_criar_usuarios_zabbix").css("color", "#00A41E");
        $("#btn_criar_usuarios_zabbix").attr('disabled', true);

    }


    if (!objEmpresa.grafana.id_empresa)
    {
        $("#v_btn_integra_zabbix_grafana").removeClass("glyphicon-ok");
        $("#v_btn_integra_zabbix_grafana").addClass("glyphicon-remove");
        $("#v_btn_integra_zabbix_grafana").css("color", "#FF0004");
        $("#btn_integra_zabbix_grafana").removeAttr('disabled');
        todosOk = false;


    } else {
        $("#v_btn_integra_zabbix_grafana").removeClass("glyphicon-remove");
        $("#v_btn_integra_zabbix_grafana").addClass("glyphicon-ok");
        $("#v_btn_integra_zabbix_grafana").css("color", "#00A41E");
        $("#btn_integra_zabbix_grafana").attr('disabled', true);

    }


    if (todosOk)
    {
        $("#btn_all").attr('disabled', true);

        $("#btnNewUser").removeAttr('disabled');

    } else
    {
        $("#btn_all").removeAttr('disabled');

        $("#btnNewUser").attr('disabled', true);


    }


//    $("#btn_acessar_zabbix").attr('href', 'https://' + objEmpresa.alias + '.cloudnoc.com.br/index.php');
//    $("#btn_acessar_grafana").attr('href', 'https://' + objEmpresa.alias + '.cloudnoc.com.br/grafana');
//    $("#btn_acessar_zabbix").attr('href', objEmpresa.url_zabbix);
//    $("#btn_acessar_grafana").attr('href', objEmpresa.url_grafana);

    var endereco = document.domain.substring(document.domain.indexOf('.'));
    $("#btn_acessar_zabbix").attr('href', 'https://'+objEmpresa.alias+endereco );
    $("#btn_acessar_grafana").attr('href', 'https://'+objEmpresa.alias+endereco+'/grafana');

    


    // mostrarMensagens(obj);

}


function mostrarMensagens(mensagens)
{

    $("#mensagem").empty();

    $.each(mensagens["mensagens"], function (i, m) {

        if (m.status === "N")
        {
            // $("#mensagem").empty();
            $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> ' + m.mensagem + '</strong>  </div>');
            //   submit_btn.removeAttr('disabled');

        } else {

            // $("#mensagem").empty();
            $("#mensagem").append('<div class="alert alert-success" role="alert"> <strong> ' + m.mensagem + '</strong>  </div>');
        }

    });




}

function limparMensagens()
{
    $("#mensagem div").remove();
}



function cadastrarUsuario(id)
{
    $.ajax({

        url: "index.php?modulo=gNoc&action=buscaEmpresa&id=" + id,

        // Se enviado com sucesso
        success: function (dados) {

            // debug(dados);

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


function checarInputs()
{

    var retorno = true;

    $(('[itemprop="obrEmp"]')).each(function () {
        if (!$(this).val()) {

            alert('Preencher todos os campos: ');
            retorno = false;
            return false;
        }

    });

    return retorno;

}



function checarInputsUsuarios()
{

    var retorno = true;

    $(('[itemprop="obrUser"]')).each(function () {
        if (!$(this).val()) {

            alert('Preencher todos os campos do usuário: ');
            retorno = false;
            return false;
        }

    });

    return retorno;

}
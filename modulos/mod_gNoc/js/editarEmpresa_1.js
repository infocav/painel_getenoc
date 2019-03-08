

// convert string to JSON
//  response = JSON.parse(response);

var jsonEmpresa = JSON.parse(sessionStorage.jsonEmpresas);
populaFormEdicaoEmpresa(jsonEmpresa);
debug(sessionStorage.jsonEmpresas);
function populaFormEdicaoEmpresa(obj)
{

    $("input#id").val(obj.id);
    $("input#cnpj").val(obj.cnpj);
    $("input#razao_social").val(obj.razao_social);
    $("input#nome_fantasia").val(obj.nome_fantasia);

    $("input#alias").val(obj.alias);
    $("input#endereco").val(obj.endereco);

    $("input#surname").val(obj.usuarios[1].surname);
    $("input#givenName").val(obj.usuarios[1].givenName);
    $("input#email").val(obj.usuarios[1].email);


    if (!obj.id)
    {
        $("#v_btn_cadastrar_empresa").removeClass("glyphicon-ok");
        $("#v_btn_cadastrar_empresa").addClass("glyphicon-remove");
        $("#v_btn_cadastrar_empresa").css("color", "#FF0004");
        $("#btn_cadastrar_empresa").removeAttr('disabled');


    } else {
        $("#v_btn_cadastrar_empresa").removeClass("glyphicon-remove");
        $("#v_btn_cadastrar_empresa").addClass("glyphicon-ok");
        $("#v_btn_cadastrar_empresa").css("color", "#00A41E");
        $("#btn_cadastrar_empresa").attr('disabled', true);
    }


    if (obj.usuarios[0].st_ldap === "N")
    {
        $("#v_btn_criar_ldap").removeClass("glyphicon-ok");
        $("#v_btn_criar_ldap").addClass("glyphicon-remove");
        $("#v_btn_criar_ldap").css("color", "#FF0004");

        $("#btn_criar_ldap").removeAttr('disabled');


    } else {
        $("#v_btn_criar_ldap").removeClass("glyphicon-remove");
        $("#v_btn_criar_ldap").addClass("glyphicon-ok");
        $("#v_btn_criar_ldap").css("color", "#00A41E");

        $("#btn_criar_ldap").attr('disabled', true);

    }


    if (obj.zabbix.st_db_zbx === 'N')
    {
        $("#v_btn_criar_bd_zabbix").removeClass("glyphicon-ok");
        $("#v_btn_criar_bd_zabbix").addClass("glyphicon-remove");
        $("#v_btn_criar_bd_zabbix").css("color", "#FF0004");

        $("#btn_criar_bd_zabbix").removeAttr('disabled');


    } else {
        $("#v_btn_criar_bd_zabbix").removeClass("glyphicon-remove");
        $("#v_btn_criar_bd_zabbix").addClass("glyphicon-ok");
        $("#v_btn_criar_bd_zabbix").css("color", "#00A41E");
        $("#btn_criar_bd_zabbix").attr('disabled', true);

    }


    if (obj.zabbix.st_docker_zbx === 'N')
    {
        $("#v_btn_criar_docker_zabbix").removeClass("glyphicon-ok");
        $("#v_btn_criar_docker_zabbix").addClass("glyphicon-remove");
        $("#v_btn_criar_docker_zabbix").css("color", "#FF0004");
        $("#btn_criar_docker_zabbix").removeAttr('disabled');


    } else {
        $("#v_btn_criar_docker_zabbix").removeClass("glyphicon-remove");
        $("#v_btn_criar_docker_zabbix").addClass("glyphicon-ok");
        $("#v_btn_criar_docker_zabbix").css("color", "#00A41E");
        $("#btn_criar_docker_zabbix").attr('disabled', true);

    }


    if (obj.zabbix.st_front_zbx === "N")
    {
        $("#v_btn_criar_front_zabbix").removeClass("glyphicon-ok");
        $("#v_btn_criar_front_zabbix").addClass("glyphicon-remove");
        $("#v_btn_criar_front_zabbix").css("color", "#FF0004");
        $("#btn_criar_front_zabbix").removeAttr('disabled');


    } else {
        $("#v_btn_criar_front_zabbix").removeClass("glyphicon-remove");
        $("#v_btn_criar_front_zabbix").addClass("glyphicon-ok");
        $("#v_btn_criar_front_zabbix").css("color", "#00A41E");
        $("#btn_criar_front_zabbix").attr('disabled', true);

    }

    if (obj.zabbix.st_user_ldap_zabbix === "N")
    {
        $("#v_btn_criar_usuarios_zabbix").removeClass("glyphicon-ok");
        $("#v_btn_criar_usuarios_zabbix").addClass("glyphicon-remove");
        $("#v_btn_criar_usuarios_zabbix").css("color", "#FF0004");
        $("#btn_criar_usuarios_zabbix").removeAttr('disabled');


    } else {
        $("#v_btn_criar_usuarios_zabbix").removeClass("glyphicon-remove");
        $("#v_btn_criar_usuarios_zabbix").addClass("glyphicon-ok");
        $("#v_btn_criar_usuarios_zabbix").css("color", "#00A41E");
        $("#btn_criar_usuarios_zabbix").attr('disabled', true);

    }
    
      if (!obj.grafana.id_empresa)
    {
        $("#v_btn_integra_zabbix_grafana").removeClass("glyphicon-ok");
        $("#v_btn_integra_zabbix_grafana").addClass("glyphicon-remove");
        $("#v_btn_integra_zabbix_grafana").css("color", "#FF0004");
        $("#btn_integra_zabbix_grafana").removeAttr('disabled');


    } else {
        $("#v_btn_integra_zabbix_grafana").removeClass("glyphicon-remove");
        $("#v_btn_integra_zabbix_grafana").addClass("glyphicon-ok");
        $("#v_btn_integra_zabbix_grafana").css("color", "#00A41E");
        $("#btn_integra_zabbix_grafana").attr('disabled', true);

    }



}

var obj;
jQuery(function ($) {

    var submitActor = null;
    var $form = $('#formEditEmpresa');
    var $submitActors = $form.find('button[type=submit]');

    $form.submit(function (event) {
        if (null === submitActor) {
            submitActor = $submitActors[0];
        }

        console.log(submitActor.name + ': submit');
        var btn_act = submitActor.name;
        //var btn_act = $(this).attr("id");
        //if ($(this).attr("value") == "btn_cad_emp_full") {;
        //    alert($(this).attr("value"));
        //}
        // $("#my-form").submit(); if you want to submit the form

        // O objeto do formulário
        obj = document.getElementById("formEditEmpresa");
        // obj = $form ;
        //var obj = $('.formCadEmpresa');
        // O objeto jQuery do formulário
        var form = $(obj);


        // O botão de submit
        var submit_btn = $('#' + btn_act);

        // O valor do botão de submit
        var submit_btn_text = submit_btn.val();

        // Dados do formulário
        var dados = new FormData(obj);
        dados.append('sub_act', btn_act);

        debug(dados);
        //var dados = form.serializeArray();

        // Retorna o botão de submit ao seu estado natural
        function volta_submit() {
            // Remove o atributo desabilitado
            //submit_btn.removeAttr('disabled');

            // Retorna o texto padrão do botão
            //submit_btn.val(submit_btn_text);
            $("#wait_" + btn_act).css("display", "none");

            // Retorna o valor original (não estamos mais enviando)
            //enviando_formulario = false;
        }

        // Não envia o formulário se já tiver algum envio
        //if ( ! enviando_formulario  ) {       

        // Envia os dados com Ajax
        $.ajax({
            // Antes do envio
            beforeSend: function () {
                // Configura a variável enviando
                //enviando_formulario = true;

                // Adiciona o atributo desabilitado no botão
                submit_btn.attr('disabled', true);

                // Modifica o texto do botão
                submit_btn.val('Enviando...');

                $("#wait_" + btn_act).css("display", "inline");

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

            // Se enviado com sucesso
            success: function (dados) {

                volta_submit();

                debug(dados);
                // debugger;

                obj = JSON.parse(dados);
                if (btn_act === 'btn_cadastrar_empresa') {
                    if (obj.status_criacao === 'N')
                    {
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao Cadastrar a Empresa! ' + obj.msg_criacao + '</strong>  </div>');
                        submit_btn.removeAttr('disabled');

                    } else {
                        $("input#id").val(obj.id);
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-success" role="alert"> Empresa </strong> Cadastrada com Sucesso! </div>');

                        submit_btn.attr('disabled', true);

                    }
                }

                if (btn_act === 'btn_criar_ldap') {
                    if (obj.status_ldap === 'N')
                    {
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao Cadastrar na base LDAP ! ' + obj.msg_criacao + '</strong>  </div>');
                        submit_btn.removeAttr('disabled');

                    } else {
                        $("input#id").val(obj.id);
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-success" role="alert"> LDAP </strong> Cadastrada com Sucesso! </div>');

                        submit_btn.attr('disabled', true);


                    }
                }
                if (btn_act === 'btn_criar_bd_zabbix') {
                    if (obj.status_zabbix === 'N')
                    {
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao criar a base do zabbix! ' + obj.msg_criacao + '</strong>  </div>');
                        submit_btn.removeAttr('disabled');

                    } else {
                        $("input#id").val(obj.id);
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-success" role="alert"> Zabbix </strong> Cadastrada com Sucesso! </div>');

                        submit_btn.attr('disabled', true);

                    }
                }

                if (btn_act === 'btn_criar_docker_zabbix') {

                    if (obj.status_docker === 'N')
                    {
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao criar o DOCKER! ' + obj.msg_criacao + '</strong>  </div>');
                        submit_btn.removeAttr('disabled');

                    } else {
                        $("input#id").val(obj.id);
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-success" role="alert"> Docker </strong> Cadastrada com Sucesso! </div>');

                        submit_btn.attr('disabled', true);

                    }

                }

                if (btn_act === 'btn_criar_front_zabbix') {

                    if (obj.zabbix.st_front_zbx === 'N')
                    {
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao criar o FrontEnd! ' + obj.msg_criacao + '</strong>  </div>');
                        submit_btn.removeAttr('disabled');

                    } else {
                        $("input#id").val(obj.id);
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-success" role="alert"> FrontEnd </strong> Cadastrada com Sucesso! </div>');

                        submit_btn.attr('disabled', true);



                    }

                }
                
                 if (btn_act === 'btn_criar_usuarios_zabbix') {

                    if (obj.zabbix.st_user_ldap_zabbix === 'N')
                    {
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao inserir os usuário no Zabbix! ' + obj.msg_criacao + '</strong>  </div>');
                        submit_btn.removeAttr('disabled');

                    } else {
                        $("input#id").val(obj.id);
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-success" role="alert"> Usuários zabbix </strong> Cadastrada com Sucesso! </div>');

                        submit_btn.attr('disabled', true);
                    }

                }
                
                 if (btn_act === 'btn_integra_zabbix_grafana') {

                    if (obj.zabbix.status_grafana === 'N')
                    {
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-danger" role="alert"> <strong> Erro ao fazer a integração do grafana zabbix! ' + obj.msg_criacao + '</strong>  </div>');
                        submit_btn.removeAttr('disabled');

                    } else {
                        $("input#id").val(obj.id);
                        $("#mensagem").empty();
                        $("#mensagem").append('<div class="alert alert-success" role="alert"> Integracao grafana zabbix </strong> efetuada com Sucesso! </div>');

                        submit_btn.attr('disabled', true);
                    }

                }

                debug(dados);
                populaFormEdicaoEmpresa(obj);




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
        //}


        return false;
    });

    $submitActors.click(function (event) {
        submitActor = this;
    });
});


function debug(data)
{
    $("textarea#debug").val(data);
}
;

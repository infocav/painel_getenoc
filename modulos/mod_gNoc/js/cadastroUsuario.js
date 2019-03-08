var podeCadastrarUsuarios = false;


$("input[type=password]").keyup(function () {
    var ucase = new RegExp("[A-Z]+");
    var lcase = new RegExp("[a-z]+");
    var num = new RegExp("[0-9]+");

    if ($("#senha1").val().length >= 8) {
        $("#8char").removeClass("glyphicon-remove");
        $("#8char").addClass("glyphicon-ok");
        $("#8char").css("color", "#00A41E");
    } else {
        $("#8char").removeClass("glyphicon-ok");
        $("#8char").addClass("glyphicon-remove");
        $("#8char").css("color", "#FF0004");
    }

    if (ucase.test($("#senha1").val())) {
        $("#ucase").removeClass("glyphicon-remove");
        $("#ucase").addClass("glyphicon-ok");
        $("#ucase").css("color", "#00A41E");
    } else {
        $("#ucase").removeClass("glyphicon-ok");
        $("#ucase").addClass("glyphicon-remove");
        $("#ucase").css("color", "#FF0004");
    }

    if (lcase.test($("#senha1").val())) {
        $("#lcase").removeClass("glyphicon-remove");
        $("#lcase").addClass("glyphicon-ok");
        $("#lcase").css("color", "#00A41E");
    } else {
        $("#lcase").removeClass("glyphicon-ok");
        $("#lcase").addClass("glyphicon-remove");
        $("#lcase").css("color", "#FF0004");
    }

    if (num.test($("#senha1").val())) {
        $("#num").removeClass("glyphicon-remove");
        $("#num").addClass("glyphicon-ok");
        $("#num").css("color", "#00A41E");
    } else {
        $("#num").removeClass("glyphicon-ok");
        $("#num").addClass("glyphicon-remove");
        $("#num").css("color", "#FF0004");
    }

    if ($("#senha1").val() == $("#senha2").val()) {
        $("#pwmatch").removeClass("glyphicon-remove");
        $("#pwmatch").addClass("glyphicon-ok");
        $("#pwmatch").css("color", "#00A41E");
        //    $("#btnCadastrar").removeClass("disabled");
    } else {
        $("#pwmatch").removeClass("glyphicon-ok");
        $("#pwmatch").addClass("glyphicon-remove");
        $("#pwmatch").css("color", "#FF0004");
        //    $("#btnCadastrar").addClass("disabled");
    }
});


$("#emailUser").keyup(function ()
{
    var userinput = $(this).val();
    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
    if (pattern.test(userinput))
    {
        $("#vEmailUser").removeClass("glyphicon-remove");
        $("#vEmailUser").addClass("glyphicon-ok");
        $("#vEmailUser").css("color", "#00A41E");
        //   $("#btnCadastrar").removeClass("disabled");

    } else {
        $("#vEmailUser").removeClass("glyphicon-ok");
        $("#vEmailUser").addClass("glyphicon-remove");
        $("#vEmailUser").css("color", "#FF0004");
        //   $("#btnCadastrar").addClass("disabled");
    }
});





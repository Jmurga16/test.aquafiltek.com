$("#myFormI").on('submit', function(evt){
    evt.preventDefault();
  });
$("#ingresar").click(function() {
    var user = $("#inputUser").val();
    var pass = $("#inputPass").val();

    if (user == "" || pass == "") {
        $("#msj-errno").html("<p>Los campo <b>Usuario y contraseña</b> son obligatorios</p>");
        $("#msj-errno").css("display", "block");
    } else {
        $("#ingresar").addClass('disabled');
        $("#ingresar").html("Ingresando...");
        $.post("php/login_Script.php", { usuario: user, password: pass }, function(mensaje) {
          console.log('MENSAJE', mensaje)
            if (mensaje == -1) {
                $("#msj-errno").html("<p>Lo sentimos la<b> contraseña</b> no es correcta</p>");
                $("#msj-errno").css("display", "block");
                $("#ingresar").removeClass('disabled');
                $("#ingresar").html("Ingresar");
            } else if (mensaje == 0) {
                $("#msj-errno").css("display", "block");
                $("#msj-errno").html("<p>Lo sentimos el<b> usuario</b> y la <b>contraseña</b> no son correctos</p>");
                $("#ingresar").removeClass('disabled');
                $("#ingresar").html("Ingresar");
            } else if (mensaje == 1) {
                location.replace("php/Modulo_Administrador.php");
            } else if (mensaje == 2) {
                iniciar_sesion();
            }
        });
    }
});

function getHora() {
    var f = new Date();
    var cad = "";
    if (f.getHours() < 10)
        cad += "0" + f.getHours() + ":";
    else
        cad += f.getHours() + ":";
    if (f.getMinutes() < 10)
        cad += "0" + f.getMinutes() + ":";
    else
        cad += f.getMinutes() + ":";
    if (f.getSeconds() < 10)
        cad += "0" + f.getSeconds();
    else
        cad += f.getSeconds();
    return cad;

}

function getDia() {
    var f = new Date();
    var cad = "";
    if (f.getDate() < 10)
        cad += "0" + f.getDate() + "/";
    else
        cad += f.getDate() + "/";
    if ((f.getMonth() + 1) < 10)
        cad += "0" + (f.getMonth() + 1) + "/";
    else
        cad += (f.getMonth() + 1) + "/";

    cad += f.getFullYear();

    return cad;
}

function iniciar_sesion() {
    var ip, hora, dia;
    hora = getHora();
    dia = getDia();
    $.getJSON('https://api.ipify.org/?format=json', function(data) {
        ip = data['ip'];
        $.post("php/guardar_Datos.php", { hora: hora, dia: dia, direccion: ip }, function(mensaje) {
          console.log('MENSAJE', mensaje)
            if (mensaje == 1)
                location.replace("php/Modulo_Usuario.php");
        });
    });
}

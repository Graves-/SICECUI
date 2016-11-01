jQuery(document).ready(function($) {
  cargarCarreras();
});

function cargarCarreras() {
  $.get('model/carreras.php', function(data) {
    console.log(data);
    var objCarrera = $.parseJSON(data);
    for (var i = 0; i < objCarrera.length; i++) {
      //console.log();
      $('#inputCarrera').append($('<option>',{
        value: objCarrera[i].clave_carrera,
        text: objCarrera[i].nombre_carrera
      }));
    }
  });
}

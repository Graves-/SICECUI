var app = angular.module('sisecui', []);

app.controller('lista_alumnos', function($scope, $http) {
    $http.get("model/alumnos.php")
    .then(function(response) {
        $scope.alumnos = response.data;
    });
});

app.controller('lista_maestros', function($scope, $http) {
    $http.get("model/maestros.php")
    .then(function(response) {
        $scope.maestros = response.data;
    });
});

app.controller('lista_materias', function($scope, $http) {
    $http.get("model/materias.php")
    .then(function(response) {
        $scope.materias = response.data;
    });
});

app.controller('lista_carreras', function($scope, $http) {
    $http.get("model/carreras.php")
    .then(function(response) {
        $scope.carreras = response.data;
    });
});

app.controller('inscripcion_alumno', function($scope, $http) {

});

app.controller('inscripcion_maestro', function($scope, $http) {

});

app.controller('kardex_alumno', function($scope, $http) {
  var arreglo = null;
  var arreglo_nombres = [];
  var arreglo_carreras = [];
  var arreglo_id_carreras = [];

  $http.get("model/carreras.php")
  .then(function(response) {
      arreglo = response.data;
      for (var i = 0; i < arreglo.length; i++) {
        arreglo_carreras.push({nombre: arreglo[i].nombre_carrera, id: arreglo[i].clave_carrera});
      }
  });

  //FUNCION PARA FILTRAR ALUMNOS CUANDO SE SELECCIONA UNA CARRERA
  $scope.update = function(carrera){
    var config = {
      params: {
          id_carrera: $scope.selectedCarrera
      }
    }
    //PETICION AL SERVIDOR PARA FILTRADO DE ALUMNOS PARA EL KARDEX
    $http.get("model/alumno_filtro_kardex.php",config)
    .then(function(response) {
        document.getElementById("myinput").value = "";
        var arreglo_resultado = response.data;
        for (var i = 0; i < arreglo_resultado.length; i++) {
          arreglo_nombres.push(arreglo_resultado[i].nombre_alumno + "-" + arreglo_resultado[i].numero_control);
        }
    });

    //PARA LLENAR EL ARREGLO PARA EL 'Awesomplete'
    var input = document.getElementById("myinput");
    var awesomplete = new Awesomplete(input, {
      minChars: 1,
      autoFirst: true,
      maxItems: 10
    });
    awesomplete.list = arreglo_nombres;
 };

 //CUANDO EL USUARIO DA CLICK EN EL BOTON DE "CONSULTAR KARDEX"
 $scope.ConsultarKardex = function() {

   var info_alumno = document.getElementById("myinput").value;

   //IF - SI EL INPUT DEL NOMBRE DEL ALUMNO NO ES VACIO
   if (info_alumno != "") {
     var arreglo_info = info_alumno.split("-");
     var nombre_alumno = arreglo_info[0];
     var numctrl_alumno = arreglo_info[1];

     document.getElementById('kardex_nombre_alumno').innerHTML = nombre_alumno;

     var config = {
       params: {
           nombre: nombre_alumno,
           numctrl: numctrl_alumno
       }
     }
     $http.get("model/obtener_kardex_alumno.php",config)
     .then(function(response) {
       console.log(response.data);
     });

   } //FIN SI

 };

 $scope.nombres_carreras = arreglo_carreras;
});

app.controller('centro_mensajes', function($scope, $http) {
  $scope.MandarMensaje = function() {
    alert("aayy lmao");
  }
});

app.controller('asignacion_grupos', function($scope, $http) {
  $http.get("model/alumnos.php")
  .then(function(response) {
      $scope.alumnos = response.data;
  });

  $scope.AsignarGrupo = function(nombre,numctrl,carrera){
    //alert(nombre + ' ' + numctrl);
    $scope.nombre_alumnoSelected = nombre;
    $scope.numctrl_alumnoSelected = numctrl;
    $scope.carrera_alumnoSelected = carrera;
  };
});

<?php
//Agrega la interfaz del preceptor comun a todas las secciones
include_once "GUIPreceptor.class.php";

/**
 * Tabla curso
 * @author 
 * @version 1.0
 */
$gui_preceptor = new GUIPreceptor();
?>

 <div class="content-wrapper">
 
    <section class="content-header">
      <h1>
        IMPRESION DE BOLETINES     
        <small> </small>
      </h1>
        <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="registrarAsistencia.php">Asistencias</a></li>
        <li class="active">Registrar asistencias</li>
      </ol> 
    </section>
     

     <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> </h3>
            </div>
            <!-- /.box-header -->
          <div class="box-body">  

          <div class="container">
        
    </div>

    <body>
        <?php
        require_once "../logica/AlumnoxCurso.php";
        require_once "../logica/Curso.php";
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $curso = $_REQUEST['sel']; //se obtiene el id del curso seleccionado desde el archivo cursos.php
        $alumnos = AlumnoxCurso::obtenerAlumnoxCurso($curso, (int) date("Y")); //se obtienen los alumnos del curso seleccionado del a�o actual
        $cantfilas = count($alumnos); //se cuentan los registros obtenidos de la consulta anterior
        ?>
        <form action="../logica/generarPdfBoletinPorCurso.php" method="POST" >
        <div class="panel-heading row">
            <input type="hidden" name="idCurso" value="<?php echo $curso;?>">
            <input type="submit" style="float: right;" class="btn btn-danger " value="Imprimir curso completo" id="guardar" name="generarPdfPorCurso">
        </div>
        </form>
        
        <form action="listarInasistencias.php" method="GET">
            <!-- tabla donde estan contenidos todos los alumnos del curso seleccionado !-->
            <table class="table table-bordered" border="1" width="100%">

                <tr>
                    <td rowspan="2" colspan="2">Curso: 
                        <?php
                        //se muestra en la tabla el curso actual
                        $c = new Curso();
                        $curso_actual = $c->obtenerCurso($curso);
                        echo $curso_actual [0]['anio'] . ' ' . $curso_actual[0]['nombre'];
                        ?>
                    </td>
                
                </tr>
                <tr>
                    <td colspan="2">Inasistencias</td>
                </tr>
                <tr>
                    <td width="3%">#</td>
                    <td width="70%">Apellido y nombre</td>
                </tr>      
                <?php
                
                for ($i = 0; $i < $cantfilas; $i++) {
                    
                    //se hace de manera dinamica la carga de los alumnos a la tabla, con sus respectivos 
                    //checkbox donde se computan las faltas a clase y a ed-fisica.
                    ?>
                    <tr>
                        <td><?php echo $i + 1 ?></td> <!-- se muestra el numero del alumno en la tabla -->
                        <td><?php echo $alumnos[$i]["apellido"] . ", " . $alumnos[$i]["nombre"] ?> </td> 
                        <!-- se muestra el nombre y apellido del alumno en la tabla --> 
                        <td>
                            <!--checkbox para computar la asistencia a ed fisica -->
                            <input  class="btn btn-danger" value="Ver Boletin" type="submit" onclick="cargarDni(<?php echo $alumnos[$i]['dni'];?>)">
                            <!--formaction="listarInasistencias.php?dni=<?php// echo $alumnos[$i]['dni'];?>">-->
                        </td>
                    </tr>


                    <?php
                   
                }//cierre del for
                ?>

            </table>
            <input type="hidden" name='dni' id='hiddenDni'>
           </form>
             
        
    <script>
        function cargarDni(dni){
            document.getElementById('hiddenDni').value=dni;
        }

    </script>
    </body>
     
 </div>
 </div>
 </div>
 
  </section>

 
</div>
 
 

<?php

//Agrega el footer comun a todas las secciones
$gui_preceptor->cargarFooter();

?>
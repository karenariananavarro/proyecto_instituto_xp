<?php
require_once "../persistencia/conexionBD.php";
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Clase ALumnoxCurso
 * @author 
 * @version 1.0
 */
class AlumnoxCurso {

    /**
     * Obtiene los alumnos x curso
     * @author Franco Morero y Nicolas Dechecchi
     * @version 1.0
     * @param id_curso id del curso a recuperar los alumnos
     * @param anio año del curso que se quiere obtener (2018,2019,..)
     * @return array asociativo donde cada columna esta representada por su nombre: dni,nombre,apellido
     */
    public static function obtenerAlumnoxCurso($id_curso, $anio) {
        $con = ConexionBD::getConexion();
        $result = $con->recuperarAsociativo("select dni,nombre,apellido from alumnoxcurso,alumno where alumnoxcurso.curso_idcurso='" . $id_curso . "' and alumnoxcurso.anio='" . $anio . "' and alumnoxcurso.alumno_dni=alumno.dni order by alumno.apellido, alumno.nombre");
        return $result;
    }
}

?>
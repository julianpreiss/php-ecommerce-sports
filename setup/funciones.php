<?php 

function nombremes( $numero ){
	if( $numero == 1 ) return 'Enero';
	if( $numero == 2 ) return 'Febrero';
	if( $numero == 3 ) return 'Marzo';
	if( $numero == 4 ) return 'Abril';
	if( $numero == 5 ) return 'Mayo';
	if( $numero == 6 ) return 'Junio';
	if( $numero == 7 ) return 'Julio';
	if( $numero == 8 ) return 'Agosto';
	if( $numero == 9 ) return 'Septiembre';
	if( $numero == 10 ) return 'Octubre';
	if( $numero == 11 ) return 'Noviembre';
	if( $numero == 12 ) return 'Diciembre';
}


function generar_fecha_por_idioma( $dia, $mes, $anio, $fechacompleta = true){
	if( $fechacompleta == false ){
		return "$dia/$mes";
	}else{
			$nombre_mes = nombremes( $mes );
			return "$dia de $nombre_mes de $anio";
	}
}
?>
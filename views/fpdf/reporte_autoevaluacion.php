<?php
    require_once "../../config/conexion.php";
    require_once "../../Controladores/evaluacionControlador.php";
	require_once "../../Modelos/evaluacionModelo.php";
    header("Content-type: application/xls");
    header("Content-Disposition: attachment; filename=autoevaluacion.xls")
?>

<table class="table table-bordered table-striped T data-table">
	<thead>
		<tr>
			<th style="width:10px">#</th>
            <th>Materia</th>
			<th>Pregunta</th>
			<th>Respuestas</th>
			<th>Cantidad</th>
			<th>Periodo</th>
		</tr> 
	</thead>
	<tbody>
		<?php
			$tablaA="estudiante_autoevaluacion";
			$reporte = EvaluacionModelo::VerReportesAModelo($tablaA);
			
			foreach ($reporte as $key => $value){
				echo'
				<tr>
					<td>'.($key+1).'</td>
                    <td>'.$value["id_materia"].'</td>
					<td>'.$value["pregunta"].'</td>
					<td>'.$value["respuesta"].'</td>
					<td>'.$value[2].'</td>
					<td>2023-1</td>
				</tr>';
		
			}
        ?>
	</tbody>
</table>
<!--<td>'.PERIODO_ACTUAL.'</td>-->

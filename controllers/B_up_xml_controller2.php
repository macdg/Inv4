<?php
class B_up_xml_controller2 extends CI_Controller {

public function __construct() {
	parent::__construct();
	$this->load->helper('file','form','html','url','directory');
	$this->load->model('B_up_xml_model_mejor');
	$this->load->model('B_up_xml_model_mejor','b_up_xml_model');
	$this->load->library('form_validation');
	
}


public function index() {

 $this->load->view('b_subirgeneral1_view2_mejor');

}


public function subiendo_archivo() {

	echo '<br><br><br>';

	if (is_uploaded_file($_FILES['mi_archivo_1']['tmp_name'])) {
		$nombreDirectorio = "/var/www/html/ci/uploads/";
 	$nombreFichero = $_FILES['mi_archivo_1']['name'];
 	$rutaCompleta = $nombreDirectorio . $nombreFichero;

	 	if (file_exists($nombreDirectorio.$nombreFichero)) {
				echo '<br>'.'El archivo: "'.$nombreFichero.'", ya existe en "'.$nombreDirectorio. '" Seleccione otro archivo.';
				echo '<br><br><br>';
				return ($this->load->view('pagina_exito_mejor'));
				exit();
			}

				$val_ext=substr($nombreFichero,-4);
				if ($val_ext !== '.xml') {
						echo '<br><br>Extensión del archivo invalido: ' .  $val_ext  .   '     Seleccione otro archivo.';
					 echo '<br><br><br>';
					 return ($this->load->view('pagina_exito_mejor'));
						exit();
				}

					move_uploaded_file($_FILES['mi_archivo_1']['tmp_name'],$rutaCompleta);
					echo $this->tipo_archivo($nombreFichero, $rutaCompleta);
 }
 	else
 		echo ("No se ha podido subir el fichero");
			echo '<br><br><br>';

}


public function tipo_archivo($nombreFichero, $rutaCompleta) {
	
	echo 'El nombre del archivo subido es: '.$nombreFichero;
	echo '<br><br>';
	$val_ext=substr($nombreFichero,-4);
	echo 'Extension del archivo valido: '.$val_ext;
	echo '<br>';
 echo $this->conv_xmlarreglo($rutaCompleta);

}


public function conv_xmlarreglo($rutaCompleta){
	
	$this->load->helper('xml2array');
	$contents= file_get_contents($rutaCompleta);
	$result = xml2array($contents,1,'attribute');
 echo $this->cam_estructura($result);

}


public function cam_estructura($result) {

		if (!isset($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'][0]))
			$result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'] = array(0 => $result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto']);

		echo $this->asignando_var($result);

}


public function asignando_var($result){

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

  $cont=count($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto']);

	for ($i=0; $i<$cont; $i++){

 	foreach ($result['cfdi:Comprobante']['cfdi:Conceptos']['cfdi:Concepto'][$i]['attr'] as $e => $val) {
 		 	
		if ($e == 'cantidad')
					$cantidad = $val;
		if ($e == 'unidad')
					$unidad = $val;
		if ($e == 'descripcion')
					$descrip = $val;
		if ($e == 'valorUnitario')
					$val_unit = $val;

 $datos_concepto_c[$i]=$cantidad;
 $datos_concepto_u[$i]=$unidad;
 $datos_concepto_d[$i]=$descrip;
 $datos_concepto_v[$i]=$val_unit;
		}

 }

 	foreach ($result['cfdi:Comprobante']['cfdi:Complemento']['tfd:TimbreFiscalDigital']['attr'] as $s => $vu) {

			if ($s=='UUID')
					$id_uuid=$vu;

		}

		foreach ($result['cfdi:Comprobante']['cfdi:Emisor']['cfdi:DomicilioFiscal']['attr'] as $ke => $vue) {

			if ($ke=='calle')
					$calle=$vue;
			if ($ke=='noExterior')
					$no_ext=$vue;
			if ($ke=='noInterior')
					$no_int=$vue;
			if ($ke=='colonia')
					$colonia=$vue;
			if ($ke=='referencia')
					$referen=$vue;
			if ($ke=='municipio')
					$mun=$vue;
			if ($ke=='estado')
					$estado=$vue;
			if ($ke=='pais')
					$pais=$vue;
			if ($ke=='codigoPostal')
					$cp=$vue;

		}

		foreach ($result['cfdi:Comprobante']['cfdi:Emisor']['attr'] as $ky => $l) {

			if ($ky=='rfc')
					$id_rfc=$l;
			if ($ky=='nombre')
					$rfc_nom=$l;

		}

		foreach ($result['cfdi:Comprobante']['attr'] as $cy => $ll) {

			if ($cy=='fecha')
					$fecha=$ll;
			if ($cy=='subTotal')
					$subtotal=$ll;
			if ($cy=='Moneda')
					$moneda=$ll;
			if ($cy=='total')
					$total=$ll;

		}

		$datos_concepto['id_uuid'] = $id_uuid;
		$datos_concepto['cantidad'] = $datos_concepto_c;
		$datos_concepto['unidad'] = $datos_concepto_u;
		$datos_concepto['descrip'] = $datos_concepto_d;
		$datos_concepto['val_unit'] = $datos_concepto_v;

		$datos_proveedor['id_rfc']= $id_rfc;
		$datos_proveedor['rfc_nom']=$rfc_nom;
		$datos_proveedor['calle'] = $calle;
		$datos_proveedor['no_ext']= $no_ext;
		$datos_proveedor['no_int']= $no_int;
		$datos_proveedor['colonia']= $colonia;
		$datos_proveedor['referen']= $referen;
		$datos_proveedor['mun']= $mun;
		$datos_proveedor['estado']= $estado;
		$datos_proveedor['pais']= $pais;
		$datos_proveedor['cp']= $cp;
		$datos_proveedor['id_uuid']=$id_uuid;

		$datos_factura['id_uuid']=$id_uuid;
		$datos_factura['rfc_nom']= $rfc_nom;
		$datos_factura['fecha']= $fecha;
		$datos_factura['subtotal']= $subtotal;
		$datos_factura['moneda']= $moneda;
		$datos_factura['total']= $total;
		$datos_factura['id_rfc']= $id_rfc;

		// $id_productos=0;
		// $cantidad=0;
		// $noserie=0;

		// $this->b_up_xml_model->productos_data_insert(
		// $id_productos,
		// $cantidad,
 	// $noserie
		// );

		// $this->b_up_xml_model->interno_data_insert(
		// // $id_productos,
		// $precio_venta,
 	// $fecha_venta,
 	// $promocion,
 	// $caracteristicas,
 	// $componente,
 	// $consumible,
 	// $tipo_cambio,
 	// $tipo_moneda
		// );

		$ch=$this->load->view('b_xmlcaso2_view2_mejor',$datos_concepto, $cantidad, TRUE);

		echo $this->x($datos_concepto, $datos_proveedor, $datos_factura, $cont);

}


public function x($datos_concepto, $datos_proveedor, $datos_factura, $cont){

		$igual=$datos_concepto['id_uuid'];
		$consulta = $this->db->query(" SELECT id_uuid FROM concepto; ");

		foreach ($consulta->result_array() as $row){
			if ($row['id_uuid'] === $igual){	
				$boton_retorna=('<br><center>Ya existe este registro en la DB.<br><form name="buttonbar"><input type="button" value="Volver" onClick="history.back()"></form></center>');
 								echo $boton_retorna;
									exit();
			}
		}

		for ($i=0; $i<$cont; $i++){

			 // $this->db->set('id_concepto','1');
			$this->db->set('id_uuid', $datos_concepto['id_uuid']);
			$this->db->set('cantidad', $datos_concepto['cantidad'][$i]);
			$this->db->set('unidad', $datos_concepto['unidad'][$i]);
			$this->db->set('descrip', $datos_concepto['descrip'][$i]);
			$this->db->set('val_unit',$datos_concepto['val_unit'][$i]);
			$this->db->insert('concepto');
			
		} 

		foreach ($consulta->result() as $valu){
  		if ($igual === $valu->id_uuid){
    					echo '<br><br> Ya existe este registro en la DB.<br>'.$valu->id_uuid.'<br>';
    					$this->load->view('pagina_exito_mejor');
 								return( '<br><br> Saliendo del Programa.<br><br>');			
    } 
  }

		$id_rfc=$datos_proveedor['id_rfc'];
		$rfc_nom=$datos_proveedor['rfc_nom'];
		$calle=$datos_proveedor['calle'];
		$no_ext=$datos_proveedor['no_ext'];
		$no_int=$datos_proveedor['no_int'];
		$colonia=$datos_proveedor['colonia'];
		$referen=$datos_proveedor['referen'];
		$mun=$datos_proveedor['mun'];
		$estado=$datos_proveedor['estado'];
		$pais=$datos_proveedor['pais'];
		$cp=$datos_proveedor['cp'];
		$id_uuid=$datos_proveedor['id_uuid'];

			$this->b_up_xml_model->proveedor_data_insert(
			$id_rfc,
			$rfc_nom,
			$calle,
			$no_ext,
			$no_int,
			$colonia,
			$referen,
			$mun,
			$estado,
			$pais,
			$cp,
			$id_uuid
 		);

		$id_uuid=$datos_factura['id_uuid'];
		$rfc_nom=$datos_factura['rfc_nom'];
		$fecha=$datos_factura['fecha'];
		$subtotal=$datos_factura['subtotal'];
		$moneda=$datos_factura['moneda'];
		$total=$datos_factura['total'];
		$id_rfc=$datos_factura['id_rfc'];

			$this->b_up_xml_model->factura_data_insert(
			$id_uuid,
			$rfc_nom,
 		$fecha,
			$subtotal,
 		$moneda,
			$total,
			$id_rfc
 		);

 		

}


public function solicitar2() {

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

	$id_uuid = $this->input->post('id_concepto');
	$cont = $this->input->post('cont_datos_concepto');
	$cantidad_total=$this->input->post();
	$cantidad = $this->input->post('canti');
	$noserie = $this->input->post('noserie');
	$elementos=count($cantidad);

		foreach ($noserie as $key => $value){
			$varx=$value;
		}
			if ($varx == NULL){
				for ($j=0; $j<$elementos; $j++){
					
						$this->form_validation->set_rules('noserie', 'Número de Serie', 'required');
					 echo validation_errors();
								
								if ($this->form_validation->run()==FALSE){
										echo '<br><br>';
										$boton_reg=('<br><center>No puede dejar los campo(s) vacio(s).<br><form name="buttonbar"><input type="button" value="Regresar" onClick="history.back()"></form></center>');
										echo $boton_reg;
										echo '<br><br>';
										$consulta1 = $this->db->query(" SELECT id_productos FROM productos; ");
										$d_ant=$this->db->insert_id($consulta1);
   							$d_antmas1=$d_ant+1;
   							$this->db->delete('productos', array('id_productos' => $d_antmas1));
										exit();
								}
				}
 		}

				if ($varx != NULL ){
					for ($k=0; $k<$elementos; $k++){
										$cantidad = $this->input->post('canti');
										$noserie = $this->input->post('noserie');
										$this->db->set('cantidad', $cantidad[$k]);
										$this->db->set('noserie',$noserie[$k]);
										$this->db->insert('productos');
					}

// ************************************************
//*****		Bloque para traer el id_concepto de la tabla CONCEPTO hacia el registro id_concepto de la tabla PRODUCTOS de acuerdo a la cantidad de registros ingresados por el usuario. ************************

					$consultar_concepto = $this->db->query(" SELECT id_concepto, cantidad FROM concepto; ");
						foreach ($consultar_concepto->result() as $value){

								$dato_de_idconcepto_concepto[]=($value->id_concepto);
								$dato_de_cantidad_concepto[]=($value->cantidad);

								$contando_arreglar=count($dato_de_idconcepto_concepto);

								}

								$consultar_productos = $this->db->query(" SELECT id_productos, cantidad, id_concepto FROM productos; ");
									foreach ($consultar_productos->result() as $value) {

																	$dato_de_cantidad_productos[]=$value->cantidad;
																	$dato_de_idconcepto_productos[]=$value->id_concepto;
																	$dato_de_idproductos[]=$value->id_productos;

																	}

									echo '<br><br>';
									$query_id_antes = $this->db->query(" SELECT id_productos FROM productos; ");
									$d_ant=$this->db->insert_id($query_id_antes);

													for ($e=0; $e<$d_ant; $e++){
														for ($t=0; $t<$contando_arreglar; $t++){

															if($dato_de_cantidad_productos[$e] === $dato_de_cantidad_concepto[$t])

																$id_concepto_pro[$e]=$dato_de_idconcepto_concepto[$t];
														}
													}

																for ($u=0; $u<$d_ant; $u++){

																	$this->db->set('id_concepto',$id_concepto_pro[$u]);

																	$this->db->where('id_productos',$dato_de_idproductos[$u]);

																	$this->db->update('productos', $id_concepto[$u]);
																}

//**************************************************

					$consulta_vacio = $this->db->query(" SELECT noserie FROM productos; ");

							foreach ($consulta_vacio->result_array() as $rw)
							{
					   $evaluar=$rw['noserie'];

									while ($evaluar == NULL) {
										$consulta2 = $this->db->query(" SELECT id_productos FROM productos; ");
										$d_ant2=$this->db->insert_id($consulta2);
   										
   										for ($a=0; $a<$elementos; $a++){
   												$this->db->delete('productos', array('id_productos' => $d_ant2));
   												$d_ant2--;	
   										}
								
										$boton_reg=('<br><center>No puede dejar los campo(s) vacio(s).<br><form name="buttonbar"><input type="button" value="Regresar" onClick="history.back()"></form></center>');
										echo $boton_reg;
										echo '<br><br>';
										exit();
									}
							}
				}				

echo '<br><br>';
	$this->load->view('pagina_exito_mejor');

}



}
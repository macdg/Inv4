<?php

class B_up_xml_model_mejor extends CI_Model {

 public function __construct() {
 parent::__construct();
	$this->load->model('B_up_xml_model_mejor','b_up_xml_model');

}

public function proveedor_data_insert($id_rfc, $rfc_nom, $calle, $no_ext, $no_int, $colonia, $referen, $mun, $estado, 	$pais, $cp, $id_uuid) {

$datos_proveedor=array(
'id_rfc' => 	$id_rfc,
'rfc_nom' =>	$rfc_nom,
'calle' =>	$calle,
'no_ext' =>	$no_ext,
'no_int' =>	$no_int,
'colonia' =>	$colonia,
'referen' =>	$referen,
'mun' =>	$mun,
'estado' =>	$estado,
'pais' =>	$pais,
'cp' =>	$cp,
'id_uuid' => $id_uuid
	);

$this->db->insert('proveedor',$datos_proveedor);

} 

public function factura_data_insert($id_uuid, $rfc_nom, $fecha, $subtotal, $moneda, $total, $id_rfc) {

$datos_factura=array(
'id_uuid'	=> $id_uuid,
'rfc_nom' =>	$rfc_nom,
'fecha' => $fecha,
'subtotal' => $subtotal,
'moneda' => $moneda,
'total' => $total,
'id_rfc' => 	$id_rfc
	);

$this->db->insert('factura',$datos_factura);

}

public function borrando(){

$d_ant=$this->db->insert_id();
echo '<br>Dato Anterior: '.$d_ant. '<br>';

	$id_uuid = $this->input->post('id_concepto');
	$cont = $this->input->post('cont_datos_concepto');
	$cantidad_total=$this->input->post();
	$cantidad = $this->input->post('canti');
	$noserie = $this->input->post('noserie');
	$elementos=count($cantidad);

		for ($j=0; $j<$elementos; $j++){
			$this->db->set('cantidad', $cantidad[$j]);
			$this->db->set('noserie',$noserie[$j]);
 		$this->db->insert('productos');
			}

				echo '<br><br>';
				$this->load->view('pagina_exito');
			 
}




}
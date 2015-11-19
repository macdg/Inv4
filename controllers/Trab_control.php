<?php
class Trab_control extends CI_Controller {

	// function __construct() {
	// 	parent::__construct();
	// }

	function index() {
	}

	function trab() {

		//$dato_img['source_image'] = '/var/www/ci/application/images/estamos-trabajando.jpg';

		$this->load->view('trabajando');

		//$this->load->view('trabajando', $dato_img);
	}
}
?>
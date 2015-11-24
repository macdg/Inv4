<?php $this->load->helper('form'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Vista de Up XML</title>
</head>
<body>
	<hr>
	<br><br>
		<center>
		Elije el archivo XML a subir.
		<br><br><br>
		XML Seleccionado.
		<br>
		<form action="<?php echo 'subiendo_archivo'; ?>" method="post" enctype="multipart/form-data">
		Selecciona el archivo a Subir.
		<br><br><br>
		<input type="file" name="mi_archivo_1" id="m_archivo_1" size="40">
		<br>
		<input type="submit" value="Subir" name="submit">
		<br><br>
		</form>
		</center>
		<br><br><br>
<center>
<form name="buttonbar">
<input type="button" value="Borrar" onClick="location='index'"/>
</form>
</center>
</body>
</html>

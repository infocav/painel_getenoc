  
    <form enctype="multipart/form-data" action="upload.php" method="POST">
	    <!-- MAX_FILE_SIZE deve preceder o campo input -->
	    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
	    <!-- O Nome do elemento input determina o nome da array $_FILES -->
	    Enviar arquivo: <input name="userfile" type="file" />
	    <input type="submit" value="Treinar rede" />
	    <input type="hidden" name="modulo" value="redeN">
	    <input type="hidden" name="view" value="treinamento">
		<input type="hidden" name="action" value="upload">
	    
	    
	</form>

<?php
   print_r($_FILES);
?>
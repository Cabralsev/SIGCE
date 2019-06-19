	<?php
	 session_start();
	  session_destroy(); 
          unset( $_SESSION );
	  header("Location: http://megavirtua.com.br/sigce/Telainicial/");
	?>
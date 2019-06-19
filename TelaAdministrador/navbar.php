<style>
   .profile-pic {
    max-width: 200px;
    max-height: 200px;
    display: block;
    border-radius: 1000px !important;
    margin-left: 60px;
    
}
  .upload-button:hover {
  transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
  color: #999;
}
 
    .carregargif {
    width: 100px;
    height: 100px;
    position: absolute;
    top: 30%;
    left: 45%;
    color: blue;
 }

</style>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark static-top" style="background-color: #1c1c1c">

      <a class="navbar-brand mr-1" href="index.php" style="color: #e5474b; font-family: Arial">SIGCE</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <label class="badge red" style="color: white">Administrador: <?php echo ($_SESSION['NomeUsuario']); ?></label>         
    <div class="md-form form-sm my-0">
      <input class="form-control form-control-sm mr-sm-2 mb-0" type="text" onkeyup="showHint(this.value)" placeholder="Pesquisar" aria-label="Search">
    </div>
    <p><span style="color: white" id="txtHint"></span></p>  
         </div>
      </form>
<script>
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "pesquisa.php?q="+str, true);
        xmlhttp.send();
    }
}
</script>
      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <?php include ("conexao1.php");
        $hoje = date("d-m-Y");
          
          $sql = "SELECT COUNT(idMensagem) AS Mensagens FROM mensagem WHERE mensagem.Data_envio = '".$hoje."'";  
              $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
               while ($record = mysqli_fetch_assoc($resultset)) {
           ?>
        <li class="nav-item dropdown no-arrow mx-1">
         <a class="nav-link dropdown-toggle" href="#">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger"><?php echo $record['Mensagens'];?></span>
         </a>
          <?php } ?>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#perfilModal">Seu Perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
          </div>
        </li>
      </ul>

    </nav> 

    <div class="modal fade right" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-right" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title w-100" id="myModalLabel">Suas Informações:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
      <div class="modal-body mx-3">  
         <?php include ("conexao1.php");

           $q = $_SESSION['UsuarioMatricula'];

          $sql2 = "SELECT * from fotos WHERE Matricula_pessoa = '".$q."'"; 
              $resultset = mysqli_query($conn, $sql2) or die("database error:". mysqli_error($conn));
               while ($record = mysqli_fetch_assoc($resultset)) {
           ?>      
         <div class="small-12 medium-2 large-2 columns">
            <div class="circle">
       <!-- User Profile Image -->
       <?php echo "<img class='profile-pic' src='teste/".$record['nome_arquivo']."'> "; 
        } ?>
          

       <!-- Default Image -->
       <!-- <i class="fa fa-user fa-5x"></i> -->
            </div>
        </div>

         <?php include ("conexao1.php");

           $q = $_SESSION['UsuarioMatricula'];

          $sql1 = "SELECT pessoa.Data_Nascimento , pessoa.Email from pessoa WHERE Matricula = '".$q."'"; 
              $resultset = mysqli_query($conn, $sql1) or die("database error:". mysqli_error($conn));
               while ($record = mysqli_fetch_assoc($resultset)) {
           ?>
        <div class="md-form mb-2">
          <i class="fa fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" class="form-control validate" disabled>
          <label data-error="wrong" data-success="right" for="orangeForm-name"><?php echo ($_SESSION['NomeUsuario']); ?></label>
        </div>
        <div class="md-form mb-2">
          <i class="fa fa-address-card prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" class="form-control validate" disabled>
          <label data-error="wrong" data-success="right" for="orangeForm-pass"><?php echo ($_SESSION['UsuarioMatricula']); ?></label>
        </div>
        <div class="md-form mb-2">
          <i class="fa fa-at prefix grey-text"></i>
          <input type="email" id="orangeForm-email" class="form-control validate" disabled>
          <label data-error="wrong" data-success="right" for="orangeForm-email"><?php echo $record['Email'];?></label>
        </div>
        <?php } ?>
      </div>

        <div class="modal-footer justify-content-center">
          <form method="post" action="inserefoto.php" enctype="multipart/form-data">
            <div class="form-group">
             <label for="arquivo">Trocar Foto de Perfil:</label>
              <input type="file" class="form-control-file" id="arquivo" name="arquivo">
              <input type="submit" style="margin-top: 10px; margin-left: -1px" class="btn btn-primary" value="Atualizar">
            </div>
          </form>
        </div>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>   
      </div>
    </div>
  </div>
 



 <?php 
  require_once("Tela/header.php");
  require_once ("Tela/navbar.php");
  require_once("Tela/sidebar.php");
  
?>


 <style>
.dropbtn {
    background-color: red;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: red;}
</style>
</head>
<body>

<h2>Material de Apoio</h2>
<p>Passe o mouse pelo botão e escolha a turma a receber os arquivos.</p>

<div class="dropdown" style="">
  <button class="dropbtn" style="">Dropdown</button>
  <div class="dropdown-content">
    <a href="#">Turma 1</a>
    <a href="#">Turma 2</a>
    <a href="#">Turma 3</a>
  </div>
</div>


<div class="card mb-3">
  <div class="card-header">
<form action="upload.php" method="post" enctype="multipart/form-data" style="vertical-align: ">Selecione o arquivo:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
           
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2018</span>
            </div>
          </div>
        </footer>

      </div>

<?php
require_once("Tela/footer.php"); 
?>
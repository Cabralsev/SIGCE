<?php include("session.php");?>
<?php 
  require_once("header.php");
  require_once ("navbar.php");
  require_once("sidebar.php");
  
?>
<script src="limparcampos.js"></script>
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Cadastro de Usuário</li>
          </ol>
        
                   
        
        <!-- /.container-fluid -->

<form action = "inserealuno.php" style="padding: 10px" method="POST">
  <fieldset>
      <ol class="breadcrumb">
            <li class="breadcrumb-item active">Informações Pessoais</li>
          </ol>

<label for="matricula"><b>Matrícula</b></label>
    <input type="text" minlength="10" maxlength="10" style="width:120px" onblur="historico(this.value)" class="form-control" placeholder="Matrícula" id="matricula"  name="matricula" required><br>
  <script>
function historico(str) {
    if (str == "") {
        document.getElementById("txtHin").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHin").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","historico.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<div id="txtHin"></div>
  
<SCRIPT>
   /* Executa a requisição quando o campo matricula perder o foco */
   $('#matricula').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_matricula.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'matricula=' + $('#matricula').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    limparcamposaluno();
                        //$('#matricula').val(data.Matricula);
                        $('#nome').val(data.Nome_Completo);
                        $('#email').val(data.Email);
                        $('#cpf').val(data.CPF);
                        $('#datanascimento').val(data.Data_Nascimento);
                        $('#estadocivil').val(data.EstadoCivil)
                        $('#sexo').val(data.Sexo);
                        $('#cep').val(data.CEP);
                        $('#numero').val(data.Numero_endereco);
                        $('#complemento').val(data.Complemento);
                        $('#telefone').val(data.Numero);
                        $('#tipo').val(data.Tipo);
                        $('#status').val(data.Status);
                        $('#celular').val(data.Numero_celular);
                        $('#escolaridade').val(data.Escolaridade);
                        $('#nomeresponsavel').val(data.nome_Responsavel);
                        $('#cpfresponsavel').val(data.CPF_Responsavel);
                        $('#telefoneresponsavel').val(data.Telefone_Responsavel);
                        $('#saida').val(data.Motivo_saida);
                }
           });   
   return false;    
   });

</SCRIPT>



<label for="nome"><b>Nome Completo</b></label>
    <input type="text" class="form-control" placeholder="Digite o Nome completo" name="nome" id="nome" required><br>

<label for="email"><b>Email</b></label>
    <input type="text" class="form-control" placeholder="Digite o Email" name="email" id="email" required>

<label for="cpf"><b>CPF</b></label>
    <input type="text" style= "width: 200px" class="form-control" placeholder="Digite o CPF" id="cpf" maxlength="15" name="cpf" required><br>
    
    <script type="text/javascript">
    $("#cpf").mask("000.000.000-00");
    </script>

    <div class="row" style="padding-left: 10px">
    
   <label style="padding: 5px" for= "datanascimento"><b>Data de Nascimento</b></label>
   <input type="date" class="form-control" id="datanascimento" name="datanascimento" class="form-control" style= "width:180px ">

    <label style="padding: 5px" for="idade">Idade:</label>
    <input type="num" name="idade" id="idade" style="width: 60px" class="form-control" disabled>
  </div>
  <script>
    document.getElementById("datanascimento").addEventListener('change', function() {
  var data = new Date(this.value);
  if(isDate_(this.value) && data.getFullYear() > 1900)
      document.getElementById("idade").value = calculateAge(this.value);
  
  if(document.getElementById("idade").value < 18) {
    document.getElementById("nomeresponsavel").readOnly = false;
    document.getElementById("cpfresponsavel").readOnly = false;
    document.getElementById("telefoneresponsavel").readOnly = false;
  }
  else {
    document.getElementById("nomeresponsavel").readOnly = true;
    document.getElementById("cpfresponsavel").readOnly = true;
    document.getElementById("telefoneresponsavel").readOnly = true;
  }
});

function calculateAge(dobString) {
  var dob = new Date(dobString);
  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  var birthdayThisYear = new Date(currentYear, dob.getMonth(), dob.getDate());
  var age = currentYear - dob.getFullYear();
  if(birthdayThisYear > currentDate) {
    age--;
  }
  return age;
}

function calcular(data) {
  var data = document.form.nascimento.value;
  alert(data);
  var partes = data.split("/");
  var junta = partes[2]+"-"+partes[1]+"-"+partes[0];
  document.form.idade.value = (calculateAge(junta));
}

var isDate_ = function(input) {
        var status = false;
        if (!input || input.length <= 0) {
          status = false;
        } else {
          var result = new Date(input);
          if (result == 'Invalid Date') {
            status = false;
          } else {
            status = true;
          }
        }
        return status;
}
  </script>
  <br>
    
  <label for="estadocivil">Estado Civil</label> 
    <select name = "estadocivil" id="estadocivil">
      <option name ="estadocivil" value="Solteiro">Solteiro</option>
      <option name ="estadocivil" value="Casado">Casado</option>
      <option name ="estadocivil" value="Separado">Separado</option>
      <option name ="estadocivil" value="Divorciado">Divorciado</option>
      <option name ="estadocivil" value="Viuvo">Viúvo(a)</option>
    </select><br> 

 <label for= "telefone"><b>Telefone</b></label>
 <input type="text" style = "width: 200px" class="form-control" placeholder="Apenas números" id="telefone" name="telefone" required>
<script type="text/javascript">
    $("#telefone").mask("(00)0000-0000");
    </script>

 <select name = "tipo" id="tipo">
  <option name ="tipo" value="Residencial">Residencial</option>
  <option name = "tipo" value="Trabalho">Trabalho</option>
  </select>

 <label for= "celular"><b>Celular</b></label>
 <input type="text" style = "width: 200px" class="form-control" placeholder="Apenas números" id="celular" name="celular" required><br>
    <script type="text/javascript">
    $("#celular").mask("(00)00000-0000");
    </script>

  <label>
  <span><b>Informe o sexo:</b> </span>
 <select name="sexo" id="sexo">
  <option value="Masculino"  name="sexo">Masculino</option>
  <option value="Feminino" name="sexo">Feminino</option>
  </select>
  </label><br/>

</fieldset>

<fieldset>
  <ol class="breadcrumb">
            <li class="breadcrumb-item active">Endereço</li>
          </ol>
<label for= "cep"><b>CEP</b></label>
 <input type="text" style = "width: 200px" class="form-control" placeholder="Digite o CEP" id="cep" name="cep">
 <script type="text/javascript">
    $("#cep").mask("00000-000");
    </script>

  <label for= "logradouro"><b>Logradouro</b></label>
 <input type="text" style = "width: 300px" class="form-control" readonly="true" placeholder="Digite o logradouro" id="logradouro" name="logradouro" ></br>

 <label for= "numero"><b>Número</b></label>
 <input type="text" style = "width: 100px" class="form-control" placeholder="000" id="numero" name="numero" required>

 <label for= "complemento"><b>Complemento</b></label>
 <input type="text" style = "width: 300px" class="form-control" placeholder="" id="complemento" name="complemento"><br>

 <label for= "bairro"><b>Bairro</b></label>
 <input type="text" style = "width: 200px" class="form-control" readonly="true" placeholder="" id="bairro" name="bairro" >

 <label for= "cidade"><b>Cidade</b></label>
 <input type="text" style = "width: 200px" class="form-control" readonly="true" placeholder="" id="cidade" name="cidade" >

 <label for= "estado"><b>Estado</b></label>
 <input type="text" style = "width: 50px" class="form-control" readonly="true" placeholder="" id="estado" name="estado" >
</fieldset>

<fieldset>
   <ol class="breadcrumb">
   <li class="breadcrumb-item active">Dados do Aluno</li>
  </ol>


<label for="escolaridade"><b>Escolaridade</b></label>
 <select name="escolaridade" id="escolaridade" onchange="mostrarturmas(this.value)">
  <option value="" name="escolaridade"></option>  
  <option value="Educação infantil" name="escolaridade">Educação infantil</option>
  <option value="Ensino fundamental" name="escolaridade">Ensino fundamental</option>
  <option value="Ensino médio" name="escolaridade">Ensino médio</option>
  <option value="Ensino superior" name="escolaridade">Ensino superior</option>
 </select><br>

<script>
function mostrarturmas(str) {
    if (str == "") {
        document.getElementById("txtHint1").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint1").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","turmasrecomendadas.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<div id="txtHint1"></div>

<label><b>Em caso de desistência do aluno</b></label>
  <input type="text" name="saida" id="saida" readonly class="form-control" style="width: 300px"> 

  
</fieldset>

<ol class="breadcrumb">
            <li class="breadcrumb-item">
              </li>
            <li class="breadcrumb-item active">Aluno menor de idade</li>
          </ol>

<div id = "alunomenor">
<label for="nomeresponsavel"><b>Nome Completo do Responsável</b></label>
    <input type="text" class="form-control" placeholder="Digite o Nome completo" name="nomeresponsavel" id="nomeresponsavel" readonly required><br>

<label for="cpfresponsavel"><b>CPF do Responsável</b></label>
    <input type="text" style= "width: 200px" class="form-control" placeholder="Digite o CPF" id="cpfresponsavel" maxlength="15" name="cpfresponsavel" readonly required><br>
    <script type="text/javascript">
    $("#cpfresponsavel").mask("000.000.000-00");
    </script>

<label for= "Telefoneresponsavel"><b>Telefone do Responsável</b></label>
 <input type="text" style = "width: 200px" class="form-control" placeholder="Apenas números" id="telefoneresponsavel" name="telefoneresponsavel" readonly required><br>
    <script type="text/javascript">
    $("#telefoneresponsavel").mask("(00)00000-0000");
    </script>
</div>


<fieldset>
  <ol class="breadcrumb">
            <li class="breadcrumb-item active">Acesso ao sistema</li>
          </ol>
  <label for = "senha"><b>Senha</b></label>
  <input type="password" name="senha" style = "width: 100px" class="form-control" placeholder="*******" id="senha" name="senha" >
  <label for = "Confirmarsenha"><b>Confirme a Senha</b></label>
  <input type="password" name="senha2" style = "width: 100px" class="form-control" placeholder="*******" id="senha2" ><br>

  <script>
  $(function(){
  $("#submit").click(function(){
      var senha = $("#senha").val();
      var senha2 = $("#senha2").val();
      if(senha != senha2){
        event.preventDefault();
        alert("As senhas não são iguais!");
      }
    });
  });
</script>

<label for="Status"><b>Status</b></label>
  <input type="text" class="form-control" value="Aguardando Turma" style="width: 200px" name="status" id="status" readonly><br>

  <script type="text/javascript">
        function myFunction() {
    var x = document.getElementById("status");
    var defaultVal = x.defaultValue;
    var currentVal = x.value;
    
}
  </script>

  <script>
function ativo(){
    
if (document.getElementById("select_id").value == 'Ativo') {


  if (!confirm("Atenção Sr(a) Administrador \n\nInativando o aluno, o mesmo estará inapto a entrar em outras turmas e se desligará de turmas matriculadas, confirma?"))
                            {
                                $("#select_id").val('Ativo');
                                return false;
                            }
}
}
</script>
</fieldset>

<label for="nivel"><b>Nivel</b></label>
<select name = "nivel">
  <option name ="nivel" value="4">Nivel de Usuario: Aluno</option>
  </select><br>

<div class="row" style="padding-left: 10px">
  <button class="btn btn-primary" type="submit" id="submit">Salvar Dados</button>

</form>

</div>
 <button class="btn btn-warning" data-toggle="modal" data-target="#Inativar">Alterar Status do Aluno</button>
</div>



<div class="modal fade" id="Inativar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form action="alterarstatusaluno.php" method="post">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alterando Status do Aluno</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="Codigoturma"><b>Código do Aluno:</b></label>
              <input style="width: 120px" type="text" id="codigoaluno" maxlength="10" name="codigoaluno" required/><br>
              <label for="Nomealuno"><b>Nome do Aluno:</b></label>
              <input type="text" style="width: 300px" class="form-control" name="nomealuno" id="nomealuno" readonly><br>
              <label for="statusmodal"><b>Status do Aluno:</b></label>
              <input style="width: 300px" type="text" class="form-control" name="statusmodal" id="statusmodal" readonly><br>
              <label><b>Em caso de desistência do aluno</b></label>

            <select name="saida1" id="saida1">
              <option value="" name="saida1">Nenhum</option>  
              <option value="Aluno trancou a Matrícula" name="saida1">Aluno trancou a Matrícula</option>
              <option value="Aluno desistiu do curso por condições financeiras" name="saida1">Aluno desistiu do curso por condições financeiras</option>
              <option value="Aluno desistiu do curso por rendimento insatisfatório" name="saida1">Aluno desistiu do curso por rendimento insatisfatório</option>
              <option value="Outros" name="saida1">Outros</option>
            </select>
            </div>
            <script>
                  /* Executa a requisição quando o campo CEP perder o foco */
                  $('#codigoaluno').blur(function(){
                    /* Configura a requisição AJAX */
                    $.ajax({
                      url : 'consultar_status.php',/* URL que será chamada */ 
                      type : 'POST', /* Tipo da requisição */ 
                      data: 'codigoaluno=' + $('#codigoaluno').val(), /* dado que será enviado via POST */
                      dataType: 'json', /* Tipo de transmissão */
                      
                      success: function(data){
                        limparcampos();
                        $('#statusmodal').val(data.Status);
                        $('#saida1').val(data.Motivo_saida);
                        $('#nomealuno').val(data.Nome_Completo);
                      }
                    });   
                    return false;    
                  });
            </script>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <button type="submit" onclick="return confirm('Atenção Sr(a) Administrador \n\nInativando o aluno, o mesmo passará a ter status INATIVO e deixará de estar matriculado no sistema, o aluno se desligará de qualquer turma vinculado a ele. \n\nConfirma?');" class="btn btn-danger">Alterar Status</button>
            </div>
          </div>
        </div>
      </form>
    </div>
<!-- Extended default form grid -->
<script src='cep.js'></script>  

<?php
require_once("footer.php"); 
?>
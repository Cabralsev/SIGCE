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
        
                   
        </div>
        <!-- /.container-fluid -->

<form action = "insereprofessor.php" style="padding: 10px" method="POST">
  <fieldset>
      <ol class="breadcrumb">
            <li class="breadcrumb-item active">Informações Pessoais</li>
          </ol>
<label for="matricula"><b>Matrícula</b></label>
    <input type="text" minlength="7" maxlength="7" style="width:100px" class="form-control" placeholder="Matrícula" id="matricula"  name="matricula" required><br>
<SCRIPT>
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#matricula').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_matriculaprofessor.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'matricula=' + $('#matricula').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    limparcamposprofessores();
                        //$('#matricula').val(data.Matricula);
                        $('#nome').val(data.Nome_Completo);
                        $('#email').val(data.Email);
                        $('#cpf').val(data.CPF);
                        $('#datanascimento').val(data.Data_Nascimento);
                        $('#sexo').val(data.Sexo);
                        $('#cep').val(data.CEP);
                        $('#numero').val(data.Numero_endereco);
                        $('#complemento').val(data.Complemento);
                        $('#telefone').val(data.Numero);
                        $('#tipo').val(data.Tipo);
                        $('#celular').val(data.Numero_celular);
                        $('#instituicao').val(data.instituicao_formacao);
                        $('#especializacao').val(data.especializacao);
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
    
   <label for= "datanascimento"><b>Data de Nascimento</b></label>
   <input type="date" class="form-control" id="datanascimento" name="datanascimento" class="form-control" style= "width:180px ">
 <br>
    

 <label for= "telefone"><b>Telefone</b></label>
 <input type="text" style = "width: 200px" class="form-control" placeholder="Apenas números" id="telefone" name="telefone">
<script type="text/javascript">
    $("#telefone").mask("(00)0000-0000");
    </script>

 <select name = "tipo">
  <option name ="tipo" value="Residencial">Residencial</option>
  <option name = "tipo" value="Trabalho">Trabalho</option>
  </select>

 <label for= "celular"><b>Celular</b></label>
 <input type="text" style = "width: 200px" class="form-control" placeholder="Apenas números" id="celular" name="celular" ><br>
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
 <input type="text" style = "width: 100px" class="form-control" placeholder="000" id="numero" name="numero" >

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
            <li class="breadcrumb-item active">Dados do Professor</li>
          </ol>
<label for="especializacao"><b>Especialização</b></label>
<input type="text" name="especializacao" id="especializacao" class="form-control"><br>

<label for="instituicao"><b>Instituição de Formação</b></label>
<input type="text" name="instituicao" id="instituicao" class="form-control">

</fieldset>

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
  <select name="status">
  <option value="Ativo" name="status">Ativo</option>
  <option value="Inativado" name="status">Inativado</option>
  </select>

<label for="nivel"><b>Nivel</b></label>
<select name = "nivel">
  <option name ="nivel" value="2">Nivel de Usuario: Professor</option>
  </select>

</fieldset>




  <button type="submit" id="submit">Salvar Dados</button>

</div>

</form>
<!-- Extended default form grid -->
<script src='cep.js'></script>      
<?php
require_once("footer.php"); 
?>
$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#matricula').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_matricula.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'matricula=' + $('#matricula').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#nome').val(data.Nome_Completo);
                        $('#email').val(data.Email);
                        $('#cpf').val(data.CPF);
                        $('#datanascimento').val(data.Data_Nascimento);
                        $('#sexo').val(data.Sexo);
                        $('#cep').val(data.CEP);
 
                        
                    }
                }
           });   
   return false;    
   })
});
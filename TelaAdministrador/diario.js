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
          xmlhttp.open("GET",".php?q="+str,true);
          xmlhttp.send();
        }

        $(document).ready(function() {
         /* Executa a requisição quando o campo CEP perder o foco */
         $('#retornaprofessor').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
            url : 'retornar_professorperiodo.php', /* URL que será chamada */ 
            type : 'POST', /* Tipo da requisição */ 
            data: 'retornaprofessor=' + $('#retornaprofessor').val(), /* dado que será enviado via POST */
            dataType: 'json', /* Tipo de transmissão */
            success: function(data){
              limparcamposnotas();
              $('#professor').val(data.Nome_Completo);
              $('#periodoletivo').val(data.Periodo_Letivo);
              $('#nome_turma').val(data.nome_turma);
              $('#curso').val(data.Tipo);
            }
          });   
           return false;    
         })
       })

      }
<?php	
	include_once("conexao1.php");
	$html = '<style>
				table {
 				border-collapse: collapse;
  				width: 100%;
				}
				th, td {
  				padding: 8px;
  				text-align: left;
  				border-bottom: 1px solid #ddd;
				}
			</style>';
	$html .= '<table border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Nome do Aluno</th>';
    $html .= '<th>CPF</th>';
    $html .= '<th>Email</th>';
    $html .= '<th>Matrícula</th>';
    $html .= '<th>Data de Nascimento</th>';
    $html .= '<th>Escolaridade</th>';
    $html .= '<th>Nome do Responsável</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';

	$result_usuarios = "SELECT pessoa.Nome_Completo , pessoa.CPF , pessoa.Email, pessoa.Data_Nascimento, pessoa.Matricula , aluno.Escolaridade , aluno.nome_Responsavel 
      FROM pessoa
      INNER JOIN aluno ON pessoa.Matricula = aluno.Matricula_pessoa 
      ORDER BY pessoa.Nome_Completo";

    $resultado_usuarios = mysqli_query($conn, $result_usuarios);

      while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){    
   	
   	 $html .= '<tr>';
     $html .=  '<td>'. $row_usuario['Nome_Completo'] . '</td>';
     $html .=  '<td>'. $row_usuario['CPF'] . '</td>';
     $html .=  '<td>'. $row_usuario['Email'] . '</td>';
     $html .=  '<td>'. $row_usuario['Matricula'] . '</td>';
     $html .=  '<td>'. $row_usuario['Data_Nascimento'] . '</td>';
     $html .=  '<td>'. $row_usuario['Escolaridade'] . '</td>';
     $html .=  '<td>'. $row_usuario['nome_Responsavel'] . '</td>';
     $html .=  '</tr>'; 
    } 		
	$html .= '</tbody>';
	$html .= '</table>';

	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();

	$dompdf->set_paper("legal", "landscape");
	// Carrega seu HTML
	$dompdf->load_html('
			<h1 style="text-align: center;">Relatório de Alunos</h1>
			'. $html .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"relatorio_celke.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>
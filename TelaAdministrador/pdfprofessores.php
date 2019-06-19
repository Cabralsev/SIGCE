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
	$html .= '<table border=1>';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Matrícula</th>';
    $html .= '<th>Nome do Professor</th>';
    $html .= '<th>CPF</th>';
    $html .= '<th>Data de Nascimento</th>';
    $html .= '<th>Email</th>';
    $html .= '<th>Especialização</th>';
    $html .= '<th>Instituição de Formação</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';

	 $result_usuarios = "SELECT pessoa.Matricula, pessoa.Nome_Completo, pessoa.CPF, pessoa.Data_Nascimento, pessoa.Email, professor.especializacao, professor.instituicao_formacao
						FROM pessoa
							INNER JOIN professor ON professor.Matricula_pessoa = pessoa.Matricula";

    $resultado_usuarios = mysqli_query($conn, $result_usuarios);

      while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
   
      $html .= '<tr>';
      $html .= '<td>'. $row_usuario['Matricula'] . '</td>';
      $html .= '<td>'. $row_usuario['Nome_Completo'] . '</td>';
      $html .= '<td>'. $row_usuario['CPF'] . '</td>';
      $html .= '<td>'. $row_usuario['Data_Nascimento'] . '</td>';
      $html .= '<td>'. $row_usuario['Email'] . '</td>';
      $html .= '<td>'. $row_usuario['especializacao'] . '</td>';
      $html .= '<td>'. $row_usuario['instituicao_formacao'] . '</td>';
      $html .= '</tr>';
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
			<h1 style="text-align: center;">Relatório de Professores</h1>
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
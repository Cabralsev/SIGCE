<?php 
	include_once("conexao1.php");

	$html = '<table border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Nome do Curso</th>';
    $html .= '<th>Descrição</th>';
    $html .= '<th>Turma Relacionada</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';

	$result_usuarios = "SELECT curso.Tipo, curso.Descricao , nome_turma.nome_turma 
                        FROM curso
                        INNER JOIN nome_turma ON curso.idCurso = nome_turma.idCurso";
    $resultado_usuarios = mysqli_query($conn, $result_usuarios);

      while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
   
     $html .= '<tr>';
     $html .= '<td>'. $row_usuario['Tipo'] . '</td>';
     $html .= '<td>'. $row_usuario['Descricao'] . '</td>';
     $html .= '<td>'. $row_usuario['nome_turma']. '</td>';
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

	// Carrega seu HTML
	$dompdf->load_html('
			<h1 style="text-align: center;">Relatório de Cursos</h1>
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
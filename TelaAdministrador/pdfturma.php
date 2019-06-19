<?php 
	include_once("conexao1.php");
	$html = '<table border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>Código da Turma</th>';
    $html .= '<th>Nome do Professor</th>';
    $html .= '<th>Status</th>';
    $html .= '<th>Período Letivo</th>';
    $html .= '<th>Nível</th>';
    $html .= '<th>Curso</th>';
    $html .= '<th>Turno</th>';
    $html .= '<th>Nome da Turma</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';


$result_usuarios = "SELECT 
                          Codigo as Codigo_Turma, 
                          pessoa.Nome_Completo, 
                          turma.Status as Status_Turma, 
                          Periodo_Letivo, 
                          nivel, 
                          Turno, 
                          nome_turma, 
                          curso.Tipo 
                            FROM 
                              nome_turma 
                                INNER JOIN turma ON idNome = NomeTurma 
                                INNER JOIN curso ON turma.idCurso = curso.idCurso 
                                INNER JOIN pessoa ON turma.Matricula_professor  = pessoa.Matricula 
                                ORDER BY Tipo";

    $resultado_usuarios = mysqli_query($conn, $result_usuarios);

      while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
       
     $html .= '<tr>';
     $html .='<td>'. $row_usuario['Codigo_Turma'] . '</td>';
     $html .= '<td>'. $row_usuario['Nome_Completo'] . '</td>';
     $html .= '<td>'. $row_usuario['Status_Turma'] . '</td>';
     $html .= '<td>'. $row_usuario['Periodo_Letivo'] . '</td>';
     $html .= '<td>'. $row_usuario['nivel'] . '</td>';
     $html .= '<td>'. $row_usuario['Tipo'] . '</td>';
     $html .= '<td>'. $row_usuario['Turno'] . '</td>';
     $html .= '<td>'. $row_usuario['nome_turma'] . '</td>';
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
			<h1 style="text-align: center;">Relatório de Turmas</h1>
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
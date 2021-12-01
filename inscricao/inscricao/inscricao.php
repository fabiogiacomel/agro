<?php
 ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL); 

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sun, 11 Apr 2010 05:00:00 GMT");

ob_start();
session_start();
date_default_timezone_set('America/Sao_Paulo');

$data1 = Date("Y-m-d"); //'2017-06-02' hoje;
$data2 = '2019-10-29'; //data de fim das inscrições

if (strtotime($data1) > strtotime($data2)) {
    //header('Location:inscricaoEncerrada.php');
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inscrição on line</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="../inscricao/css/steps.css">
    <style>
        body{
            background-image: url('../img/bg1.jpg');
        }

    </style>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
<?php
$pagina = "inscricaoInicio.php";
//$pagina= "inscricaoEncerrada.php";
//$pagina= "inscricaoForaAr.php";

//Código para substituir o iframe
if (isset($_GET['pagina'])) {
    switch ($_GET['pagina']) {
        case 'inicio':
            $pagina = "inscricaoInicio.php";
            break;
        case 'dadosBasicos':
            $pagina = "inscricaoDadosBasicos.php";
            break;
        case 'dadosComplementares':
            $pagina = "inscricaoDadosComplementares.php";
            break;
        case 'imprimir':
            $pagina = "inscricaoImprime.php";
            break;
        case 'condensadoRel':
            $pagina = "inscricaoCondensadoRel.php";
            break;
        case 'concluidasPorCurso':
            $pagina = "inscricaoCursoRel.php";
            break;
        case 'pendentesPorCurso':
            $pagina = "inscricaoPendenteCursoRel.php";
            break;
        case 'condensadoTotal':
            $pagina = "inscricaoCondensadoRelAntigo.php";
            break;
        case 'incricoesDia':
            $pagina = "inscricaoDiaRel.php";
            break;
        case 'inscricaoMudouCurso':
            $pagina = "inscricaoMudouCurso.php";
            break;

        default:$pagina = $_GET['pagina'];
    }
}

if (file_exists($pagina)) {
    //if(isset($_GET['cpf'])){
    //  include_once($pagina.'?cpf='.$_GET['cpf']);
    //}else{
    include_once $pagina;
    //}
} else {
    echo "A página não existe:" . $pagina;
    //include_once('admin_home.php');
}
?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        <script src="../inscricao2020/js/steps.js"></script>
	</body>
	</html>

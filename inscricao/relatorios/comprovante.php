<?php
        $servername = "localhost";
        $username = "u224722929_agro";
        $password = 'Lruf9H%$Yo1i';
        $dbname = "u224722929_agro";


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Lista de Classificados</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-2 col-lg-2">
                <img src="https://www.ceepcascavel.com.br/img/ceep_menor.jpg" class="img-fluid rounded"> 
            </div>
            <div class="col-xs-11 col-sm-11 col-md-10 col-lg-10">
                <h3 class="text-left"> Lista de Classificados</h3>
                <h4 class="text-left"> Curso: Técnico Agrícola</h4>
             </div>
        </div>
        </div>
        
        

        <div class="container mt-3">

            <?php
            echo '<table class="table table-striped">';
            echo "<thead> <tr> <th>Classificação</th><th>Nome</th><th>Pontuação</th></tr></thead><tbody>";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT nome, cpf, pontuacao FROM inscricoesnovas WHERE curso=18  ORDER by pontuacao DESC");
                $stmt->execute();

                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $i = 1;
                foreach (new RecursiveArrayIterator($stmt->fetchAll()) as $k => $v) {
                    echo "<tr><td>$i</td><td class=\"text-uppercase\">" . $v["nome"] . "</td><td>" . $v["pontuacao"] . "</td>
					<td><a href=\"https://infoceep.com.br/inscricao/inscricaoImprime.php?cpf=". $v["cpf"]."\">visualizar</a></td>
					
					</tr>";
                    $i++;
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
            echo "</tbody></table>";
            ?>

        </div>
</body>

</html>
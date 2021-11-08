<?php
class Aluno
{

    //Primeira tela inscricaoInicio.php
    private $id;
    private $cpf;
    private $curso;
    private $curso2;
    private $periodo;
    private $periodo2;
    private $serial;

    //Segunda tela inscricaoDadosBasicos.php
    private $cgm;
    private $nome;
    private $rg;
    private $rg_data_expedicao;
    private $datanasc;
    private $email;
    private $fone_casa;
    private $fone_celular;
    private $cidade;
    private $bairro;
    private $rua;
    private $numero;

    private $nome_mae; //Adicionado em 03/05/16 a pedido de Rude

    //Terceira tela inscricaoDadosComplementares.php
    private $renda;
    private $comprovante_renda;

    private $ensinomedio;
    private $ensinofundamental;
    private $abandono;
    private $trabalha_area;
    private $tipo_necessidade;

    private $portugues_n1;
    private $portugues_n2;
    private $portugues_n3;
    private $portugues_n4;

    private $matematica_n1;
    private $matematica_n2;
    private $matematica_n3;
    private $matematica_n4;

    private $quimica_n1;
    private $quimica_n2;
    private $quimica_n3;

    private $biologia_n1;
    private $biologia_n2;
    private $biologia_n3;

    private $media_portugues;
    private $media_matematica;
    private $media_biologia;
    private $media_quimica;
    private $bolsa_familia;
    private $nis; // Número do NIS adicionado em 31/05/2019 a pedido do Rude

    private $instituicao_formacao = 0; //CEEP, Faculdade, outros apenas para o especialização em enfermagem 07/07/2015

    private $escola_origem;
    private $escola_origem_cidade;
    private $escola_origem_estado; //Adicionado em 03/05/16 a pedido de Rude

    //Tela de impressão
    private $pontuacao;
    private $pontuacao_curso2;

    //Data e hora para conferencia do protocolo
    private $datainsc;
    private $dataalteracao;
    private $horainsc;

    //Atributos de controle
    //public static $achou_tabela_antiga; a tabela antiga foi desativada em 17/03/15
    public $achou_tabela_nova;
    public static $instance;

    public function __construct()
    {
        require_once __DIR__.'/../conexao.class.php';
        require_once __DIR__.'/log.php';
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Aluno();
        }
        return self::$instance;
    }

    //Estamos gerando aqui os Get's e Set's
    public function __set($var, $val)
    {
        $this->$var = $val;
    }

    public function __get($var)
    {
        return $this->$var;
    }

    //Método carregar
    public function carregar()
    {
        try {
            $sql = "select * from inscricoesnovas where cpf=:p1";
            GeraLog::getInstance()->log($sql);
            $c = new Conexao();
            $con = $c->prepare($sql);

            $con->bindValue(":p1", preg_replace("/[^0-9]/", "", $this->cpf));
            GeraLog::getInstance()->log(":p1" . preg_replace("/[^0-9]/", "", $this->cpf));

            $con->execute();

            $this->achou_tabela_nova = $con->rowCount() > 0;

            if ($this->achou_tabela_nova) {
                GeraLog::getInstance()->log('achou na tabela nova');
                $result = $con->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $obj) {
                    $this->id = $obj->id;
                    $this->cgm = $obj->cgm;
                    $this->nome = $obj->nome;
                    $this->rg = $obj->rg;
                    $this->rg_data_expedicao = $obj->rg_data_expedicao;
                    $this->cpf = $obj->cpf;
                    //Alterado entrada da data para funcionar em celulares 07/11/2021
                    //$this->datanasc = date("d/m/Y", strtotime($obj->datanasc));

                    $this->datanasc = $obj->datanasc;
                    $this->email = $obj->email;
                    $this->fone_casa = $obj->fonecasa;
                    $this->cidade = $obj->cidade;
                    $this->fone_celular = $obj->fonecelular;
                    $this->bairro = $obj->bairro;
                    $this->rua = $obj->rua;
                    $this->numero = $obj->num_casa;

                    $this->nome_mae = $obj->nome_mae;
                    $this->escola_origem = $obj->escola_origem;
                    $this->escola_origem_cidade = $obj->escola_origem_cidade;
                    $this->escola_origem_estado = $obj->escola_origem_estado;

                    $this->serial = $obj->serial;
                    $this->curso = $obj->curso;
                    $this->curso2 = $obj->curso2;
                    $this->periodo = $obj->periodo;
                    $this->periodo2 = $obj->periodo2;

                    $this->renda = $obj->renda;
                    $this->comprovante_renda = $obj->comprovante_renda;
                    $this->ensinomedio = $obj->ensinomedio;
                    $this->ensinofundamental = $obj->ensinofundamental;
                    $this->abandono = $obj->abandono;
                    $this->media_portugues = $obj->maiorport;
                    $this->media_matematica = $obj->maiormat;
                    $this->media_biologia = $obj->maiorbio;
                    $this->media_quimica = $obj->maiorqui;
                    $this->instituicao_formacao = $obj->instituicao_formacao;
                    $this->trabalha_area = $obj->trabalha_area;
                    $this->bolsa_familia = $obj->bolsa_familia;
                    $this->nis = $obj->nis;
                    $this->tipo_necessidade = $obj->tipo_necessidade;

                    $this->datainsc = $obj->datainsc;
                    $this->dataalteracao = $obj->dataalteracao;
                    $this->horainsc = $obj->horainsc;
                }
            }
        } catch (Exception $e) {
            print "<div id='msg' class='MSG_ERRO' class='MSG_ERRO'>Ocorreu um erro ao carregar dados, foi gerado um LOG do mesmo, tente novamente mais tarde.</div>";
            GeraLog::getInstance()->inserirLog("Erro:ALUNOCLASS::CARREGAR: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

  /*  public function carregarCelem()
    {
        try {
            $sql = "select * from inscricoescelem where cpf=:p1";
            GeraLog::getInstance()->log($sql);
            $con = $c = new Conexao();
            $con = $c->prepare($sql);

            $con->bindValue(":p1", preg_replace("/[^0-9]/", "", $this->cpf));
            GeraLog::getInstance()->log(":p1" . preg_replace("/[^0-9]/", "", $this->cpf));

            $con->execute();

            $this->achou_tabela_nova = $con->rowCount() > 0;

            if ($this->achou_tabela_nova) {
                GeraLog::getInstance()->log('achou na tabela nova');
                $result = $con->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $obj) {
                    $this->id = $obj->id;
                    $this->cgm = $obj->cgm;
                    $this->nome = $obj->nome;
                    $this->rg = $obj->rg;
                    $this->rg_data_expedicao = $obj->rg_data_expedicao;
                    $this->cpf = $obj->cpf;
                    $this->datanasc = $obj->datanasc;
                    $this->email = $obj->email;
                    $this->fone_casa = $obj->fonecasa;
                    $this->fone_celular = $obj->fonecelular;
                    // $this->cidade = $obj->cidade;
                    // $this->bairro = $obj->bairro;
                    // $this->rua = $obj->rua;
                    // $this->numero = $obj->num_casa;

                    $this->nome_mae = $obj->nome_mae;
                    // $this->escola_origem = $obj->escola_origem;
                    // $this->escola_origem_cidade = $obj->escola_origem_cidade;
                    // $this->escola_origem_estado = $obj->escola_origem_estado;

                    $this->serial = $obj->serial;
                    $this->curso = $obj->curso;
                    $this->curso2 = $obj->curso2;
                    $this->periodo = $obj->periodo;
                    $this->periodo2 = $obj->periodo2;

                    // $this->renda = $obj->renda;
                    // $this->ensinomedio = $obj->ensinomedio;
                    // $this->ensinofundamental = $obj->ensinofundamental;
                    // $this->abandono = $obj->abandono;
                    // $this->media_portugues  = $obj->maiorport;
                    // $this->media_matematica = $obj->maiormat;
                    // $this->instituicao_formacao = $obj->instituicao_formacao;
                    // $this->trabalha_area = $obj->trabalha_area;
                    // $this->tipo_necessidade = $obj->tipo_necessidade;

                    $this->datainsc = $obj->datainsc;
                    $this->horainsc = $obj->horainsc;
                }
            }
        } catch (Exception $e) {
            print "<div id='msg' class='MSG_ERRO'>Ocorreu um erro ao carregar dados, foi gerado um LOG do mesmo, tente novamente mais tarde.</div>";
            GeraLog::getInstance()->inserirLog("Erro:ALUNOCLASS::CARREGAR: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }*/

    public function consultarInscricao($curso)
    {
        try {
            $sql = "select * from inscricoescelem where cpf=:p1 and curso=:p2";
            GeraLog::getInstance()->log($sql);
            $con = $c = new Conexao();        $con = $c->prepare($sql);

            $con->bindValue(":p1", preg_replace("/[^0-9]/", "", $this->cpf));
            $con->bindValue(":p2", $curso)
            ;

            $con->execute();

            return $con->rowCount() > 0;
        } catch (Exception $e) {
            GeraLog::getInstance()->inserirLog("Erro:ALUNOCLASS::Consultar inscricao: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }
//ALTER TABLE `inscricoesnovas` ADD `instituicao_formacao` INT NOT NULL ;07/07/2015

//Adicionados mais dois campos a pedido de Rudy Just
    //    ALTER TABLE `inscricoesnovas` ADD `trabalha_area` INT NULL DEFAULT '0' , ADD `tipo_necessidade` INT NULL DEFAULT '0' ;
    //ALTER TABLE `inscricoesantigas` ADD `trabalha_area` INT NULL DEFAULT '0' , ADD `tipo_necessidade` INT NULL DEFAULT '0' ;
    public function atualizar()
    {
        try {
            $sql = "update inscricoesnovas set cgm=:p1, nome=:p2, rg=:p3,
			datanasc=:p5,	email=:p6, fonecasa=:p7, cidade=:p8,
			fonecelular=:p9,bairro=:pA, rua=:pB, num_casa=:pC,
			curso=:pD, periodo=:pE,curso2=:pD2, periodo2=:pE2, serial=:pF, dataalteracao=:pG, horainsc=:pH,
			instituicao_formacao=:pI, trabalha_area=:pJ, tipo_necessidade=:pK, nome_mae=:pL, escola_origem=:pM, escola_origem_cidade=:pN, escola_origem_estado=:pO, rg_data_expedicao=:pP
			 where cpf=:p0";

            $con = $c = new Conexao();        
            $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->cgm);
            $con->bindValue(":p2", $this->nome);
            $con->bindValue(":p3", $this->rg);
            $con->bindValue(":p5", $this->datanasc);
            $con->bindValue(":p6", $this->email);
            $con->bindValue(":p7", $this->fone_casa);
            $con->bindValue(":p8", $this->cidade);
            $con->bindValue(":p9", $this->fone_celular);
            $con->bindValue(":pA", $this->bairro);
            $con->bindValue(":pB", $this->rua);
            $con->bindValue(":pC", $this->numero);
            $con->bindValue(":pD", $this->curso);
            $con->bindValue(":pD2", $this->curso2);
            $con->bindValue(":pE", $this->periodo);
            $con->bindValue(":pE2", $this->periodo2);
            $con->bindValue(":pF", $this->serial);

            $data_inscricao = Date("Y-m-d");
            $con->bindValue(":pG", $data_inscricao);
            $horainsc = Date("H:i:s");
            $con->bindValue(":pH", $horainsc);
            $con->bindValue(":pI", $this->instituicao_formacao);

            //Adicionado em 22/09/15 a pedido de Rudy Just
            $con->bindValue(":pJ", $this->trabalha_area);
            $con->bindValue(":pK", $this->tipo_necessidade);

            $con->bindValue(":pL", $this->nome_mae);
            $con->bindValue(":pM", $this->escola_origem);
            $con->bindValue(":pN", $this->escola_origem_cidade);
            $con->bindValue(":pO", $this->escola_origem_estado);
            $con->bindValue(":pP", $this->rg_data_expedicao);

            $con->bindValue(":p0", $this->cpf);

            $resposta = $con->execute();
            return $resposta;
        } catch (Exception $e) {
            print "<div id='msg' class='MSG_ERRO'>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</div>";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

   /* public function salvarCelem()
    {
        try {
            $sql = "insert into inscricoescelem (cgm, nome, rg, cpf,datanasc, email, fonecasa, fonecelular, curso, periodo, serial, datainsc, horainsc, nome_mae)values (:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:pA,:pB,:pC,:pD,:pE)";

//echo $sql . " curso ".$this->curso;

            $con = $c = new Conexao();        $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->cgm);
            $con->bindValue(":p2", $this->nome);
            $con->bindValue(":p3", $this->rg);
            $con->bindValue(":p4", $this->cpf);
            $con->bindValue(":p5", $this->datanasc);
            $con->bindValue(":p6", $this->email);
            $con->bindValue(":p7", $this->fone_casa);
            $con->bindValue(":p8", $this->fone_celular);
// $con->bindValue(":pA",    $this->bairro);
            // $con->bindValue(":pB",    $this->rua);
            // $con->bindValue(":pC",    $this->numero);
            $con->bindValue(":p9", $this->curso);
            $con->bindValue(":pA", $this->periodo);
            $con->bindValue(":pB", $this->serial);

            $data_inscricao = Date("Y-m-d");
            $con->bindValue(":pC", $data_inscricao);
            $horainsc = Date("H:i:s");
            $con->bindValue(":pD", $horainsc);
            $con->bindValue(":pE", $this->nome_mae);

            $resposta = $con->execute();

            return $resposta;
        } catch (Exception $e) {
            print "<div id='msg' class='MSG_ERRO'>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</div>";
            GeraLog::getInstance()->inserirLog("Erro: ALUNOCLASS::SALVAR_CELEM Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }*/

    public function salvar()
    {
        try {
            $sql = "insert into inscricoesnovas (cgm, nome, rg, cpf,datanasc, email, fonecasa, cidade, fonecelular,bairro, rua, num_casa, curso, curso2, periodo, periodo2, serial, datainsc, horainsc, nome_mae, escola_origem, escola_origem_cidade, escola_origem_estado, rg_data_expedicao)values (:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:pA,:pB,:pC,:pD,:pD2,:pE,:pE2,:pF,:pG,:pH,:pI,:pJ,:pK,:pL,:pM)";

            $con = $c = new Conexao();        
            $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->cgm);
            $con->bindValue(":p2", $this->nome);
            $con->bindValue(":p3", $this->rg);
            $con->bindValue(":p4", $this->cpf);
            //Convertendo a data para salvar no banco
            $con->bindValue(":p5", $this->datanasc);
            //$con->bindValue(":p5", date("Y-m-d", strtotime($this->datanasc)));
            $con->bindValue(":p6", $this->email);
            $con->bindValue(":p7", $this->fone_casa);
            $con->bindValue(":p8", $this->cidade);
            $con->bindValue(":p9", $this->fone_celular);
            $con->bindValue(":pA", $this->bairro);
            $con->bindValue(":pB", $this->rua);
            $con->bindValue(":pC", $this->numero);
            $con->bindValue(":pD", $this->curso);
            $con->bindValue(":pD2", $this->curso2);
            $con->bindValue(":pE", $this->periodo);
            $con->bindValue(":pE2", $this->periodo2);
            $con->bindValue(":pF", $this->serial);

            $data_inscricao = Date("Y-m-d");
            $con->bindValue(":pG", $data_inscricao);
            $horainsc = Date("H:i:s");
            $con->bindValue(":pH", $horainsc);
            $con->bindValue(":pI", $this->nome_mae);
            $con->bindValue(":pJ", $this->escola_origem);
            $con->bindValue(":pK", $this->escola_origem_cidade);
            $con->bindValue(":pL", $this->escola_origem_estado);
            $con->bindValue(":pM", $this->rg_data_expedicao);
            

//$con->bindValue(":pI",    $instituicao_formacao);

//$con->bindValue(":pJ",    $trabalha_area);
            //$con->bindValue(":pK",    $tipo_necessidade);

            $resposta = $con->execute();

/* if(!$this->achou_tabela_antiga){
$sql = "insert into inscricoesantigas (cgm, nome, rg, cpf, datanasc,
email, fonecasa, cidade, fonecelular,bairro, rua, num_casa, datainsc, horainsc, nome_mae, escola_origem, escola_origem_cidade, escola_origem_estado)
values (:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:pA,:pB,:pC,:pG,:pH,:pI,:pJ,:pK,:pL)";

$con = $c = new Conexao();        $con = $c->prepare($sql);

$con->bindValue(":p1",  $this->cgm);
$con->bindValue(":p2",    $this->nome);
$con->bindValue(":p3",    $this->rg);
$con->bindValue(":p4",    $this->cpf);
$con->bindValue(":p5",    $this->datanasc);
$con->bindValue(":p6",    $this->email);
$con->bindValue(":p7",    $this->fone_casa);
$con->bindValue(":p8",    $this->cidade);
$con->bindValue(":p9",    $this->fone_celular);
$con->bindValue(":pA",    $this->bairro);
$con->bindValue(":pB",    $this->rua);
$con->bindValue(":pC",    $this->numero);

$data_inscricao = Date("Y-m-d");
$con->bindValue(":pG",    $data_inscricao);
$horainsc = Date("H:i:s");
$con->bindValue(":pH",    $horainsc);
$con->bindValue(":pI",    $this->nome_mae);
$con->bindValue(":pJ",    $this->escola_origem);
$con->bindValue(":pK",    $this->escola_origem_cidade);
$con->bindValue(":pL",    $this->escola_origem_estado);

// $con->bindValue(":pI",    $instituicao_formacao);
// $con->bindValue(":pJ",    $trabalha_area);
// $con->bindValue(":pK",    $tipo_necessidade);

$con->execute();
} */
            return $resposta;
        } catch (Exception $e) {
            print "<div id='msg' class='MSG_ERRO'>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</div>";
            GeraLog::getInstance()->inserirLog("Erro: ALUNOCLASS::SALVAR Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function salvarPontuacao()
    {
        try {
            $sql = "update inscricoesnovas set pontuacao=:p1, pontuacao_curso2=:p2 where cpf=:p0";

            GeraLog::getInstance()->log($sql . " - " . $this->pontuacao . " Pontuação do curso 2 - " . $this->pontuacao_curso2 . " - ". $this->cpf);

            $con = $c = new Conexao();        
            
            $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->pontuacao);
            $con->bindValue(":p2", $this->pontuacao_curso2);

            $con->bindValue(":p0", $this->cpf);

            $resposta = $con->execute();

            return $resposta;
        } catch (Exception $e) {
            print "<div id='msg' class='MSG_ERRO'>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</div>";
            GeraLog::getInstance()->inserirLog("Erro: SALVAR_PONTUACAO Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }
    public function recalcularNotas()
    {
        try {
            GeraLog::getInstance()->log('recalcular notas iniciando update');

            $sql = "update inscricoesnovas set maiorport={$this->media_portugues}, maiormat={$this->media_matematica},  maiorqui={$this->media_quimica}, maiorbio={$this->media_biologia} where cpf={$this->cpf}";

            GeraLog::getInstance()->log('salvarDadosComplementares por CPF');

            $con = $c = new Conexao();        $con = $c->prepare($sql);

            // $con->bindValue(":p1",    $this->media_portugues);//echo $this->media_portugues;
            // $con->bindValue(":p2",    $this->media_matematica);//echo $this->media_matematica;
            // $con->bindValue(":p3",    $this->media_quimica);//echo $this->media_biologia;
            // $con->bindValue(":p4",    $this->media_biologia);//echo $this->media_quimica;

            // $con->bindValue(":p0",    $this->cpf);
            GeraLog::getInstance()->log('recalcular p0 = CPF: ' . $this->cpf);

            GeraLog::getInstance()->log("SQL = $sql");
            $resposta = $con->execute();
            return $resposta;
        } catch (Exception $e) {
            print "<div id='msg' class='MSG_ERRO'>Recalcular nota: Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</div>";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }
    public function salvarDadosComplementares()
    {
        try {
            GeraLog::getInstance()->log('salvarDadosComplementares iniciando update');

            $sql = "update inscricoesnovas set ensinomedio=:p1, ensinofundamental=:p2,
		renda=:p3, abandono=:p4, maiorport=:p5, maiormat=:p6,  maiorqui=:p7, maiorbio=:p8,instituicao_formacao=:p9,
		trabalha_area=:pa, tipo_necessidade=:pb,bolsa_familia=:pc, comprovante_renda=:pd,
		matematica_n1=:pe,matematica_n2=:pf,matematica_n3=:pg,matematica_n4=:ph,
		portugues_n1=:pi,portugues_n2=:pj,portugues_n3=:pk,portugues_n4=:pl,
		biologia_n1=:pm,biologia_n2=:pn,biologia_n3=:po,
		quimica_n1=:pp,quimica_n2=:pq,quimica_n3=:pr,nis=:ps
		where cpf=:p0";

            GeraLog::getInstance()->log('salvarDadosComplementares por CPF');

            $c = new Conexao();
            $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->ensinomedio); //echo $this->ensinomedio;
            $con->bindValue(":p2", $this->ensinofundamental); //echo $this->ensinofundamental;
            $con->bindValue(":p3", $this->renda); //echo $this->renda;
            $con->bindValue(":p4", $this->abandono); //echo $this->abandono;
            $con->bindValue(":p5", $this->media_portugues);
            echo $this->media_portugues;
            $con->bindValue(":p6", $this->media_matematica);
            echo $this->media_matematica;
            $con->bindValue(":p7", $this->media_quimica);
            echo $this->media_biologia;
            $con->bindValue(":p8", $this->media_biologia);
            echo $this->media_quimica;
            $con->bindValue(":p9", $this->instituicao_formacao);
            $con->bindValue(":pa", $this->trabalha_area);
            $con->bindValue(":pb", $this->tipo_necessidade);
            $con->bindValue(":pc", $this->bolsa_familia);
            $con->bindValue(":pd", $this->comprovante_renda);

            $con->bindValue(":pe", $this->matematica_n1);
            $con->bindValue(":pf", $this->matematica_n2);
            $con->bindValue(":pg", $this->matematica_n3);
            $con->bindValue(":ph", $this->matematica_n4);

            $con->bindValue(":pi", $this->portugues_n1);
            $con->bindValue(":pj", $this->portugues_n2);
            $con->bindValue(":pk", $this->portugues_n3);
            $con->bindValue(":pl", $this->portugues_n4);

            $con->bindValue(":pm", $this->biologia_n1);
            $con->bindValue(":pn", $this->biologia_n2);
            $con->bindValue(":po", $this->biologia_n3);

            $con->bindValue(":pp", $this->quimica_n1);
            $con->bindValue(":pq", $this->quimica_n2);
            $con->bindValue(":pr", $this->quimica_n3);
            $con->bindValue(":ps", $this->nis);

            $con->bindValue(":p0", $this->cpf);
            GeraLog::getInstance()->log('p0 = CPF' . $this->cpf);

            //GeraLog::getInstance()->log("SQL = $sql");
            $resposta = $con->execute();
            return $resposta;
        } catch (Exception $e) {
            print "<div id='msg' class='MSG_ERRO'>Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.</div>";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

/*Inicio dos relatórios

public function consultaAlunosAntigos()
{
try {
$sql = "select DISTINCT  id,(nome), rg, cpf, fonecasa, fonecelular, email, cidade, bairro, concat(rua,' N° ',num_casa) as rua FROM inscricoesantigas GROUP BY nome ORDER BY nome";

//echo $sql;
$con = $c = new Conexao();        $con = $c->prepare($sql);
//$con->bindValue(":p1", $this->descricao);
$con->execute();
$result = $con->fetchAll(PDO::FETCH_OBJ);
return $result;
} catch (Exception $e) {
print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
GeraLog::getInstance()->inserirLog("Erro: ALUNO::consultaAlunosAntigos(): Mensagem: " . $e->getMessage());
}
}*/

  /*  public function consultaInscricoesCondensadoAntigo()
    {
        try {
            $sql = "select inscricoesnovas.curso, inscricoesnovas.serial, inscricoesnovas.periodo, count(inscricoesnovas.curso) AS total from inscricoesnovas group by inscricoesnovas.curso, inscricoesnovas.serial,  inscricoesnovas.periodo";
            //echo $sql;
            $con = $c = new Conexao();        $con = $c->prepare($sql);
            //$con->bindValue(":p1", $this->descricao);
            $con->execute();
            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: ALUNO::consultaInscricoesCondensadoAntigo: Mensagem: " . $e->getMessage());
        }
    }*/

    public function consultaInscricoesCondensado()
    {
        try {
            $sql = "select inscricoesnovas.curso, inscricoesnovas.curso2, inscricoesnovas.serial, inscricoesnovas.periodo, inscricoesnovas.periodo2, count(inscricoesnovas.curso) AS total from inscricoesnovas  where inscricoesnovas.datainsc < '2020-11-30' and inscricoesnovas.pontuacao > 0 and inscricoesnovas.curso > 0 group by inscricoesnovas.curso, inscricoesnovas.serial,  inscricoesnovas.periodo";
            //echo $sql;
            $con = $c = new Conexao();        $con = $c->prepare($sql);
            //$con->bindValue(":p1", $this->descricao);
            $con->execute();
            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: ALUNO::consultaInscricoesCondensado: Mensagem: " . $e->getMessage());
        }
    }

    //Cadastro de reserve
    public function consultaInscricoesCondensado2()
    {
        try {
            $sql = "select inscricoesnovas.curso,inscricoesnovas.curso2, inscricoesnovas.serial, inscricoesnovas.periodo, inscricoesnovas.periodo2, count(inscricoesnovas.curso) AS total from inscricoesnovas  where (inscricoesnovas.datainsc > '2019-11-03' or inscricoesnovas.dataalteracao > '2019-06-23') and inscricoesnovas.pontuacao > 0 and inscricoesnovas.curso > 0 group by inscricoesnovas.curso, inscricoesnovas.serial,  inscricoesnovas.periodo";
            //echo $sql;
            $con = $c = new Conexao();        $con = $c->prepare($sql);
            //$con->bindValue(":p1", $this->descricao);
            $con->execute();
            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: ALUNO::consultaInscricoesCondensado: Mensagem: " . $e->getMessage());
        }
    }

    public function consultaTodosIncompletos()
    {
        try {
            $sql = "select inscricoesnovas.* from inscricoesnovas where pontuacao = 0 or pontuacao is null group by cpf order by curso, periodo";
            //echo $sql;
            $con = $c = new Conexao();        $con = $c->prepare($sql);

            $con->execute();

            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: ALUNO::consultaInscricoesCondensado: Mensagem: " . $e->getMessage());
        }
    }

    public function consultaIncompletos()
    {
        try {
            $sql = "select inscricoesnovas.* from inscricoesnovas where (pontuacao = 0 or pontuacao is null) and serial=:p1 and periodo=:p2 and curso=:p3 group by cpf order by pontuacao desc";
            //echo $sql;
            $con = $c = new Conexao();        $con = $c->prepare($sql);
            //$con->bindValue(":p1", $this->descricao);
            $con = $c = new Conexao();        $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->serial);
            $con->bindValue(":p2", $this->periodo);
            $con->bindValue(":p3", $this->curso);

            $con->execute();

            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: ALUNO::consultaInscricoesCondensado: Mensagem: " . $e->getMessage());
        }
    }

    public function excluirconsultaTodosIncompletos()
    {
        try {
            $sql = "select inscricoesnovas.* from inscricoesnovas where (pontuacao = 0 or pontuacao is null) group by cpf order by pontuacao desc";
            //echo $sql;
            $con = $c = new Conexao();        $con = $c->prepare($sql);
            $con = $c = new Conexao();        $con = $c->prepare($sql);
            $con->execute();

            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: ALUNO::consultaInscricoesCondensado: Mensagem: " . $e->getMessage());
        }
    }

    public function consultaInscricoesDia()
    {
        try {
            $sql = "select date(inscricoesnovas.datainsc) as data, count(inscricoesnovas.id) AS total from inscricoesnovas  where inscricoesnovas.pontuacao > 0 and inscricoesnovas.curso > 0 group by date(inscricoesnovas.datainsc)";
            //echo $sql;
            $con = $c = new Conexao();        $con = $c->prepare($sql);
            //$con->bindValue(":p1", $this->descricao);
            $con->execute();
            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: ALUNO::consultaInscricoesDia: Mensagem: " . $e->getMessage());
        }
    }

    public function consultaInscricoesCurso()
    {
        try {
            $sql = "(select count(inscricoesnovas.id) AS total from inscricoesnovas  where inscricoesnovas.pontuacao > 0  group by inscricoesnovas.curso) union (select count(inscricoesnovas.id) AS total from inscricoesnovas  where inscricoesnovas.pontuacao > 0  group by inscricoesnovas.curso2)";
            //echo $sql;
            $con = $c = new Conexao();        $con = $c->prepare($sql);
            //$con->bindValue(":p1", $this->descricao);
            $con->execute();
            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: ALUNO::consultaInscricoesCURSO: Mensagem: " . $e->getMessage());
        }
    }


    public function consultaClassificacaoGeral(){
        try {

            $cursos = array(
                1 => "Administração",
                2 => "Eletrônica",
                3 => "Eletromecânica",
                4 => "Enfermagem",
                5 => "Informática",
                6 => "Meio Ambiente",
                7 => "Segurança do Trabalho",
                9 => "Edificações",
                10 => "Especialização Técnica em Enfermagem do Trabalho",
            );
            $classificacao = array();
            $con = $c = new Conexao(); 
            foreach ($cursos as $key => $value) {
            $sql = "Select *
            from
            (
               select inscricoesnovas.* from inscricoesnovas 
            where pontuacao > 0 and serial=:p1 and periodo=1 and curso=:p3 and datainsc <= '2019-11-03' group by cpf 
              Union
              select inscricoesnovas.* from inscricoesnovas 
            where pontuacao > 0 and serial=:p1 and periodo2=1 and curso2=:p3 and datainsc <= '2019-11-03' group by cpf 
            ) results
            order by pontuacao desc";

            $sql2= "Select *
            from
            (
               select inscricoesnovas.* from inscricoesnovas 
            where pontuacao > 0 and serial=:p1 and periodo=2 and curso=:p3 and datainsc <= '2019-11-03' group by cpf 
              Union
              select inscricoesnovas.* from inscricoesnovas 
            where pontuacao > 0 and serial=:p1 and periodo2=2 and curso2=:p3 and datainsc <= '2019-11-03' group by cpf 
            ) results
            order by pontuacao desc";

            $sql3= "Select *
            from
            (
               select inscricoesnovas.* from inscricoesnovas 
            where pontuacao > 0 and serial=:p1 and periodo=3 and curso=:p3 and datainsc <= '2019-11-03' group by cpf 
              Union
              select inscricoesnovas.* from inscricoesnovas 
            where pontuacao > 0 and serial=:p1 and periodo2=3 and curso2=:p3 and datainsc <= '2019-11-03' group by cpf 
            ) results
            order by pontuacao desc";
                   
            $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->serial);
            $con->bindValue(":p3", $key);

            $con->execute();
            $result = $con->fetchAll(PDO::FETCH_OBJ);

            $con2 = $c->prepare($sql2);

            $con2->bindValue(":p1", $this->serial);
            $con2->bindValue(":p3", $key);

            $con2->execute();
            $result2 = $con2->fetchAll(PDO::FETCH_OBJ);

            $con3 = $c->prepare($sql3);

            $con3->bindValue(":p1", $this->serial);
            $con3->bindValue(":p3", $key);

            $con3->execute();
            $result3 = $con3->fetchAll(PDO::FETCH_OBJ);

            $classificacao[$key][1] = $result;
            $classificacao[$key][2] = $result2;
            $classificacao[$key][3] = $result3;
            }
            return $classificacao;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: USUARIO::LISTAUSUARIO: Mensagem: " . $e->getMessage());
        }
    }


    public function consultaByCurso()
    {
        try {
            // $sql = "select inscricoesnovas.* from inscricoesnovas where pontuacao > 0 and serial=:p1 and periodo=:p2 and curso=:p3 and datainsc <= '2016-11-20' order by pontuacao desc";
            $sql = "Select *
            from
            (
               select inscricoesnovas.* from inscricoesnovas 
            where pontuacao > 0 and serial=:p1 and periodo=:p2 and curso=:p3 and datainsc <= '2020-11-30' group by cpf 
              Union
              select inscricoesnovas.* from inscricoesnovas 
            where pontuacao > 0 and serial=:p4 and periodo2=:p5 and curso2=:p6 and datainsc <= '2020-11-30' group by cpf 
            ) results
            order by pontuacao desc";
            //echo $sql;
            $con = $c = new Conexao();        
            
            $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->serial);
            $con->bindValue(":p2", $this->periodo);
            $con->bindValue(":p3", $this->curso);
            $con->bindValue(":p4", $this->serial);
            $con->bindValue(":p5", $this->periodo);
            $con->bindValue(":p6", $this->curso);

            $con->execute();

            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: USUARIO::LISTAUSUARIO: Mensagem: " . $e->getMessage());
        }
    }

    public function consultaByCursoDia()
    {
        try {
            $sql = "select inscricoesnovas.* from inscricoesnovas where pontuacao > 0 and datainsc=:p1 group by cpf order by pontuacao desc";
            //echo $sql;
            $con = $c = new Conexao();        $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->datainsc);

            $con->execute();

            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: USUARIO::LISTA_POR_DIA: Mensagem: " . $e->getMessage());
        }
    }

    /*public function consultaCelemByCurso()
    {
        try {
            $sql = "select inscricoescelem.* from inscricoescelem where curso=:p3 order by id asc";

            //echo $sql;
            $con = $c = new Conexao();        $con = $c->prepare($sql);

            $con->bindValue(":p3", $this->curso);

            $con->execute();

            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: USUARIO::LISTAUSUARIO: Mensagem: " . $e->getMessage());
        }
    }*/

    /*public function consultaReservaByCurso()
    {
        try {
            $sql = "select inscricoesnovas.* from inscricoesnovas where pontuacao > 0 and serial=:p1 and periodo=:p2 and curso=:p3 and datainsc >= '2016-11-20' order by id asc";

            $con = $c = new Conexao();        $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->serial);
            $con->bindValue(":p2", $this->periodo);
            $con->bindValue(":p3", $this->curso);

            $con->execute();

            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: USUARIO::LISTAUSUARIO: Mensagem: " . $e->getMessage());
        }
    }*/

    public function consultaByCursoData()
    {
        try {
            //$sql = "select inscricoesnovas.* from inscricoesnovas where pontuacao > 0 and serial=:p1 and (periodo=:p2 or periodo2=:p2) and (curso=:p3 or curso2=:p3) and (inscricoesnovas.datainsc > '2019-11-03' or inscricoesnovas.dataalteracao > '2019-11-03') order by pontuacao desc";
            $sql = "Select *
            from
            (
               select inscricoesnovas.* from inscricoesnovas 
            where pontuacao > 0 and serial=:p1 and periodo=:p2 and curso=:p3 and datainsc > '2019-11-03' group by cpf 
              Union
              select inscricoesnovas.* from inscricoesnovas 
            where pontuacao > 0 and serial=:p4 and periodo2=:p5 and curso2=:p6 and datainsc > '2019-11-03' group by cpf 
            ) results
            order by pontuacao desc";
            //echo $sql;
            $con = $c = new Conexao();
            $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->serial);
            $con->bindValue(":p2", $this->periodo);
            $con->bindValue(":p3", $this->curso);

            $con->bindValue(":p4", $this->serial);
            $con->bindValue(":p5", $this->periodo);
            $con->bindValue(":p6", $this->curso);

            $con->execute();

            //echo "TTOLA:". $con->rowCount();

            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro:" .  $e->getMessage();
            GeraLog::getInstance()->inserirLog("Erro: USUARIO::LISTAUSUARIO: Mensagem: " . $e->getMessage());
        }
    }

   /* public function consultaPendentesByCurso()
    {
        try {
            $sql = "select inscricoesnovas.* from inscricoesnovas where pontuacao <= 0 and serial=:p1 and periodo=:p2 and curso=:p3 order by pontuacao desc";
            //$sql = "select inscricoesnovas.* from inscricoesnovas where pontuacao > 0 and serial=:p1 and periodo=:p2 and curso=:p3 group by cpf order by pontuacao ";
            $con = $c = new Conexao();        $con = $c->prepare($sql);

            $con->bindValue(":p1", $this->serial);
            $con->bindValue(":p2", $this->periodo);
            $con->bindValue(":p3", $this->curso);

            $con->execute();

            $result = $con->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: USUARIO::LISTAUSUARIO: Mensagem: " . $e->getMessage());
        }
    }*/

}

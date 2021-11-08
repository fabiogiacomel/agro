<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="funcoes.js"></script>
<style>
  label{width: 150px; display: inline-block;}
  label.clear{width: auto;}
  .aviso{background-color: yellow;}
  label.umquarto{width: 120px;}
  input[type="text"]{width: 500px;}
  select{width: 503px;}
  
  input[type="text"].meio  {width: 245px;}
  input[type="text"].umquarto{width: 122px;}
  input[type="text"].tresquarto{width: 370px;}


  form{width: 800px;background-color: red; margin:0 auto;}
</style>
<body>
<center>
<div id="pageheader">
    <img border=0 src='../inscricao2020/images/pageheader.png'>
</div>
</center>
  <form name="forminscricoes" method="post" onsubmit="" id="forminscricoes" action="">
    <h1>Formulário de Inscrição</h1>
    <label>Matricula/CGM:</label>
    <input class="tfield" maxlength="20" name="cgm" value="" type="text" OnKeyPress="">
    Exclusivo para o integrado<br />

    <label>Nome:</label>
    <input class="tfield" maxlength="80" name="nome" value="" type="text"  OnKeyPress=""><br />
  
    <label>RG:</label>
    <input class="tfield meio" maxlength="12" name="rg" value="" type="text"  OnKeyPress="">

    <label class="clear umquarto">Orgão Expedidor:</label>
    <input class="tfield umquarto" maxlength="6" name="uf" value="" type="text" OnKeyPress=""><br />
    
    <label>CPF:</label>
    <input class="tfield" onKeyUp="numerocpf(this)" maxlength="12" name="cpf" value="" type="text"  OnKeyPress="">
    CPF deverá ser do próprio candidato Obrigatoriamente<br />

<!--
    <label>Data de Nasc: </label>
    <input class="tfield" onKeyPress="mascaranasc(event, this)" maxlength="10" name="datanasc" value="" type="text" OnKeyPress="">
    DD/MM/AAAA<br />
-->


    <label>Email:</label>
    <input class="tfield" maxlength="40" name="email" value="" type="text" OnKeyPress=""><br />


    <label>Fone Casa:</label>
    <input class="tfield umquarto" maxlength="10" placeholder="DDD" name="fonecasa" value="" type="text"  OnKeyPress="mascarafone(event, this)">
    <input class="tfield tresquarto" onKeyUp="numerocpf(this)" maxlength="3" name="dddcasa" value="" type="text" style="width:40" OnKeyPress="">
    <br />

    <label>Fone Celular:</label>
    <input class="tfield umquarto" maxlength="10" placeholder="DDD" name="fonecelular" value="" type="text" OnKeyPress="mascarafone(event, this)">
    <input class="tfield tresquarto" onKeyUp="numerocpf(this)" maxlength="3" name="dddcelular" value="" type="text" style="width:40" OnKeyPress="">
    <br />

    <label>Cidade:</label>
    <input class="tfield" maxlength="20" name="cidade" value="" type="text" OnKeyPress="">
    <br />

    <label>Bairro:</label>
    <input class="tfield" maxlength="20" name="bairro" value="" type="text" OnKeyPress="">
    <br />

    <label>Rua:</label>
    <input class="tfield meio" maxlength="25" name="rua" value="" type="text" OnKeyPress="">
    

    <label  class="umquarto">No.</label>
    <input class="tfield umquarto" maxlength="4" name="num_casa" value="" type="text" OnKeyPress="">
    <br />


    <label>Modalidade:</label>
    <select class="tfield" name="serial" onChange="valida_periodo()">
      <option value="0" selected="1">Organização do curso</option>
      <option value="1">Integrado</option>
      <option value="2">Subsequente</option>
    </select>
    <br />

    <label>Período:</label>
    <select class="tfield" id="periodo" name="periodo" onChange="valida_curso()">
      <option value="0" selected="1">Selecione um Período</option>
    </select><br />
    
    <label>Curso:</label>
    <select class="tfield" id="curso" name="curso" onChange="">
      <option value="0">Selecione o curso</option>
    </select><br />
    

    <h2>Em qual rede cursou o Ensino Fundamental e Médio?</h2>

    <label>Ensino Médio</label>
    <select class="tfield" name="ensinomedio" onChange="">
      <option value="0" selected="1">Selecione</option>
      <option value="1">Todo em Rede Pública</option>
      <option value="2">Todo em Rede Particular</option>
      <option value="3">Parcial na Rede Pública (Máximo 1 ano Rede Particular)</option>
      <option value="4">Parcial na Rede Pública (Máximo 2 ano Rede Particular)</option>
      <option value="5">Bolsista Integral da Rede Particular</option>
    </select><br />


    <label>Ensino Fundamental:</label>
    <select class="tfield" name="ensinofundamental" onChange="">
      <option value="0" selected="1">Selecione</option>
      <option value="1">Todo em Rede Pública</option>
      <option value="2">Todo em Rede Particular</option>
      <option value="3">Parcial na Rede Pública (Máximo 1 ano Rede Particular)</option>
      <option value="4">Bolsista Integral da Rede Particular</option>
      <option value="5">Parcial na Rede Pública (Máximo 2 anos Rede Particular)</option>
    </select><br />


    <h2>Some a renda total da casa e divida pelo número de pessoas</h2>
    <label>Renda Média Familiar:</label>
    <select class="tfield" name="renda" onChange="">
      <option value="0">Selecione uma opção</option>
      <option value="1">R$ 0,00 até 1 (um) Salário Mínimos</option>
      <option value="2">Acima de 1 (um) até 2 (dois) Salários Mínimos</option>
      <option value="3">Acima de 2 (dois) Salários Mínimos</option>
    </select><br />
    
    <h2>Já desistiu de algum curso nesta Instituição?</h2>
    <label>Abandono de Curso</label>
    <select class="tfield" name="abandono" onChange="">
      <option value="0" selected="1">Responda</option>
      <option value="1">Não</option>
      <option value="2">Sim</option>
    </select><br />

    <div class="aviso">
      SUBSEQUENTE = Se você está cursando ou terminou o Ensino Médio (antigo 2º Grau) digite as notas de 
      Língua Portuguesa e Matemática do Histórico  Escolar a partir da 5a série até a 3a série do Ensino Médio, caso não concluiu ainda a 3a série
       do Ensino Médio, solicite suas notas no Colégio em que está cursando.</div>
    <div class="aviso">Caso você concluiu o Ensino Fundamental e/ou Médio na modalidade EJA/SUPLETIVO
      e no seu histórico escolar não constar a quantidade de notas solicitadas para os campos no ato da inscrição, favor
      repetir a nota em todos os campos.
    </div>  

    <br />
    Digite abaixo as notas de cada Disciplina/Série<br />
    
    <label class="umquarto">5a Série / 6° Ano..:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,2)" id="virtport6" name="virtport6" value="" type="text" OnKeyPress="">
    <label class="umquarto">6a Série / 7° Ano..:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,2)" id="virtport7" name="virtport7" value="" type="text" OnKeyPress="">
    <label class="umquarto">7a Série / 8° Ano..:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,2)" id="virtport8" name="virtport8" value="" type="text" OnKeyPress="">
    <label class="umquarto">8a Série / 9° Ano..:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,2)" id="virtport0" name="virtport0" value="" type="text" OnKeyPress="">
    <br />
    <!--<label class="umquarto">1° Ano.:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,2)" id="virtport1" name="virtport1" value="" type="text" OnKeyPress="">
    <label class="umquarto">2° Ano.:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,2)" id="virtport2" name="virtport2" value="" type="text" OnKeyPress="">
-->
    <label class="umquarto">3° Ano.:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,2)" id="virtport3" name="virtport3" value="" type="text" OnKeyPress="">
    <br />

    <label class="umquarto">Língua Portuguesa:</label>
    <input class="tfield_disabled  umquarto" maxlength="4" onClick="Calc_Med_Pt()" id="maiorport" name="maiorport" value="0" type="text"  OnKeyPress="" readonly="1">
    <---- Clique aqui após preencher TODAS AS NOTAS ACIMA para calcular a média de português<br />
    

    <label class="umquarto">5a Série / 6° Ano..:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,1)" id="virtmat6" name="virtmat6" value="" type="text" OnKeyPress="">
    <label class="umquarto">6a Série / 7° Ano..:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,1)" id="virtmat7" name="virtmat7" value="" type="text" OnKeyPress="">
    <label class="umquarto">7a Série / 8° Ano..:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,1)" id="virtmat8" name="virtmat8" value="" type="text" OnKeyPress="">
    <label class="umquarto">8a Série / 9° Ano..:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,1)" id="virtmat0" name="virtmat0" value="" type="text" OnKeyPress="">
    <br />
    <!--<label class="umquarto">1° Ano.:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,1)" id="virtmat1" name="virtmat1" value="" type="text" OnKeyPress="">
    <label class="umquarto">2° Ano.:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,1)" id="virtmat2" name="virtmat2" value="" type="text" OnKeyPress="">
-->
    <label class="umquarto">3° Ano.:</label>
    <input class="tfield umquarto" maxlength="4" onKeyUp="somentenumero(this,1)" id="virtmat3" name="virtmat3" value="" type="text" OnKeyPress="">
    <br />

    <label class="umquarto">Matemática:</label>
    <input class="tfield_disabled  umquarto" maxlength="4" onClick="Calc_Med_Mt()" id="maiormat" name="maiormat" value="0" type="text" OnKeyPress="" readonly="1">
    <---- Clique aqui após preencher TODAS AS NOTAS ACIMA para calcular a média de matemática<br />

    <input class="tfield" id="concordo" onChange="valida_concorda()" name="concordo" value="1" type="checkbox">
    Li e concordo com o edital de abertura das inscrições<br />


    <input class="tfield_disabled" id="action2" name="action2" type="button" value="Continuar" disabled="1" onclick="document.getElementById('forminscricoes').action='?class=inscricaoPrint&method=onContinuar';document.getElementById('forminscricoes').submit()">
  </form>
</html>

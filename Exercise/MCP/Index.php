<?php
//Campos inseridos para Buscar conexão com Banco de Dados
  $pdv = $_GET['pdv'];
  $host = $_GET['host'];

//Apesar fazer conexão se houve informação Inserida
if (isset($_GET['pdv'])){

//Atributos para conectar no Banco de Dados
define('DB_NAME'        , "GWPDV$pdv");
require_once "Conexao.php";

//Conectar no Banco de Dados
  $Conexao    = Conexao::getConnection();

//Query para verificar se todas NFC-e estão enviadas para Nuvem
  $query      = $Conexao->query("select MCP_DATLOTENV_1 from CAIXAGERAL where MCP_DATLOTENV_1 is null");
  $produtos   = $query->fetchAll();
  $nfcependente = count($produtos);

//Query para NFC-e pendente para ser Enviada para Sefaz
  $sqlcontingencia	= "SELECT * FROM NFCE WHERE SITUACAO = 'N'";
  $querycontingencia  = $Conexao->query($sqlcontingencia);
  $nfcecontingencia   = $querycontingencia->fetchAll();
  $contingencia       = count($nfcecontingencia);

//Querry para fazer Upload das NFC-e para Nuvem
  $sqlupload	= "SELECT * FROM NFCE WHERE REENVIAR = 'S'";
  $queryupload = $Conexao->query($sqlupload);
  $nfceupload   = $queryupload->fetchAll();
  $upload       = count($nfceupload);

//Querry para fazer Upload das NFC-e para Nuvem
$sqldata	= "SELECT * FROM CAIXAGERAL WHERE DATA < '2000-01-01'";
$querydata = $Conexao->query($sqldata);
$nfcedata  = $querydata->fetchAll();
$data       = count($nfcedata);

}
?>

 <!-- Formulário para Inserir Configuração do Banco de Dados -->

<html>
<head>
<title> Consulta de NFC-e </title>
</head>
<body>
<h3>Pesquisa</h3><br>
<div id="area">
<form id="formulario" name="Cadastros" action="index.php" method="GET">
<label>Caixa:</label>
<input type="tel" name="pdv" maxlength='2' class="configpdv" value="<?php echo $pdv; ?>"></br></br>
<input type="submit">
<input type="button" value="Atualizar" onClick="history.go(0)"> 
</form>
</div>

 <!-- Resultado das Pendencias -->
<html>
 <body>
 <?php
//Resultados que serão apresentados
if (isset($nfcependente) && isset($contingencia) && isset($upload) && isset($data)) {
if ($nfcependente == 0) { 
  $nfcependente = "Nenhuma pendência!";
}
if ($contingencia == 0) {
  $contingencia = "Nenhuma pendência!";
}
if ($upload == 0) {
  $upload = "Nenhuma pendência!";
}
if ($data == 0) {
  $data = "Nenhuma pendência!";
}
}
        echo "NFC-e faltando no MCP: ".$nfcependente."<br>";
        echo "NFC-e no Contingência: ".$contingencia."<br>";
        echo "NFC-e faltando Upload: ".$upload."<br>";
        echo "NFC-e corrompido: ".$data."<br>";
              // if ($upload > 0) {
              // echo "(Realizar Upload no MCP)";
 ?>
</body>
</html>
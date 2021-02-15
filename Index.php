<?php
//Configuração dos GET
    $get_descricao = $_GET['DESCRICAO'];
    $get_barra = $_GET['BARRA'];
    $atual=$_GET['atual'];

//Variavéis para Paginazação
    $min = ($atual - 0);
    $limite = 20;
    $max = $limite + $atual;  
    $next = $atual + $limite;
    $back = $atual - $limite;

//Configuração das Query do Banco de Dados
  require_once "Conexao.php";
    $Conexao = Conexao::getConnection();

  if (empty($get_barra)) {
    $sqlcount = "SELECT COUNT(*) as total FROM PRODUTOS WHERE DESCRICAO LIKE '%$get_descricao%'";
    $sql = "SELECT * FROM
    (SELECT ROW_NUMBER() OVER ( ORDER BY CODPROD ) AS RowNum, *
    FROM PRODUTOS WHERE DESCRICAO LIKE '%$get_descricao%')
    AS RowConstrainedResult
    WHERE   RowNum > $min
    AND RowNum <= $max order by DESCRICAO";
  }
  else {
    $sqlcount = "SELECT COUNT(*) as total FROM PRODUTOS WHERE BARRA = '$get_barra'";
    $sql = "SELECT * FROM
    (SELECT ROW_NUMBER() OVER ( ORDER BY CODPROD ) AS RowNum, *
    FROM PRODUTOS WHERE BARRA = '$get_barra')
    AS RowConstrainedResult
    WHERE   RowNum > $min
    AND RowNum <= $max order by DESCRICAO";
  }
  if (isset($get_barra) && ($get_barra)) {
    $sqlcount = "SELECT COUNT(*) as total FROM PRODUTOS WHERE BARRA = '$get_barra' and  DESCRICAO LIKE '%$get_descricao%'";
    $sql = "SELECT * FROM
    (SELECT ROW_NUMBER() OVER ( ORDER BY CODPROD ) AS RowNum, *
    FROM PRODUTOS WHERE BARRA = '$get_barra' and  DESCRICAO LIKE '%$get_descricao%')
    AS RowConstrainedResult
    WHERE   RowNum > $min
    AND RowNum <= $max order by DESCRICAO";
  }
    $result = $Conexao->query($sqlcount);
    $data = $result -> fetch(PDO::FETCH_ASSOC);
    $query = $Conexao->query($sql);
    $consulta = $query->fetchAll();
?>

 <!-- Pesquisar pela descrição -->
<html>
  <head>
    <link href="css/estilo.css" rel="stylesheet">
    <script src="JAVASCRIPETO.js"></script>
    <title>Pesquisar Produtos</title>
  </head>
 <body>
  <form name="Pesquisa" action="index.php" method="GET">
    <label>Descrição do Produto:</label>
     <input type="text" name="DESCRICAO" ></br></br>
    <label>Código de Barra:</label>
     <input type="text" name="BARRA">
    <input type="submit">
  </form>
 <!-- Tabela de Resultados -->
 <table border="1" class="responsive-table">
  <tr>
    <th width="1em">CÓDIGO DE BARRA</th>
    <th>DESCRIÇÃO</th>
    <th width="1em">PREÇO VENDA</th>
    <th>ESTOQUE</th>
  </tr>

<?php
 //Buscar retorno dos resultados
  foreach ($consulta as $produto) {
    $codinterno = $produto['CODPROD'];
    $barra = $produto['BARRA'];
    $descricao = $produto['DESCRICAO'];
    $preco_unit = $produto['PRECO_UNIT'];
    $estoque = $produto['ESTOQUE'];
    $preco = number_format($preco_unit, 2, ',', '.');
    $est = number_format($estoque, 3, ',', '.');

    echo "<tr>";
    echo "<td>".$barra."</td>";
    echo "<td>".$descricao."</td>";
    echo "<td class='preco'>"."R$ ".$preco."</td>";
    echo "<td style='text-align:center;'>".$est."</td>";
    echo "</tr>";
  }
    echo "</table>";

 // Paginação com Botão de Next para visualizar de 40 em 40.
    $page_name="index.php";

  if ($max > $data['total']) {
    $max = $data['total'];
  }

//Botão de Voltar página
    echo "</td><td align='left' width='30%'>";
  if($back >= 0) {
    print "<a href='$page_name?atual=$back&DESCRICAO=$get_descricao'>
    <font face='Verdana' size='2'>Voltar página</font></a>";
}
    echo "Mostrando ".($min+1)." a ".$max." de ".$data['total'];

    echo "</td><td align='right' width='30%'>";

//Botão de Próxima página
  if($data['total'] > $next) {
    print "<a href='$page_name?atual=$next&DESCRICAO=$get_descricao'>
    <font face='Verdana'
    size='2'>Próxima Página</font></a>";}
?>
</body>
</html>
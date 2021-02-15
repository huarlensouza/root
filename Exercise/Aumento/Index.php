<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $salario = $_POST['salario'];
        $anos = $_POST['anos'];
    
    if ($anos >= '5') {
    $perc_sup = '20';
    $maior = ($salario+($salario*($perc_sup/100)));
    $bonusmaior = ($salario*($perc_sup/100));
        echo "Valor total do novo salário com aumento é de "."<b>R$ ".$maior."</b></br>";
        echo "O valor do bônus aumentado é de "."<b>R$ ".$bonusmaior."</b></br>";
    }    
    if ($anos < '5') {
    $perc_inf = '10';
    $menor = ($salario+($salario*($perc_inf/100)));
    $bonusmenor = ($salario*($perc_inf/100));
    
    echo "Valor total do novo salário com aumento é de "."<b>R$ ".$menor."</b></br>";
    echo "O valor do bônus aumentado é de "."<b>R$ ".$bonusmenor."</b></br>";
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<form name="empresa" acntion="exerc3.php" method="POST">

<textarea name="textarea" rows="4" cols="74" disabled>
O aumento do salário será de 20% para funcionários com tempo de trabalho
na empresa igual ou superior a 5 anos.
O aumento do salário será de 10% para funcionários com tempo de trabalho
na empresa inferior a 5 anos.</textarea></br></br>
<div>
    <label>Digite o valor do salário atual:</label>
    <input type="number" name="salario" id="salario" value="<?php echo $salario; ?>">
    <label>Quantidade de anos trabalhado na Empresa:</label>
    <input type="number" name="anos" id="anos" value="<?php echo $anos; ?>">
    <input type="submit" class="enviar enviar-vd">

</div>

</html>
</body>
</form>

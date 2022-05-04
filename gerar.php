<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="automatico"> <!– classe para deixar margens automáticas –>
        <div id="print">
            <input type="button" id="imprimir" value="Imprimir" />
        </div>

        <div id="recibo" class="printable confiPrint">
            <div class="t-vale">
                <h2>VALE</h2>
                <div class="num-vale">
                    <p>N° <?php echo $_POST["numero"]; ?>
        <div id="num"></div></p>
                    <b>R$ <p id="val"></p></b>
                </div>
            </div>
            <br>
            <div class="dados">
                <b>NOME:</b> <p id="nom"></p>
                <b>VALOR:</b> R$: <p id="valo"></p> 
                <b>LOCAL/DATA:</b> <p id="cid-data"></p></p><br>
            </div>
            <div class="assinatura">
                <p>Assinatura</p>
            </div>
            1° via empresa
            <div class="dados-empresa">
                <p id="dadosEmp"></p>
            </div>
            
        </div>

        <div id="recibo2" class="printable confiPrint">
            <div class="t-vale">
                <h2>VALE</h2>
                <div class="num-vale">
                    <p>N° <div id="num2"></div></p>
                    <b>R$ <p id="val2"></p></b>
                </div>
            </div>
            <br>
            <div class="dados">
                <b>NOME:</b> <p id="nom2"></p>
                <b>VALOR:</b> R$: <p id="valo2"></p> 
                <b>LOCAL/DATA:</b> <p id="cid-data2"></p></p><br>
            </div>
            <div class="assinatura">
                <p>Assinatura</p>
            </div>
            2° via cliente
            <div class="dados-empresa">
                <p id="dadosEmp2"></p>
            </div>
            
        </div>
    </div>
</body>
</html>
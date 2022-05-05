<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador vale</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="automatico"> <!– classe para deixar margens automáticas –> 
        <div id="print">
            <input type="button" id="imprimir" value="Imprimir" />
        </div>

        <?php
            $numero= $_POST["numero"];
            $valor= $_POST["valor"];
            $nome=$_POST["nome"];
            $cidade=$_POST["cidade"];
            $data=$_POST["data"];
            $dadosEmpresa=$_POST["dadosEmpresa"];

            $erro = false;
            if ( ( ! isset( $numero) || ! is_numeric( $numero ) ) && !$erro ) {
                $erro = "O número deve ser um valor numérico.";
                echo $erro;
            } 
        ?>

        <div id="recibo" class="printable confiPrint">
            <div class="t-vale">
                <h2>VALE</h2>
                <div class="num-vale">
                    <p>N° 
                        <?php 
                            echo $numero; 
                        ?>
                    </p>

                    <b>R$ <p id="val">
                        <?php
                            echo $valor;
                        ?>
                    </p></b>
                </div>
            </div><br>
    
            <div class="dados">
                <b>NOME:</b> <p id="nom">
                    <?php
                        echo $nome;
                    ?>
                </p>
                <b>VALOR:</b> R$: <p id="valo">
                    <?php 
                        echo $valor;
                    ?>
                </p> 
                <b>LOCAL/DATA:</b> <p id="cid-data"></p>
                    <?php 
                        echo $cidade;
                        echo $data;
                    ?>
                </p><br>
            </div>
            <div class="assinatura">
                <p>Assinatura</p>
            </div>
            1° via empresa
            <div class="dados-empresa">
                <p id="dadosEmp">
                    <?php 
                        echo $dadosEmpresa;
                    ?>
                </p>
            </div>
        </div>

        <div id="recibo2" class="printable confiPrint">
            <div class="t-vale">
                <h2>VALE</h2>
                <div class="num-vale">
                    <p>N° <div id="num2">
                        <?php 
                            echo $numero; 
                        ?>
                    </div></p>
                    <b>R$ <p id="val2">
                        <?php 
                            echo $valor; 
                        ?>
                    </p></b>
                </div>
            </div>
            <br>
            <div class="dados">
                <b>NOME:</b> <p id="nom2">
                    <?php 
                        echo $nome; 
                    ?>
                </p>
                <b>VALOR:</b> R$: <p id="valo2">
                    <?php 
                        echo $valor; 
                    ?>
                </p> 
                <b>LOCAL/DATA:</b> <p id="cid-data2">
                    <?php 
                        echo $cidade;
                        echo $data;
                    ?>
                </p></p><br>
            </div>
            <div class="assinatura">
                <p>Assinatura</p>
            </div>
            2° via cliente
            <div class="dados-empresa">
                <p id="dadosEmp2">
                    <?php 
                        $dadosEmpresa=$_POST["dadosEmpresa"];
                        echo $dadosEmpresa;
                    ?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
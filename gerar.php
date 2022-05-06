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
    <script src="script.js" defer> </script>
</head>

<body>
    <div class="automatico">
        <!– classe para deixar margens automáticas –>
            <div id="print">
                <input type="button" id="imprimir" value="Imprimir" onClick="window.print()" />
            </div>

            <?php
            $numero = $_POST["numero"];
            $valor = $_POST["valor"];
            $nome = $_POST["nome"];
            $cidade = $_POST["cidade"];
            $data = $_POST["data"];
            $dadosEmpresa = $_POST["dadosEmpresa"];

            $erro = false;
            if ((!isset($numero) || !is_numeric($numero)) && !$erro) {
                $erro = "O número deve ser um valor numérico.";
                echo $erro;
            }

            function convert_number_to_words($number)
            {

                $hyphen      = '-';
                $conjunction = ' e ';
                $separator   = ', ';
                $negative    = 'menos ';
                $decimal     = ' ';
                $dictionary  = array(
                    0                   => 'zero',
                    1                   => 'um',
                    2                   => 'dois',
                    3                   => 'três',
                    4                   => 'quatro',
                    5                   => 'cinco',
                    6                   => 'seis',
                    7                   => 'sete',
                    8                   => 'oito',
                    9                   => 'nove',
                    10                  => 'dez',
                    11                  => 'onze',
                    12                  => 'doze',
                    13                  => 'treze',
                    14                  => 'quatorze',
                    15                  => 'quinze',
                    16                  => 'dezesseis',
                    17                  => 'dezessete',
                    18                  => 'dezoito',
                    19                  => 'dezenove',
                    20                  => 'vinte',
                    30                  => 'trinta',
                    40                  => 'quarenta',
                    50                  => 'cinquenta',
                    60                  => 'sessenta',
                    70                  => 'setenta',
                    80                  => 'oitenta',
                    90                  => 'noventa',
                    100                 => 'cento',
                    200                 => 'duzentos',
                    300                 => 'trezentos',
                    400                 => 'quatrocentos',
                    500                 => 'quinhentos',
                    600                 => 'seiscentos',
                    700                 => 'setecentos',
                    800                 => 'oitocentos',
                    900                 => 'novecentos',
                    1000                => 'mil',
                    1000000             => array('milhão', 'milhões'),
                    1000000000          => array('bilhão', 'bilhões'),
                    1000000000000       => array('trilhão', 'trilhões'),
                    1000000000000000    => array('quatrilhão', 'quatrilhões'),
                    1000000000000000000 => array('quinquilhão', 'quinquilhões')
                );

                if (!is_numeric($number)) {
                    return false;
                }

                if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
                    // overflow
                    trigger_error(
                        'O Gerador de Vale só aceita números entre ' . PHP_INT_MAX . ' à ' . PHP_INT_MAX,
                        E_USER_WARNING
                    );
                    return false;
                }

                if ($number < 0) {
                    return $negative . convert_number_to_words(abs($number));
                }

                $string = $fraction = null;

                if (strpos($number, '.') !== false) {
                    list($number, $fraction) = explode('.', $number);
                }

                switch (true) {
                    case $number < 21:
                        $string = $dictionary[$number];
                        break;
                    case $number < 100:
                        $tens   = ((int) ($number / 10)) * 10;
                        $units  = $number % 10;
                        $string = $dictionary[$tens];
                        if ($units) {
                            $string .= $conjunction . $dictionary[$units];
                        }
                        break;
                    case $number < 1000:
                        $hundreds  = floor($number / 100) * 100;
                        $remainder = $number % 100;
                        $string = $dictionary[$hundreds];
                        if ($remainder) {
                            $string .= $conjunction . convert_number_to_words($remainder);
                        }
                        break;
                    default:
                        $baseUnit = pow(1000, floor(log($number, 1000)));
                        $numBaseUnits = (int) ($number / $baseUnit);
                        $remainder = $number % $baseUnit;
                        if ($baseUnit == 1000) {
                            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[1000];
                        } elseif ($numBaseUnits == 1) {
                            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit][0];
                        } else {
                            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit][1];
                        }
                        if ($remainder) {
                            $string .= $remainder < 100 ? $conjunction : $separator;
                            $string .= convert_number_to_words($remainder);
                        }
                        break;
                }

                if (null !== $fraction && is_numeric($fraction)) {
                    $string .= $decimal;
                    $words = array();
                    foreach (str_split((string) $fraction) as $number) {
                        $words[] = $dictionary[$number];
                    }
                    $string .=  " reais e " . implode(' ', $words) . " centavos";
                }

                return $string;
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
                    <b>NOME:</b>
                    <p id="nom">
                        <?php
                        echo $nome;
                        ?>
                    </p>
                    <b>VALOR:</b> R$: <p id="valo">
                        <?php
                        echo convert_number_to_words($valor);

                        ?>
                    </p>
                    <b>LOCAL/DATA:</b>
                    <p id="cid-data">
                        <?php
                            echo $cidade.", ";
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
                        <p>N°
                        <div id="num2">
                            <?php
                            echo $numero;
                            ?>
                        </div>
                        </p>
                        <b>R$ <p id="val2">
                                <?php
                                echo $valor;
                                ?>
                            </p></b>
                    </div>
                </div>
                <br>
                <div class="dados">
                    <b>NOME:</b>
                    <p id="nom2">
                        <?php
                        echo $nome;
                        ?>
                    </p>
                    <b>VALOR:</b> R$: <p id="valo2">
                        <?php
                        echo convert_number_to_words($valor);
                        ?>
                    </p>
                    <b>LOCAL/DATA:</b>
                    <p id="cid-data2">
                        <?php
                        echo $cidade;
                        echo $data;
                        ?>
                    </p>
                    </p><br>
                </div>
                <div class="assinatura">
                    <p>Assinatura</p>
                </div>
                2° via cliente
                <div class="dados-empresa">
                    <p id="dadosEmp2">
                        <?php
                        $dadosEmpresa = $_POST["dadosEmpresa"];
                        echo $dadosEmpresa;
                        ?>
                    </p>
                </div>
            </div>
    </div>
</body>

</html>
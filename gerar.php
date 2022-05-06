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

            class clsTexto {
    
                public static function valorPorExtenso( $valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false )
                {
 
                    $valor = self::removerFormatacaoNumero( $valor );
            
                    $singular = null;
                    $plural = null;
            
                    if ( $bolExibirMoeda )
                    {
                        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
                        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
                    }
                    else
                    {
                        $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
                        $plural = array("", "", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
                    }
            
                    $c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
                    $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
                    $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezessete", "dezoito", "dezenove");
                    $u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
            
            
                    if ( $bolPalavraFeminina )
                    {
                    
                        if ($valor == 1) 
                        {
                            $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
                        }
                        else 
                        {
                            $u = array("", "um", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
                        }
                        
                        
                        $c = array("", "cem", "duzentas", "trezentas", "quatrocentas","quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");
                        
                        
                    }
            
            
                    $z = 0;
            
                    $valor = number_format( $valor, 2, ".", "." );
                    $inteiro = explode( ".", $valor );
            
                    for ( $i = 0; $i < count( $inteiro ); $i++ ) 
                    {
                        for ( $ii = mb_strlen( $inteiro[$i] ); $ii < 3; $ii++ ) 
                        {
                            $inteiro[$i] = "0" . $inteiro[$i];
                        }
                    }
            
                    // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
                    $rt = null;
                    $fim = count( $inteiro ) - ($inteiro[count( $inteiro ) - 1] > 0 ? 1 : 2);
                    for ( $i = 0; $i < count( $inteiro ); $i++ )
                    {
                        $valor = $inteiro[$i];
                        $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
                        $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
                        $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
            
                        $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
                        $t = count( $inteiro ) - 1 - $i;
                        $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
                        if ( $valor == "000"){
                            $z++;
                        }elseif ( $z > 0 ){
                            $z--;
                            
                        }if ( ($t == 1) && ($z > 0) && ($inteiro[0] > 0) ){
                            $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
                            
                    }if ( $r ){
                            $rt = $rt . ((($i > 0) && ($i < = $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
                    }
            
                    $rt = mb_substr( $rt, 1 );
            
                    return($rt ? trim( $rt ) : "zero");
            
                }
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
                           echo clsTexto::valorPorExtenso($valor, false, false);
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
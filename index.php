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
    <div id="menu"> 
        <div class="navegacao">
            <h3>Recibos</h3>
        </div> 
    </div> 
    <div class="automatico"> <!– classe para deixar margens automáticas –>
        <div id="borda" class="noPrint"> 
                
            <div class="titulo">
                <h1>Vale</h1>
            </div>
                
            <div id="vale">
                <form action="gerar.php" method="post">
                <div id="numero-vale">
                    <h3>Número:</h3>
                    <input type="text" id="numero" name="numero" required><br>
                    <p>Número do vale</p> 
                </div>

                <div id="valor">
                    <h3>Valor:</h3>
                    <input type="text" id="valorI" name="valor" required><br>
                    <p>Valor do vale</p> 
                </div>
                <br>
                <div class="clear"></div>

                <div id="nome">
                    <h3>Nome:</h3>
                    <input type="text" id="nomeI" name="nome" required>
                </div>

                <div id="cidade">
                    <h3>Cidade:</h3>
                    <input type="text" id="cidadeI" name="cidade" required>
                </div>
                    
                <div id="data">
                    <h3>Data:</h3>
                    <input type="date" id="dataI" name="data" required>
                </div>

                <div class="clear"></div>
                <br>

                <div id="dados-empresa">
                    <h3>Dados da Empresa:</h3>
                    <input type="text" id="dadosEmpresa" name="dadosEmpresa" required>
                </div>

                <div id="duas-vias">
                    <h3>Duas vias?</h3>
                    <input type="checkbox" id="segundaVia" name="segundaVia" >
                    <label for="segundaVia"> Sim</label><br><br>
                </div>
                    
                <div id="gerar">
                    <input type="submit" value="Gerar Vale" >
                </div>
            </form>  
            </div>
        </div>
    </div>
</body>

</html>
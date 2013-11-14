<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Teste</title>
    </head>
    <body>
        <h1> Esta é a resposta para a primeira questão:</h1>
        <?php
            error_reporting(0);
             // para não estourar o tempo limite de execução do script
            set_time_limit(0);
            include_once './Crawler.php';
            if(isset($_GET['url']) and $_GET['url'] != "" and isset($_GET['depth']) and $_GET['depth'] != "" ){
                $crawler = new Crawler($_GET['url'], $_GET['depth']);
                $crawler->getLinks();
                
            }
        ?>
        
        
        <h1> Resposta para a segunda questão:</h1>
        <p>
            Normalmente SQL injection é dado com as strings:  "'" , "'1=1". já que elas quebram as strings 
            que são passadas para o banco de dados como consulta. 
        </p>
        <p>
            Uma estratégia usada é escapar os caracteres que quebram a string de consulta, ou seja, se 
            sua entrada tem algum caractere especial ele é invalidado para não dar problema na consulta.
            Como o teste é em php, a linguagem tem uma função que faz a "escapagem" de caracteres especiais,
            isto permite que mesmo com as strings relatadas acima a consulta vai ocorrer e não irá retornar nenhum
            valor indevido nem haverá erro de SQL. A função que desempenha tal papel é "mysql_real_escape_string($unescaped_string);".
        </p>
        <p>
            Então em todas as entradas de usuário que irão ser inseridas como consultas no banco de dados é boa prática utilizar
            a função relatada, que além de evitar SQL injection também previne muitos erros de SQL por causa de caracteres inválidos.</p>
    </body>
</html>

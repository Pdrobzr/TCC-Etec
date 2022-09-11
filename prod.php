<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/prod.css">
   
    <!-- <link rel="stylesheet" type="text/css" href="css/log.css" /> -->
    <title>Polaris</title>
    <script src="scripts/script.js"></script>
    <link rel="icon" href="img/icon.png">
    <!-- <script src="index.js"></script> -->
    <?php
        include('conexao.php');
        $email=isset($_POST["email"])?$_POST["email"]:'null';
        $senha=isset($_POST["senha"])?$_POST["senha"]:'null';


        if($email != 'null' && $senha != 'null')
        {


            $result = $conexao->prepare("SELECT nome FROM usuario WHERE email = :e AND senha = :s");
            $result->bindValue(":e",$email);
            $result->bindValue(":s",$senha);
            $result->execute();
            if($result->rowCount() > 0)
            {
                $dado = $result->fetch(PDO::FETCH_ASSOC);
                
                session_start();
                $_SESSION['nome'] = $dado['nome'];
            
                header("location:index.php");
            }
            else
            {
        ?>
                <script>
                alert("Email ou senha incorretos!");
                </script>
        <?php
                
            }
        }   
        ?>
</head>

<body>
    <header>
        <a href="index.php" class="logo">Adrenaline<br>Finder</a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="alugar.php">Quero Alugar</a></li>
            <li><a href="anuncie.php">Quero Anunciar</a></li>
            <li><a href="somos.php">Quem somos</a></li>
            <?php
                session_start();
                $nome = isset($_SESSION['nome'])?$_SESSION['nome']:'null';
                if($nome != 'null')
                {
                    echo"<li class='login' id='login'onclick='toggleLog()'>$nome</li>";
                    echo"
                    </ul>
                    </header>
                    <form action='logout.php' method='post' id='logForm' class='logform'  >
                     
                      
                      <input type='hidden' name='Deslogar' id='pass' class='log-input' value='$nome'>
                      <input type='submit' value='Sair' class='log-submit'>
                    </form>
                    ";
                }
                else
                {
                    echo"<li class='login' id='login'onclick='toggleLog()'>Login</li>";
                    echo"
                    </ul>
                    </header>
                    <form action='index.php' method='post' id='logForm' class='logform'  >
                      <label for='email'>Email:</label><br>
                      <input type='email' name='email' id='email' class='log-input' required name=email>
                      <label for='pass'>Senha:</label><br>
                      <input type='password' name='senha' id='pass' class='log-input' required name=senha>
                      <input type='submit' value='Logar' class='log-submit'>
                    </form>
                    ";
                }
            ?>
            <!-- <li><a href="#login">Login</a></li> -->
        </ul>
    </header>
    
    <form action="logado.php" method="post" id="logForm" class="logform"  >
      <label for="email">Email:</label><br>
      <input type="email" name="email" id="email" class="log-input" required name=email>
      <label for="pass">Senha:</label><br>
      <input type="password" name="senha" id="pass" class="log-input" required name=senha>
      <input type="submit" value="Logar" class="log-submit">
    </form>

    <section class="banner">
        <?php
        include("conexao.php");
        $id=$_GET['produto'];
        $query = $conexao->query("SELECT * FROM produto WHERE id_produto = $id");
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        $query_contato = $conexao->query("SELECT * FROM contato WHERE id_usuario = ".$resultado[0]['id_usuario']);
        $contato = $query_contato->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="equip" style="background: url(<?php echo($resultado[0]['foto']) ?>) no-repeat;background-size: cover;">
        
            
            <h1> <?php echo($resultado[0]['nome'])  ?></h1>
            <h1> R$ <?php echo($resultado[0]['preco'])  ?></h1>
        </div>
        
        <div class="azul">
        <div class="desc">
        <h1>CELULAR: <?php echo($contato[0]['Celular'])  ?></h1>
        <h1>TELEFONE FIXO: <?php echo($contato[0]['telefone_fixo'])  ?></h1>
    </div>
       
</div>
    <div class="info">
        <h1><?php echo($resultado[0]['descricao'])  ?></h1>
        <h1>CIDADE: <?php echo($resultado[0]['cidade'])  ?></h1>
        <h1>BAIRRO: <?php echo($resultado[0]['bairro'])  ?></h1>
        <h1>CEP: <?php echo($resultado[0]['cep'])  ?></h1>
    </div>
        
    </section>
</body>

</html>
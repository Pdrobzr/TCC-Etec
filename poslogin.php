<?php
include('conexao.php');

if(empty($_POST['email']) || empty($_POST['senha']))
{
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <!-- <link rel="stylesheet" type="text/css" href="css/log.css" /> -->
    <title>Polaris 4</title>
    <script src="scripts/script.js"></script>
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
        <a href="" class="logo">Adrenaline<br>Finder</a>
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
        <p class="banner-p">
            Logado com sucesso! Comece a explorar  <a href="alugar.php">aqui.</a>
        </p>
    </section>
    <section class="section">
       
    </section>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <!-- <link rel="stylesheet" type="text/css" href="css/log.css" /> -->
    <title>Adrenaline Finder</title>
    <script src="scripts/script.js"></script>
    <link rel="icon" href="img/icon.png">
    <!-- Login -->
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
            $result2 = $conexao->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND senha = :s");
            $result2->bindValue(":e",$email);
            $result2->bindValue(":s",$senha);
            $result2->execute();

            
            
            if($result->rowCount() > 0)
            {
                $dado = $result->fetch(PDO::FETCH_ASSOC);
                $dado2 = $result2->fetch(PDO::FETCH_ASSOC);
                
                session_start();
                $_SESSION['nome'] = $dado['nome'];
                $_SESSION['id_usuario'] = $dado2['id_usuario'];
                
            
            
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
        <!-- Registro -->
        <?php
            include ("conexao.php");
            $nome=isset($_POST["nome"])?$_POST["nome"]:'null';
            $tel=isset($_POST["tel"])?$_POST["tel"]:'null';
            $cel=isset($_POST["cel"])?$_POST["cel"]:'null';
            $email=isset($_POST["email"])?$_POST["email"]:'null';
            $senha1=isset($_POST["senha1"])?$_POST["senha1"]:'null';
            $senha2=isset($_POST["senha2"])?$_POST["senha2"]:'null';
            if($senha1 != $senha2){

                echo
                "
                    <script>
                    alert('Erro, Digite senhas iguais!');
                    </script>
                ";

            }
            else{
                if($nome != 'null' && $tel != 'null' && $cel != 'null' && $email != 'null' && $senha1 != 'null' && $senha2 != 'null')
                {

                    $verifica_email = $conexao->prepare("SELECT id_usuario FROM usuario WHERE email = :email");
                    $verifica_email->bindValue("email",$email);
                    $verifica_email->execute();

                    if($verifica_email->rowCount() > 0)
                    {
                        echo
                        "
                            <script>
                            alert(' Erro, Este email já está em uso!');
                            </script>
                        ";
                        header("Refresh: 0; location:index.php");;
                        return false;
                        
                        
                    }

                    $verifica_tel = $conexao->prepare("SELECT id_usuario FROM contato WHERE telefone_fixo = :tel");
                    $verifica_tel->bindValue("tel",$tel);
                    $verifica_tel->execute();

                    if($verifica_tel->rowCount() > 0)
                    {
                            echo"
                            <script>
                            alert('Erro, Este telefone fixo já está em uso!');
                            </script>
                                
                            </p>";
                            return false;
                    }

                    $verifica_cel = $conexao->prepare("SELECT id_usuario FROM contato WHERE celular = :cel");
                    $verifica_cel->bindValue("cel",$cel);
                    $verifica_cel->execute();
                    
                    if($verifica_cel->rowCount() > 0)
                    {
                        echo
                        "
                            <script>
                            alert('Erro, Este celular já está em uso!');
                            </script>
                        ";
                        return false;
                    }

                    else{
                        $conexao->query ("INSERT INTO usuario (nome, email, senha) values ('$nome','$email','$senha2') ");
                        
                        $result = $conexao->prepare("SELECT id_usuario FROM usuario WHERE email = :email");
                        $result->bindValue(":email",$email);
                        $result->execute();
                        $result2 = $result->fetch(PDO::FETCH_ASSOC);
                        $id_usuario = $result2['id_usuario'];
                        $conexao->query ("INSERT INTO contato (id_usuario, telefone_fixo, celular) values ('$id_usuario','$tel','$cel') ");
                        echo
                        "
                            <script>
                            alert('Registro concluido!');
                            </script>
                        ";
                    }
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
       
    
    <section class="banner">
        <?php
            if($nome == 'null')
            {
                echo
                "
                <p class='banner-p'>
                Bem vindo à Adrenaline Finder, aqui você achará e alugará os dispositivos que quiser para suas atividades. Caso tenha interesse, também poderá anunciar algo que não esteja mais utilizando. Para começar sua busca <a href='#reg'>clique aqui.</a>
                </p>
                ";
            }
            else
            {
                echo
                "
                <p class='banner-p'>
                Logado com sucesso! Comece a explorar <a href='alugar.php'>aqui!</a>
                </p>
                ";
            }
        ?>

    </section>
    <section class="section">
        <?php
        if($nome == 'null')
        { 
            echo
            "
                <form method='POST' action='index.php' id='reg'>
                    <h1>Cadastre-se na nossa plataforma</h1>
                    <input type='nome' placeholder='Nome' required name=nome>
                    <input type='tel' placeholder='Telefone' required name=tel maxlength='12'>
                    <input type='cel' placeholder='Celular' required name=cel maxlength='13'>
                    <input type='email' placeholder='Insira seu email' required name=email>
                    <input type='password' placeholder='Insira sua senha' required name=senha1>
                    <input type='password' placeholder='Confirmar senha' required name=senha2>
                    <input type='submit' value='ACESSAR'>
                </form>
            ";
        }
       
        
        ?>
        
        <div class="banner-reg" id="bannerReg">
            <p class="banner-reg-p" id="bannerRegP">
                Aqui você encontra seu equipamento favorito com facilidade.   
            </p>
            <div class="sub-banner-reg" id="subBannerReg">
                <p class="sub-banner-content">
                    Na nossa plataforma, você terá acesso aos seguintes benefícios:
                </p>
                <ul class="sub-banner-ul" type="circle">
                    <li>Diversos equipamentos a sua disposição;</li>
                    <li>Facilidade para achar periféricos esportivos;</li>
                    <li>Preços acessíveis;</li>
                    <li>Aumentar espaço alugando algum periférico que você não usa mais;</li>
                    <li>Melhor segurança na hora de alugar seu periférico.</li>
                    
                </ul>
            </div>
        </div>
        <script src="scripts/index.js"></script> 
    </section>
</body>
</html>


?>


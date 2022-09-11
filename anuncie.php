<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="icon" href="img/icon.png">
    <link rel="stylesheet" type="text/css" href="css/anuncie.css" />
    <!-- <link rel="stylesheet" type="text/css" href="css/log.css" /> -->
    <title>Polaris</title>
    <script src="scripts/script.js"></script>
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
            include ("conexao.php");
            $nm_prod=isset($_POST["nm_prod"])?$_POST["nm_prod"]:'null';
            $drescri=isset($_POST["drescri"])?$_POST["drescri"]:'null';
            $preco=isset($_POST["preco"])?$_POST["preco"]:'null';
            $cep=isset($_POST["cep"])?$_POST["cep"]:'null';
            $cidade=isset($_POST["cidade"])?$_POST["cidade"]:'null';
            $bairro=isset($_POST["bairro"])?$_POST["bairro"]:'null';
            $imagem=isset($_FILES["imagem"])?$_FILES["imagem"]["name"]:'null';
            session_start();
            $nome = isset($_SESSION['nome'])?$_SESSION['nome']:'null';
            $id_usuario = isset($_SESSION['id_usuario'])?$_SESSION['id_usuario']:'null';
            $id_usuario2 = intval($id_usuario);
            
            
            if($nm_prod != 'null' && $drescri != 'null' && $preco != 'null' && $cep != 'null' && $cidade != 'null' && $bairro != 'null' && $imagem != 'null')
            {
                $dir = "fts/";
                $arquivo_nome = $dir.$imagem;  
                move_uploaded_file($_FILES["imagem"]['tmp_name'], $arquivo_nome); 
                $conexao->query ("INSERT INTO produto (id_usuario, nome, descricao, preco, cep, cidade, bairro, foto) values ('$id_usuario2','$nm_prod','$drescri','$preco','$cep','$cidade','$bairro','$arquivo_nome') ");
                
                
                    echo
                    "
                        <script>
                            alert('Registro concluido!');
                
                            window.location.href='anuncie.php';
                        </script>
                    ";

                    
                    
                    
                   
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
    
    <form action="logado.php" method="post" id="logForm" class="logform">
    <label for="email">Email:</label><br>
      <input type="email" name="email" id="email" class="log-input" required name=email>
      <label for="pass">Senha:</label><br>
      <input type="password" name="senha" id="pass" class="log-input" required name=senha>
      <input type="submit" value="Logar" class="log-submit">
    </form>
    
    <section class="section">
        <?php
        
       
        if($nome != 'null')
        {
        echo 
        "
        
            <form method='POST' action='anuncie.php' id='an' enctype='multipart/form-data'>
                <h1>Anuncie o produto</h1>
                <input type='name' placeholder='Nome do produto' required name='nm_prod'>
                <input type='name' placeholder='Descrição do produto' required name='drescri'>
                <input type='name' placeholder='Preço (R$)' required name='preco'>
                <input type='number' placeholder='CEP' required name='cep'>
                <input type='name' placeholder='Cidade' required name='cidade'>
                <input type='name' placeholder='Bairro' required name='bairro'>
                <input type='file' required name='imagem' id='imagem'>
                <input type='submit' value='ANUNCIAR'>
            </form>
        "; 
        }
        else
        {
            echo
            "
            <form method='POST' action='anuncie.php' id='an'>
                <h1>Você precisa estar logado para anunciar um produto!</h1>
            </form>
            ";
        }
        ?>
    </section>
    
</body>

</html>
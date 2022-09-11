<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/alugar.css">
   
    <!-- <link rel="stylesheet" type="text/css" href="css/log.css" /> -->
    <title>Polaris</title>
    <link rel="icon" href="img/icon.png">
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
        ?>
</head>

<body>
    <header>
        <a href="index.php" class="logo">Adrenaline<br>Finder</a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Quero Alugar</a></li>
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
      <form class="filter" action="/action_page.php">
        <input type="text" placeholder="Pesquise.." name="nfiltro">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
      <div class="gallery">
        <?php
            include("conexao.php");
            $query = $conexao->query("SELECT * FROM produto");
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $key => $item)
            {
                
                    echo
                    "
                      <a href='prod.php?produto=".$resultado[$key]['id_produto']."'class='produto' style='background: url(".$resultado[$key]['foto'].") no-repeat;background-size: cover;'>
                        <div class='prodcontent'>
                          <h1>".$resultado[$key]['nome']."</h1>
                          <p>R$ ".$resultado[$key]['preco']."</p>
                        </div>
                        
                      </a>
                    ";
               
              
            }
        ?>
          
      </div>


        <!-- <div class="gallery">
            <a target="_blank" href="img_5terre.jpg">
              <img src="img/logo.png" alt="Cinque Terre" width="600" height="400">
            </a>
            <div class="desc">Add a description of the image here</div>
          </div>
          
          <div class="gallery">
            <a target="_blank" href="img_forest.jpg">
              <img src="img/logo.png" alt="Forest" width="600" height="400">
            </a>
            <div class="desc">Add a description of the image here</div>
          </div>
          
          <div class="gallery">
            <a target="_blank" href="img_lights.jpg">
              <img src="img/logo.png" alt="Northern Lights" width="600" height="400">
            </a>
            <div class="desc">Add a description of the image here</div>
          </div>
          
          <div class="gallery">
            <a target="_blank" href="img_mountains.jpg">
              <img src="img/logo.png" alt="Mountains" width="600" height="400">
            </a>
            <div class="desc">Add a description of the image here</div>
          </div>

          <div class="gallery">
            <a target="_blank" href="img_mountains.jpg">
              <img src="img/logo.png" alt="Mountains" width="600" height="400">
            </a>
            <div class="desc">Add a description of the image here</div>
          </div> -->
    </section>
</body>

</html>
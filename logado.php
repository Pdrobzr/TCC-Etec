<?php
include('conexao.php');
$email=$_POST["email"];
$senha=$_POST["senha"];



    $result = $conexao->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND senha = :s");
    $result->bindValue(":e",$email);
    $result->bindValue(":s",$senha);
    $result->execute();
    if($result->rowCount() > 0)
    {
        $dado = $result->fetch();
        session_start();
        $_SESSION['id_usuario'] = $dado['id_usuario'];
        print_r($dado);
        return true;
    }
    else
    {
?>
        <script>
        alert("Email ou senha incorretos!");
        </script>
<?php
        
    }
        
?>
<?php
include ("conexao.php");
$nome=$_POST["nome"];
$tel=$_POST["tel"];
$cel=$_POST["cel"];
$email=$_POST["email"];
$senha1=$_POST["senha1"];
$senha2=$_POST["senha2"];
if($senha1 != $senha2){

    echo"<p class='alert-danger'>
		Erro, Digite senhas iguais!
    </p>";

}
else{
	$verifica_email = $conexao->prepare("SELECT id_usuario FROM usuario WHERE email = :email");
	$verifica_email->bindValue("email",$email);
	$verifica_email->execute();

	if($verifica_email->rowCount() > 0)
	{
		echo"<p class='alert-danger'>
			Erro, Este email já está em uso!
   		</p>";
		return false;
		
		
	}

	$verifica_tel = $conexao->prepare("SELECT id_usuario FROM contato WHERE telefone_fixo = :tel");
	$verifica_tel->bindValue("tel",$tel);
	$verifica_tel->execute();

	if($verifica_tel->rowCount() > 0)
	{
			echo"<p class='alert-danger'>
				Erro, Este telefone fixo já está em uso!
			</p>";
			return false;
	}

	$verifica_cel = $conexao->prepare("SELECT id_usuario FROM contato WHERE celular = :cel");
	$verifica_cel->bindValue("cel",$cel);
	$verifica_cel->execute();
	
	if($verifica_cel->rowCount() > 0)
	{
		echo"<p class='alert-danger'>
			Erro, Este celular já está em uso!
		</p>";
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
	}
		
}
?>


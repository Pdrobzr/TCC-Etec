<?php
try{
	$conexao = new PDO("mysql:dbname=banco_tcc; host=localhost" ,"root", "21017100" );
	}
catch(PDOException $e)
{
	Echo "Erro com banco de dados:" .$e->getMensage();
}
catch(Exception $e)
{
	Echo "Erro Generico:" .$e->getMensage();
}
?>
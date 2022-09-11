<?php
include("conexao.php");
$id=$_GET['produto'];
$query = $conexao->query("SELECT * FROM produto WHERE id_produto = $id");
$resultado = $query->fetchAll(PDO::FETCH_ASSOC);

$query_contato = $conexao->query("SELECT * FROM contato WHERE id_usuario = ".$resultado[0]['id_usuario']."");
$contato = $query_contato->fetchAll(PDO::FETCH_ASSOC);
print_r ($contato);
/*foreach($resultado as $key => $item)
{
    echo"Informação $key <br>";
    foreach($item as $key2 => $value)
    {
        
        
        if($key2 == 'foto')
        {
            echo"<img src='$value'/> <br>";
        }
        else
        {
            echo"$value <br>";
        }
    }
   
}*/
    


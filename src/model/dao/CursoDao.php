<?php    

    namespace sistema\src\Model\dao;

    require __DIR__.'/../../../vendor/autoload.php';
    use \Model\bean\curso;

    require __DIR__ .'/../conexao.php';
    require __DIR__ .'/../bean/curso.php';

    /**
     * validação do post
     */
    if(isset($_POST['nome'], $_POST['duracao_meses'])){
        die("cadastrar");
    }

    class CursoDao{

        

    }

?>

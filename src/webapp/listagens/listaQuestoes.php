<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="../../css/questoes.css">

    <link rel="shortcut icon" href="../../img/favicon-16x16.png" type="image/x-icon">


    <title>Listagem de Questões</title>
  </head>
  <body>

    <div class="container">

        <?php
            // conexao com o banco
            include "../conexao.php";
        ?>

        <header>

            <div class="row text-center m-0">   
                <!-- Página Inicial -->
                <div class="col-4">
                    <a href="../../../index.html">
                        <button class="btn btn-outline-dark" type="button">Página Inicial</button>
                    </a>
                </div><!-- Página Inicial -->
                    
                <!-- Titulo -->
                <div class="col-4">
                    <h2 class="display-4">Filtros</h2>
                </div><!-- Titulo -->

                <!-- Cadastrar Questão -->
                <div class="col-4">
                    <a href="../forms/incluirQuestao.php">
                        <button class="btn btn-outline-dark" type="button">Cadastrar Questão</button>
                    </a>
                </div><!-- Cadastrar Questão -->
            </div>

            <form name="formListaQuestao" method="post">

                <div class="row text-center">   
                    <div class="col-3"></div>
                    <!-- Palavra Chave -->
                    <div class="col-6">
                        <div class="form-goup">
                            <input class="form-control" type="search" name="enunciado" placeholder="Buscar por palavra-chave" maxlength="2000">
                        </div>
                    </div><!-- Palavra Chave -->
                    <div class="col-3"></div>
                </div>

                <div class="row text-center mt-4">
                    <!-- id curso -->
                    <div class="col-4">
                        <div class="form-group">
                            <select class="form-control" name="id_curso" id="id_curso">
                                <option value="">Selecione o Curso</option>
                                <?php
                                    include "../consultas/cursos.php";
                                    
                                    $cont = 0;
                                    while($cont < $cursos){

                                        $dados = mysqli_fetch_array($registros_cursos);

                                        $id_curso   = $dados["id"];
                                        $curso      = $dados["nome"];

                                        echo "<option value='$id_curso'>$curso</option>";

                                        $cont ++;
                                    }
                                ?>
                            </select>
                        </div>
                    </div><!-- /id curso -->

                    <!-- disciplinas -->
                    <div class="col-4">
                        <div class="form-group">
                            <select class="form-control" name="id_disciplina_1" id="id_disciplina_1">
                                <option value="">Selecione a Disciplina</option>
                                <?php
                                    include "../consultas/disciplinas.php";
                                    
                                    $cont = 0;
                                    while($cont < $disciplinas){

                                        $dados = mysqli_fetch_array($registros_disciplinas);

                                        $id_disciplina = $dados["id"];
                                        $disciplina    = $dados["nome"];

                                        echo "<option value='$id_disciplina'>$disciplina</option>";

                                        $cont ++;
                                    }
                                ?>
                            </select>
                        </div>
                    </div><!-- disciplinas -->

                    <!-- ano -->
                    <div class="col-4">
                        <div class="form-group">
                            <select class="form-control" name="ano" id="ano">
                                <option value="">Selecione o Ano</option>
                                <?php
                                    include "../consultas/anos.php";
                                    $cont = 0;
                                    while($cont < $anos){
                                
                                        // armazernar cursos em array
                                        $dados = mysqli_fetch_array($registros_anos);
                                        // dados
                                        $ano = $dados["ano"];
                                        
                                        // mostrar as opções
                                        echo "<option value='$ano'>$ano</option>";
                                        
                                        $cont ++;
                                    }
                                ?>
                            </select>
                        </div>
                    </div><!-- /ano -->
                </div>

                <div class="row text-center mt-4">
                    <!-- tipo questao -->
                    <div class="col-5">
                        <div class="row form-group form-check">
                            <h3>Tipo de Questão</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tipo_questao" value="M">
                                <label class="form-check-label mr-2" for="tipo_questao">Múltiplas Escolhas</label>

                                <input class="form-check-input ml-2" type="checkbox" name="tipo_questao" value="D">
                                <label class="form-check-label" for="tipo_questao">Dissertativa</label>
                            </div>
                        </div>
                    </div><!-- /tipo questao -->

                    <div class="col-2">
                        <button type="submit" class="btn btn-outline-dark">Filtrar</button>
                    </div>

                    <!-- grau de dificuldade -->
                    <div class="col-5">
                        <div class="row form-group form-check">
                            <h3>Grau de Dificuldade</h3>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="id_dificuldade" value="1">
                                <label class="form-check-label mr-2" for="id_dificuldade">Fácil</label>

                                <input class="form-check-input ml-2" type="checkbox" name="id_dificuldade" value="2">
                                <label class="form-check-label mr-2" for="id_dificuldade">Mediana</label>

                                <input class="form-check-input ml-2" type="checkbox" name="id_dificuldade" value="3">
                                <label class="form-check-label" for="id_dificuldade">Dificil</label>
                            </div>
                        </div>
                    </div><!-- /grau de dificuldade -->           
                </div>
                    
            </form>  
        </header>

        <!-- condições e concatenções para os filtros -->
        <?php 

           $sql_filtros = "SELECT * FROM questao";

           if(!empty($_POST)){
                $sql_filtros .= " WHERE (1=1) ";

                if(isset($_POST["enunciado"])){
                    $palavras_chave_ = filter_input(INPUT_POST, "enunciado", FILTER_SANITIZE_STRIPPED);
                    strlen($palavras_chave_) ? $sql_filtros .= "AND enunciado LIKE '%$palavras_chave_%' " : null;
                }

                if(isset($_POST["ano"])){
                    $ano_ = filter_input(INPUT_POST, "ano", FILTER_VALIDATE_INT);
                    strlen($ano_) ? $sql_filtros .= "AND ano = '$ano_' " : null;
                }

                if(isset($_POST["id_disciplina_1"])){
                    $disciplina1_ = filter_input(INPUT_POST, "id_disciplina_1", FILTER_VALIDATE_INT);
                    strlen($disciplina1_) ? $sql_filtros .= "AND id_disciplina_1 = '$disciplina1_' " : null;
                }

                if(isset($_POST["id_curso"])){
                    $curso_ = filter_input(INPUT_POST, "id_curso", FILTER_VALIDATE_INT);
                    strlen($curso_) ? $sql_filtros .= "AND id_curso = '$curso_' " : null;
                }

                if(isset($_POST["tipo_questao"])){
                    $tipo_ = filter_input(INPUT_POST, "tipo_questao", FILTER_SANITIZE_STRIPPED);
                    $tipo_ = in_array($tipo_,['M', 'D']) ? $tipo_ : "";
                    strlen($tipo_) ? $sql_filtros .= "AND tipo_questao = '$tipo_' " : null;
                }

                if(isset($_POST["id_dificuldade"])){
                    $dificuldade_ = filter_input(INPUT_POST, "id_dificuldade", FILTER_VALIDATE_INT);
                    $dificuldade_ = in_array($dificuldade_,['1', '2', '3']) ? $dificuldade_ : "";
                    strlen($dificuldade_) ? $sql_filtros .= "AND id_dificuldade = '$dificuldade_' " : null;
                }
           }
           $sql_filtros .= " ORDER BY id_curso";
           //var_dump($sql_filtros);


            // resultado   
            $resultado_filtros = mysqli_query($con, $sql_filtros) or 
                    die("erro nos filtros ". mysqli_error($con));

            $filtros = mysqli_num_rows($resultado_filtros);

            // validação caso não tenho nenhum filtro
            if($filtros == ""){
                echo "<h3 class='text-center'>Nenhum resultado encontrado!</h3>";
            }

            //var_dump($filtros);
        ?><!-- /condições e concatenações para os filtros -->

            <!-- relatório -->
            
             <div class="row text-center">
                <div class="col-3"></div>
                <div class="col-6">
                    <?php
                        if(strlen($filtros)){
                            echo "<h5>Registros encontrados = $filtros</h5>";
                        }
                    ?>
                </div>
                <div class="col-3"></div>
             </div>
             
             <hr>
            <!-- /relatório -->

        <!-- listagem -->
        <?php
            // listar nome do curso
            $cont_filtros = 0;

            while($cont_filtros < $filtros){

                // array com os filtros 
                $dados = mysqli_fetch_array($resultado_filtros);

                // dados da tabela questão
                $id                 = $dados["id"];
                $id_curso           = $dados["id_curso"];
                $descricao          = $dados["descricao"];
                $ano                = $dados["ano"];
                $numero             = $dados["numero"];
                $id_disciplina_1    = $dados["id_disciplina_1"];
                $id_disciplina_2    = $dados["id_disciplina_2"];
                $id_disciplina_3    = $dados["id_disciplina_3"];
                $id_disciplina_4    = $dados["id_disciplina_4"];
                $id_dificuldade     = $dados["id_dificuldade"];
                $enunciado          = $dados["enunciado"];
                $tipo_questao       = $dados["tipo_questao"];
                $dissertativa       = $dados["resposta_dissertativa"];
                $alt_a              = $dados["resposta_alt_a"];
                $alt_b              = $dados["resposta_alt_b"];
                $alt_c              = $dados["resposta_alt_c"];
                $alt_d              = $dados["resposta_alt_d"];
                $alt_e              = $dados["resposta_alt_e"];
                $alt_correta        = $dados["alternativa_correta"];

                // registros tabela curso para listar o nome do curso
                require "../consultas/cursos.php";
                $dados_nome_curso = mysqli_fetch_array($registros_nome_cursos);

                $nome_cursos_ = $dados_nome_curso["nome"];

                // registros da tabela disciplina para listar o nome da disciplina
                require "../consultas/disciplinas.php";

                $dados_disciplina1 = mysqli_fetch_array($registros_disciplinas_1);
                $dados_disciplina2 = mysqli_fetch_array($registros_disciplinas_2);
                $dados_disciplina3 = mysqli_fetch_array($registros_disciplinas_3);
                $dados_disciplina4 = mysqli_fetch_array($registros_disciplinas_4);

                $disciplina_1 = $dados_disciplina1["nome"];
                $disciplina_2 = $dados_disciplina2["nome"];
                $disciplina_3 = $dados_disciplina3["nome"];
                $disciplina_4 = $dados_disciplina4["nome"];
        ?>


            <?php

                // accordion
                echo "<div class='accordion mb-2 mt-3' id='accordionQuestao'>";

                // card
                echo "  <div class='card'>
                            <div class='card-header' id='titulo'>
                                <h2 class='mb-0'>
                                    <button class='btn btn-dark btn-block text-left' type='button' data-toggle='collapse'data-target='#collapse1$id' aria-expanded='false' aria-controls='collapse1$id'>";            
                // curso
                echo "              <div class='row text-center border-bottom mb-1'>
                                        <div class='col-2'></div>
                                        <div class='col-8'>
                                            <h5>$nome_cursos_</h5>
                                        </div>
                                        <div class='col-2'></div>
                                    </div>";
                
                // id
                echo "              <div class='row p-1'>
                                        <div class='col-1'>
                                            <h5>$id</h5>
                                        </div>";
                // enunciado
                echo "                  <div class='col-9 text-left'>
                                            <p class='limit-texto'>$enunciado</p>
                                        </div>";
                
                // dificuldade
                echo "                  <div class='col-2'>
                                            <h5>";
                                                // definir o grau de dificuldade que será listado
                                                switch($id_dificuldade){
                                                    case 1: echo"Fácil";
                                                        break;
                                                    case 2: echo"Mediana";
                                                        break;
                                                    case 3: echo"Difícil";
                                                        break;
                                                    default: echo"<h2>Erro ao listar a dificuldade</h2>";
                                                }
                echo "                      </h5>
                                        </div>
                                    </div>
    
                                </button>
                            </h2>
                        </div>";// /header card
    
                echo "  <div id='collapse1$id' class='collapse' aria-labelledby='titulo' data-parent='#accordionQuestao'>
                            <div class='card-body'>";

                // btn para alteração e exclusão
                echo "
                                <div class='row'>

                                    <div class='col-5'></div>

                                    <div class='col-1'>
                                        <a href='../forms/altQuestao.php?id=$id&numero=$numero' class='btn btn-outline-dark'>
                                            <i class='fas fa-pen fas-3x'></i>
                                        </a>        
                                    </div>

                                    <div class='col-1'>
                                        <a href='../forms/excQuestao.php?id=$id&numero=$numero' class='btn btn-outline-dark'>
                                            <i class='fas fa-trash fas-3x'></i>
                                        </a>
                                    </div>

                                    <div class='col-5'></div>

                                </div>
                ";

                // descrição
                echo "          <div class='row'>
                                    <div class='col-4'>
                                        <h6>Descrição</h6>
                                        <input class='form-control' type='text' readonly value='$descricao'>
                                    </div>";
                                    
                // ano
                echo "               <div class='col-4'>
                                        <h6>Ano</h6>
                                        <input class='form-control' type='number' readonly value='$ano'>
                                    </div>";
                                    
                // numero da questão
                echo "               <div class='col-4'>
                                        <h6>Número da Questão</h6>
                                        <input class='form-control' type='number' readonly value='$numero'>
                                    </div>
                                </div>";
                                
    
                // titulo disciplinas
                echo "          <div class='row text-center mt-5'>
                                    <div class='col-3'></div>
                                    <div class='col-6'>
                                        <h6>Disciplina(s)</h6>
                                    </div>
                                    <div class='col-3'></div>
                                </div>";
                
                // listagem de disciplinas
                echo "          <div class='row text-center'> ";
                                            
                // disciplina 1
                echo "              <div class='col-3'>";
                                        if($id_disciplina_1 != '' && $id_disciplina_1 != 0){
                                            echo"
                                            <select class='form-control' readonly>
                                                <option>$disciplina_1</option>
                                            </select>";
                                        }
                echo "                    </div>"; //disciplina 1
                                    
                // disciplina 2
                echo "              <div class='col-3'>";
                                        if($id_disciplina_2 != '' && $id_disciplina_2 != 0){
                                            echo"
                                            <select class='form-control' readonly>
                                                <option>$disciplina_2</option>
                                            </select>";
                                        }
                echo "              </div>"; //disciplina 2
    
                // disciplina 3
                echo "              <div class='col-3'>";
                                        if($id_disciplina_3 != '' && $id_disciplina_3 != 0){
                                            echo"
                                            <select class='form-control' readonly>
                                                <option>$disciplina_3</option>
                                            </select>";
                                        }
                echo "              </div>"; //disciplina 3
    
                // disciplina 4
                echo "              <div class='col-3'>";
                                        if($id_disciplina_4 != '' && $id_disciplina_4 != 0){
                                            echo"
                                            <select class='form-control' readonly>
                                                <option>$disciplina_4</option>
                                            </select>";
                                        }
                echo "              </div>"; //disciplina 4
                                    
                echo "          </div>"; // /disciplinas

                // titulo enunciado
                echo "          <div class='row text-left mt-5'>
                                    <div class='col-1'></div>
                                        <div class='col-10'>
                                           <h6>Enunciado</h6>
                                        </div>
                                    <div class='col-1'></div>
                                </div>";
                // enunciado
                echo "
                                <div class='row'>
                                    <div class='col-1'></div>
                                    <div class='form-group col-10'>
                                        <textarea class='form-control'cols='110' rows='5' readonly>
                                            $enunciado
                                        </textarea>
                                    </div>
                                    <div class='col-1'></div>
                                </div>
                ";
            ?>

            <?php
                // definir o tipo de questão que será listado
                switch($tipo_questao){
                    
                    // case múltiplas escolhas
                    case 'M':   echo "
                                <div class='row'> 
                                    <div class='col-1'></div>
                                    <div class='col-10'>
                                        <h6>Múltiplas Escolhas</h6>
                                    </div>
                                    <div class='col-1'></div>
                                </div>";
            ?>
                <!-- alternartivas -->
                <?php
                    // alternativa a
                    echo "      <div class='row mt-1'>
                                    <div class='col-1'></div>
                                    <div class='col-10'>
                                      <div class='form-check form-check-inline'>
                                        <label class='form-check-label' for='alternativa_correta'>a.</label>
                                        <input class='form-check-input' type='radio' value='A'
                    ";
                    // veficação para check 
                                        if($dados['alternativa_correta'] == 'A'){ 
                                            echo 'checked'; 
                                            } 
                    echo "                  >"; //fechar o input
                                        
                    echo "              <textarea class='form-control' cols='110' rows='1' 
                                                 maxlength='2000' readonly>
                                            $alt_a
                                        </textarea>
                                      </div>
                                    </div>
                                    <div class='col-1'></div>
                                </div>
                    "; // fim alternativa a
                ?>
                <?php
                    // alternativa b
                    echo "      <div class='row mt-1'>
                                    <div class='col-1'></div>
                                    <div class='col-10'>
                                      <div class='form-check form-check-inline'>
                                        <label class='form-check-label' for='alternativa_correta'>b.</label>
                                        <input class='form-check-input' type='radio' value='B'
                    ";
                    // veficação para check 
                                        if($dados['alternativa_correta'] == 'B'){ 
                                            echo 'checked'; 
                                            } 
                    echo "                  >"; //fechar o input
                                        
                    echo "              <textarea class='form-control' cols='110' rows='1' 
                                                 maxlength='2000' readonly>
                                            $alt_b
                                        </textarea>
                                      </div>
                                    </div>
                                    <div class='col-1'></div>
                                </div>
                    "; // fim alternativa b
                ?>
                <?php
                    // alternativa c
                    echo "      <div class='row mt-1'>
                                    <div class='col-1'></div>
                                    <div class='col-10'>
                                      <div class='form-check form-check-inline'>
                                        <label class='form-check-label' for='alternativa_correta'>c.</label>
                                        <input class='form-check-input' type='radio' value='C'
                    ";
                    // veficação para check 
                                        if($dados['alternativa_correta'] == 'C'){ 
                                            echo 'checked'; 
                                            } 
                    echo "                  >"; //fechar o input
                                        
                    echo "              <textarea class='form-control' cols='110' rows='1' 
                                                 maxlength='2000' readonly>
                                            $alt_c
                                        </textarea>
                                      </div>
                                    </div>
                                    <div class='col-1'></div>
                                </div>
                    "; // fim alternativa c
                ?>
                <?php
                    // alternativa d
                    echo "      <div class='row mt-1'>
                                    <div class='col-1'></div>
                                    <div class='col-10'>
                                      <div class='form-check form-check-inline'>
                                        <label class='form-check-label' for='alternativa_correta'>d.</label>
                                        <input class='form-check-input' type='radio' value='D'
                    ";
                    // veficação para check 
                                        if($dados['alternativa_correta'] == 'D'){ 
                                            echo 'checked'; 
                                            } 
                    echo "                  >"; //fechar o input
                                        
                    echo "              <textarea class='form-control' cols='110' rows='1' 
                                                 maxlength='2000' readonly>
                                            $alt_d
                                        </textarea>
                                      </div>
                                    </div>
                                    <div class='col-1'></div>
                                </div>
                    "; // fim alternativa d
                ?>
                <?php
                    // alternativa e
                    echo "      <div class='row mt-1'>
                                    <div class='col-1'></div>
                                    <div class='col-10'>
                                      <div class='form-check form-check-inline'>
                                        <label class='form-check-label' for='alternativa_correta'>e.</label>
                                        <input class='form-check-input' type='radio' value='E'
                    ";
                    // veficação para check 
                                        if($dados['alternativa_correta'] == 'E'){ 
                                            echo 'checked'; 
                                            } 
                    echo "                  >"; //fechar o input
                                        
                    echo "              <textarea class='form-control' cols='110' rows='1' 
                                                 maxlength='2000' readonly>
                                            $alt_e
                                        </textarea>
                                      </div>
                                    </div>
                                    <div class='col-1'></div>
                                </div>
                    "; // fim alternativa e

                    break; // fim case multiplas escolhas
                ?>
                <!-- /alternativas -->
                
                <!-- dissertativa -->
                <?php
                    // case dissertativa
                    case 'D':
                    // titulo dissertativa
                    echo "
                                <div class='row'> 
                                    <div class='col-1'></div>
                                    <div class='col-10'>
                                        <h6>Dissertativa</h6>
                                    </div>
                                    <div class='col-1'></div>
                                </div>
                    ";
                    // resposta dissertativa
                    echo "
                                <div class='row'>
                                    <div class='col-1'></div>
                                    <div class='form-group col-10'>
                                        <textarea class='form-control'cols='110' rows='5' maxlength='2000' readonly>
                                            $dissertativa
                                        </textarea>
                                    </div>
                                    <div class='col-1'></div>
                                </div>
                    ";
                    
                    break; // fim case dissertativa

                    default: echo "<h2>Erro ao listar o tipo de questão</h2>";
                } //fim switch
                
                ?>
                <!-- /dissertativa -->
                        

            <?php
                echo "
                            </div>
                        </div>
                    </div><!-- /card -->
                </div><!-- /accordion -->
                ";

                $cont_filtros ++;
            }
        ?><!-- /listagem -->

    </div><!-- container -->

    <!-- SCRIPT BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
  </body>
</html>
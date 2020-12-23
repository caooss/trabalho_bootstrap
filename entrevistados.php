<?php
    include("./banco/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Formulário</title>

        <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </head>
    <body>
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./formulario.php">Form</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Cadastrados</a>
          </li>
        </ul>

        <?php
            $cons="SELECT * FROM cadastro";

            $query=mysqli_query($con, $cons);
            if($cons){
                if(mysqli_num_rows($query)>0){
                    echo '
                    <div class="row">
                    ';
                        while(($res=mysqli_fetch_assoc($query))!=null){
                            echo '
                            <div class="card" style="width: 18rem;">
                              <img src="upload/'.$res["foto"].'" class="card-img-top" style="width: 18rem; height: 18rem;"/>
                              <div class="card-body">
                                <h5 class="card-title">'.$res["nome"].' '.$res["sobrenome"].'</h5>
                              </div>
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item"><h5>Sobre: </h5>'.$res["sobre"].'</li>
                                <li class="list-group-item"><h5>E-Mail: </h5>'.$res["email"].'</li>
                                <li class="list-group-item"><h5>Idade: </h5>'.$res["idade"].'</li>
                              </ul>
                            </div>
                            ';
                        }
                echo '
                    </div>
                    ';

                }else{
                    echo mysqli_error($con);
                }
            }else{
                echo "<h1 align='center'>Nenhuma pessoa cadastrada</h1>";
            }
        ?>

    </body>
</html>

<?php
    myslqi_close($con);
?>

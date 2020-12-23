<?php
    include("./banco/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Formulário</title>

        <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="/css/style.css">
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
            <a class="nav-link active" href="#">Form</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./entrevistados.php">Cadastrados</a>
          </li>
        </ul>

        <?php
            if (empty($_POST)) {
                echo '
                    <form action="#" method="post" enctype= multipart/form-data>
                    <div class = "col-12">
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Email</label>
                          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required name="email">
                        </div>

                            <br>

                            <div class="input-group mb-3">
                              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome" required name="nome">

                              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Sobrenome" required name="sobrenome">
                            </div>

                            <br>

                            <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Idade</label>
                              <input type="number" class="form-control" id="exampleFormControlInput1" required name="idade">
                            </div>

                            <br>

                            <div class="mb-3">
                              <label for="exampleFormControlTextarea1" class="form-label">Sobre</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required name="sobre"></textarea>
                            </div>

                            <br>

                            <div class="mb-3" class="mx-auto">
                              <label for="exampleFormControlInput1" class="form-label">Foto</label>
                              <input type="file" class="form-control" id="exampleFormControlInput1" required name="foto">
                            </div>

                            <br>

                            <div class="mb-3">
                              <input type="submit" class="form-control" id="exampleFormControlInput1" value="Cadastrar">
                            </div>
                        </div>
                    </form>
                ';
            }else{

                if(isset($_FILES['foto'])){

                    $email=$_POST['email'];
                    $nome=$_POST['nome'];
                    $sobrenome=$_POST['sobrenome'];
                    $idade=$_POST['idade'];
                    $sobre=$_POST['sobre'];
                    $foto=$_FILES['foto'];


                    $extensao=strtolower(substr($foto['name'], -4)); //pega a extensão
                    $novo_nome=md5(time()).$extensao; //define o nome do arquivo
                    $diretorio="upload/"; //define o diretório para onde enviaremos o arquivo

                    move_uploaded_file($foto['tmp_name'], $diretorio.$novo_nome); //efetua o upload

                    $sql="INSERT INTO cadastro (email, nome, sobrenome, idade, sobre, foto)
                          VALUE ('$email', '$nome', '$sobrenome', $idade, '$sobre', '$novo_nome')";

                    $query=mysqli_query($con, $sql);

                    if($query){
                        echo '<h1 align="center">Cadastrado com sucesso.</h1>';
                    }

                }else{
                    echo '<h1 aligh="center">Nenhuma foto foi adicionada</h1>';
                }
            }
        ?>
    </body>
</html>

<?php
    myslqi_close($con);
?>

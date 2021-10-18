<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles.css">
    <title>Libros</title>
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="main.php" class="d-flex align-items-center py-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Libreria</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="main.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Libros</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Listado</span></a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Crear libros</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Autores</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Listado de autores</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Crear autores</span> 2</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="col py-4 px-5">
            <h1>Libros</h1>
            <?php

            require "../../controllers/BookController.php";

            use Alejandro\Library\controllers\BookController;

            $controller = new BookController();
            $books = $controller->getAllBook();

            if (count($books) > 0) {
                echo "<table class='table'><thead><tr><th scope='col'>#</th><th scope='col'>Title</th>
                    <th scope='col'>Release date</th>
                    <th scope='col'>Author</th></tr></thead><thbody>";
                foreach ($books as $book) {
                    echo "<tr>
                    <th scope='row'>". $book->getId() ."</th>
                    <td>" . $book->getTitle() ."</td>
                    <td>" . $book->getReleaseDate()->format('Y-m-d H:i:s') ."</td>
                    <td>" . $book->getAuthor()->getFullName() . "</td>
                    <td><a href='book_detail.php'><button class='btn btn-primary'>Ver</button></a></td>
                    <td><a href='book_update.php'><button class='btn btn-link'>Actualizar</button></a></td>
                    <td><a href='#'><button class='btn btn-danger'>Borrar</button></a></td>
                </tr>";
                }

                echo "</thbody></table>";
            }
            ?>
        </div>
    </div>
</div>


</body>
</html>

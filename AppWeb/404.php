<?php require_once 'includes/conection.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>404 Error - SB Admin</title>
        <link href="assets/styles/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutError">
            <div id="layoutError_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center mt-4">
                                    <img class="mb-4 img-error" src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/4f5b875f-0798-48fa-bc6d-ffaf1cd6c4c9/d6qcn8s-754d2927-bfc8-45ee-9fec-e0eeb2b78824.gif?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzRmNWI4NzVmLTA3OTgtNDhmYS1iYzZkLWZmYWYxY2Q2YzRjOVwvZDZxY244cy03NTRkMjkyNy1iZmM4LTQ1ZWUtOWZlYy1lMGVlYjJiNzg4MjQuZ2lmIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.zRYof93CJAADTm7vLKeePRlg8SsPCudhodzNZ18hKoU" />



                                        <?php if(isset($_SESSION['errores'])) :?>
                                            <p class="lead">Erorr: <?= $_SESSION['errores']['username']?></p>

                                        <?php else: ?>
                                            <p class="lead">Erorr: <?= $_SESSION['errores']['password']?></p>
                                        <?php endif; ?>
                                    <a href="new_user.php">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Return to Register new user
                                    </a>





                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutError_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

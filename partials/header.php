

<?php require 'partials/head.php' ?>

<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand m-1 " href="/login-php/index.php">Semilleros</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-3">
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="7" href="index.php">Home</a>
                </li>
                


                <?php if (!empty($user)): ?>


                    
                    
                    <li class="nav-item " style="float-end;">
                        <a class="nav-link " href="logout.php"  tabindex="-1" aria-disabled="true"> <?= $user['email']; ?> cerrar sesion </a>
                    </li>

                <?php else: ?>
                    <?php if (!empty($userEstu)): ?>


                        

                        <li class="nav-item float-end">
                            <a class="nav-link " href="logout.php" tabindex="-1" aria-disabled="true"> <?= $userEstu['correo']; ?> cerrar sesion </a>
                        </li>

                        <?php else: ?>


                            <?php if (!empty($userCor)): ?>


                            

                            <li class="nav-item " style=" float-end;">
                                <a class="nav-link " href="logout.php" tabindex="-1" aria-disabled="true"> <?= $userCor['correo']; ?> cerrar sesion </a>
                            </li>

                            <?php else: ?>


                            
                            

                        <?php endif; ?>

                     <?php endif; ?>     
                    
                <?php endif; ?>






            </ul>

        </div>
    </div>
</nav>
</header>

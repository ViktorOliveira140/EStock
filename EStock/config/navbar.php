<header>
    <!-- Navbar -->
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?= $BASE_URL ?>index.php">
                <img src="../img/logo.svg" width="30" height="30" alt="">
                E-Stock
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="home.php">
                    Home
                </a>
                <?php if ($nivelUsuario == 'Usuário' || $nivelUsuario == 'Administrador'): ?> <!-- Tanto Administrador e Usuário poderão ver o que está abaixo -->
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Estoque
                    </a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="stock.php">
                            Gerenciar
                        </a>
                        <?php endif; ?>
                        <?php if ($nivelUsuario == 'Administrador'): ?> <!-- Apenas Administrador poderá ver o que está abaixo -->
                        <a class="navbar-item" href="category.php">
                            Categorias
                        </a>
                        <a class="navbar-item" href="insert_category.php">
                            Inserir Categorias
                        </a>
                        <a class="navbar-item" href="management.php">
                            Controle de Usuários
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($nivelUsuario == 'Administrador'): ?>
                <a class="navbar-item" href="dashboard.php">
                    Dashboard
                </a>
                <?php endif; ?>
            </div>

            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-left is-hoverable">
                    <a class="navbar-link">
                        <!-- Exibe o nome do usuário -->
                        <?php echo $_SESSION['nome']; ?>
                    </a>
                    <div class="navbar-dropdown">
                        <!-- Exibe o nível do usuário -->
                        <h5 style="text-align: center"><?php echo $_SESSION['nivel']; ?></h5>
                        <form action="../database/user/logout.php" method="post">
                            <button type="submit" class="navbar-item button is-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </nav>
</header>
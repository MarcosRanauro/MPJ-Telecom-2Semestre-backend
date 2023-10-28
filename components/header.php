<body>
    <header>
        <section class="cabecalho-primario">
            <ul class="navbar-left">
                <li><a class="menu-primario" href="#">Empresas</a></li>
                <li><a class="menu-primario" href="#">Wholesale</a></li>
                <li><a class="menu-primario" href="#">Institucional</a></li>
            </ul>
            <ul class="navbar-right">
                <?php if ($_SESSION['tipo_usuario']) { ?>
                    <li>Olá, <?php echo $_SESSION['usu_login']; ?></li>
                    <?php if ($_SESSION['tipo_usuario'] === 'master') { ?>
                        <li><a class="peril-logado" href="../pages/perfilMaster.php">Meu Perfil</a></li>
                    <?php } else { ?>
                        <li><a class="peril-logado" href="../pages/perfil.php">Meu Perfil</a></li>

                    <?php } ?>
                    <li><a class="peril-logado" href="javascript:history.go(-1)">Voltar</a></li>
                    <li><a class="peril-logado" href="../index.php">Home</a></li>
                    <li><a class="peril-logado" href="../components/sair.php">Sair</a></li>

                <?php } else { ?>
                    <li><a class="menu-primario" href="#">WhatsApp</a></li>
                    <li><a class="menu-primario" href="#">FAQ</a></li>
                    <li><a class="menu-primario" href="#">Carreiras</a></li>
                    <li><a class="menu-primario" href="#">Contato</a></li>
                    <li><a class="menu-primario" href="#">Português</a></li>
                    <a class="botao-login" href="./pages/Login.php">
                        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                        <button class="botao-login-b">Área do Cliente</button>
                    </a>
                <?php } ?>
            </ul>
        </section>
        <section class="cabecalho-secundario-cpaas">
            <a href="../index.php">
                <img src="../img/mjp-att.png" alt="essa é a logo da MJP">
            </a>
            <nav>
                <ul class="menu">
                    <li class="navbar"><a class="menu-opcoes" href="#">Internet</a>
                        <ul>
                            <li><a class="submenu" href="#">Internet Dedicada</a></li>
                            <li><a class="submenu" href="#">Banda Larga</a></li>
                            <li><a class="submenu" href="#">Wi-Fi</a></li>
                        </ul>
                    </li>
                    <li class="navbar"><a class="menu-opcoes" href="#">Telefonia</a>
                        <ul>
                            <li><a class="submenu" href="#">PABX IP Virtual</a></li>
                            <li><a class="submenu" href="#">E1/SIP TRUNK</a></li>
                            <li><a class="submenu" href="#">Números 0800 e 40XX</a></li>
                        </ul>
                    </li>
                    <li class="navbar"><a class="menu-opcoes" href="#">Rede e infraestrutura</a>
                        <ul>
                            <li><a class="submenu" href="#">Ponto-a-Ponto</a></li>
                            <li><a class="submenu" href="#">MPLS</a></li>
                            <li><a class="submenu" href="#">Fibra Apagada e Dutos</a></li>
                            <li><a class="submenu" href="#">Co-locations</a></li>
                        </ul>
                    </li>
                    <li class="navbar"><a class="menu-opcoes" href="#">Mobilidade</a>
                        <ul>
                            <li><a class="submenu" href="#">Celular Empresarial</a></li>
                            <li><a class="submenu" href="#">MVNA/E</a></li>
                        </ul>
                    </li>
                    <li class="navbar"><a class="menu-opcoes" href="../pages/produto.php">CPaaS</a></li>

                    <li class="navbar"><a class="menu-opcoes" href="#">Outras soluções</a>
                        <ul>
                            <li><a class="submenu" href="#">Outsourcing de Hardware</a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </section>
    </header>
</body>
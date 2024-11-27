<?php
session_start();
include_once('php/conexao.php');

// Verifica se o usuário está logado
if (isset($_SESSION['nome']) && isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Consulta para obter apenas o usuário logado
    $sqlSelect = "SELECT id, nome, niveldeacesso FROM usuarios WHERE email = '$email'";
    $result2 = $conexao->query($sqlSelect);

    if ($result2 && $result2->num_rows > 0) {
        $user = $result2->fetch_assoc();
        // Gerar link para o próprio usuário
    } else {
        echo "Usuário não encontrado.";
    }
    
    // Seleciona a coluna 'path' apenas para o usuário logado
    $sql = "SELECT path FROM usuarios WHERE email = '$email'";
    $result = $conexao->query($sql);

    // Obtém o caminho da imagem do usuário logado
    $user_data = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <title>ADS-Filmes-Séries</title>

</head>

<body>
<?php if (isset($user_data)): ?>
    <p>Nível de Acesso: <?php echo htmlspecialchars($user['niveldeacesso']); ?></p>
<?php endif; ?>
    <header>


        <a href="#" class="logo">
            <i class='bx bxs-movie'></i> ADS Filmes e Series
        </a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#home" class="home-active">Início</a></li>
            <li><a href="#movies">Filmes</a></li>
            <li><a href="#coming">Em Breve</a></li>
            <li><a href="#newsletter">Novas Notícias</a></li>
        </ul>

            <?php if (isset($_SESSION['nome'])): ?>
    <div onclick="toggleMenu()" class="foto-container">
        <?php if (!empty($user_data['path'])): ?>

            <img class="imagem" src="../arquivos/<?php echo $user_data['path']; ?>" height="70" width="70" alt="Foto do usuário">
        <?php else: ?>
            <img class="imagem" src="img/user.png" height="70" width="70"> 
        <?php endif; ?>
    </div>

    <div class="sub-menu-wrap" id="subMenu" style="display:none;">
        <div class="sub-menu">
            <div class="user-info">
                <h2 style="color: black; font-size: 16px; display:inline-block; text-align:center;">Bem-vindo(a), <strong> <br><?php echo htmlspecialchars($_SESSION['nome']); ?>!</strong></h2>
            </div> 
            <hr>
            <?php if ($user['niveldeacesso'] == 2 || $user['niveldeacesso'] == 3): ?>
                <a href="php/sistema.php" class="sub-menu-link">
                    <ion-icon name="pencil"></ion-icon>
                    <p>Sistema</p>
                    <span>></span>
                </a>
            <?php endif; ?>
            <a href="php/DadosCliente.php?id=<?php echo $user['id']; ?>" class="sub-menu-link">
                <ion-icon name="pencil"></ion-icon>
                <p>Editar Perfil</p>
                <span>></span>
            </a>
            <a href="php/sair.php" class="sub-menu-link">
                <ion-icon name="log-out-outline"></ion-icon>
                <p>Sair</p>
                <span>></span>
            </a>
        </div>
    </div>

<?php else: ?>
    <a href="php/login.php" class="btn">Entrar</a>
<?php endif; ?>


    </header>
<br><br><br><br>
    <section class="home swiper" id="home">
        <div class="swiper-wrapper">
            <div class="swiper-slide container">
                <img src="image/home1.jpg" alt="">
                <div class="home-text">
                    <span>Universo Marvel</span>
                    <h1>Venom: Tempo de <br> Carnificina</h1>
                    <a href="#" class="btn">Veja Agora</a>
                    <a href="#" class="play">
                        <i class='bx bx-play'></i>
                    </a>
                </div>
            </div>

            <div class="swiper-slide container">
                <img src="image/home2.jpg" alt="">
                <div class="home-text">
                    <span>Universo Marvel</span>
                    <h1>Vingadores: <br> Guerra Infinita</h1>
                    <a href="#" class="btn">Veja Agora</a>
                    <a href="#" class="play">
                        <i class='bx bx-play'></i>
                    </a>
                </div>
            </div>

            <div class="swiper-slide container">
                <img src="image/home3.jpg" alt="">
                <div class="home-text">
                    <span>Universo Marvel</span>
                    <h1>Homem-Aranha: <br> Longe de Casa</h1>
                    <a href="#" class="btn">Veja Agora</a>
                    <a href="#" class="play">
                        <i class='bx bx-play'></i>
                    </a>
                </div>
            </div>


          </div>

          <div class="swiper-pagination"></div>
    </section>

    <section class="movies" id="movies">
        <h2 class="heading">Vindo essa Semana</h2>

        <div class="movies-container">
            <div class="box">
            <div class="box-img">
                <img src="image/m1.jpg" alt="">
            </div>
            <h3>Venom</h3>
            <span>120 min | Ação</span>
        </div>
            <div class="box">
            <div class="box-img">
                <img src="image/m2.jpg" alt="">
            </div>
            <h3>Dunkirk</h3>
            <span>120 min | Ação</span>
        </div>
            <div class="box">
            <div class="box-img">
                <img src="image/m3.jpg" alt="">
            </div>
            <h3>Batman vs Superman</h3>
            <span>120 min | Ação</span>
        </div>
            <div class="box">
            <div class="box-img">
                <img src="image/m4.jpg" alt="">
            </div>
            <h3>John Wick 2</h3>
            <span>120 min | Aventura</span>
        </div>
            <div class="box">
            <div class="box-img">
                <img src="image/m5.jpg" alt="">
            </div>
            <h3>Aquaman</h3>
            <span>120 min | Ação</span>
        </div>
            <div class="box">
            <div class="box-img">
                <img src="image/m6.jpg" alt="">
            </div>
            <h3>Pantera Negra</h3>
            <span>120 min | Ação</span>
        </div>
            <div class="box">
            <div class="box-img">
                <img src="image/m7.jpg" alt="">
            </div>
            <h3>Thor</h3>
            <span>120 min | Aventura</span>
        </div>
            <div class="box">
            <div class="box-img">
                <img src="image/m8.jpg" alt="">
            </div>
            <h3>Bumblebee</h3>
            <span>120 min | Ação</span>
        </div>
            <div class="box">
            <div class="box-img">
                <img src="image/m9.jpg" alt="">
            </div>
            <h3>Máquinas Mortais</h3>
            <span>120 min | Ação</span>
        </div>
            <div class="box">
            <div class="box-img">
                <img src="image/m10.jpg" alt="">
            </div>
            <h3>Anjos da Noite: Guerras de Sangue</h3>
            <span>120 min | Ação</span>
        </div>
        </div>
    </section>

    <section class="coming" id="coming">
        <h2 class="heading">Em Breve</h2>

        <div class="coming-container swiper">
            <div class="swiper-wrapper">
            <div class="swiper-slide box">
                <div class="box-img">
                    <img src="image/coming1.jpg" alt="">
                </div>
                <h3>Jhony English</h3>
                <span>120 min | Ação</span>
            </div>
                <div class="swiper-slide box">
                <div class="box-img">
                    <img src="image/coming2.jpg" alt="">
                </div>
                <h3>Warcraft</h3>
                <span>120 min | Aventura</span>
            </div>
                <div class="swiper-slide box">
                <div class="box-img">
                    <img src="image/coming3.jpg" alt="">
                </div>
                <h3>Rampage</h3>
                <span>120 min | Ação</span>
            </div>
                <div class="swiper-slide box">
                <div class="box-img">
                    <img src="image/coming4.jpg" alt="">
                </div>
                <h3>A Dama de Ferro</h3>
                <span>120 min | Aventura</span>
            </div>
                <div class="swiper-slide box">
                <div class="box-img">
                    <img src="image/coming5.jpg" alt="">
                </div>
                <h3>Liga da Justiça</h3>
                <span>120 min | Ação</span>
            </div>
                <div class="swiper-slide box">
                <div class="box-img">
                    <img src="image/coming6.jpeg" alt="">
                </div>
                <h3>Doutor Estranho</h3>
                <span>120 min | Aventura</span>
            </div>
                <div class="swiper-slide box">
                <div class="box-img">
                    <img src="image/coming7.jpg" alt="">
                </div>
                <h3>Capitã Marvel</h3>
                <span>120 min | Aventura</span>
            </div>
                <div class="swiper-slide box">
                <div class="box-img">
                    <img src="image/coming8.jpg" alt="">
                </div>
                <h3>Viúva Negra</h3>
                <span>120 min | Ação</span>
            </div>
                <div class="swiper-slide box">
                <div class="box-img">
                    <img src="image/coming9.jpg" alt="">
                </div>
                <h3>Homem Formiga</h3>
                <span>120 min | Ação</span>
            </div>
                <div class="swiper-slide box">
                <div class="box-img">
                    <img src="image/coming10.jpg" alt="">
                </div>
                <h3>Guardiões da Galáxia</h3>
                <span>120 min | Ação</span>
            </div>
            </div>
        </div>
    </section>

    <section class="newsletter" id="newsletter">
        <h2>Se increva para <br> Novas Notícias</h2>
        <form action="">
            <input type="email" class="email" placeholder="Insira um email..." required>
            <input type="submit" value="Subscribe" class="btn">
        </form>
    </section>

    <section class="footer">
        <a href="#" class="Logo">
            <i class="bx bxs-movie"></i>
        </a>
        <div class="social">
            <a href="#"><i class='bx bxl-facebook'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxl-tiktok'></i></a>
        </div>
    </section>

    <div class="copyright">
        <p>&#169; ADS - Filmes e Séries Todos os Direitos Reservados.</p>
    </div>

    <script> 
        function toggleMenu() {
    var menu = document.getElementById('subMenu');
    if (menu.style.display === 'none' || menu.style.display === '') {
        menu.style.display = 'block';
    } else {
        menu.style.display = 'none';
    }
}

    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/login.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
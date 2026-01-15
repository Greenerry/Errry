<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: pages/login.php");
    exit();
}
$base_path = './';
include 'includes/head.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>ERRY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-black w3-padding">
            <a href="index.php" class="w3-bar-item w3-button logo">ERRY</a>
            <div class="w3-right">
                <a href="pages/profile.php" class="w3-bar-item w3-button"><i class="fas fa-user"></i></a>
                <a href="pages/cart.php" class="w3-bar-item w3-button"><i class="fas fa-shopping-cart"></i></a>
                <a href="pages/logout.php" class="w3-bar-item w3-button">Sair</a>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="w3-content w3-padding-64 w3-container" style="max-width:1600px">
        <header class="w3-center w3-padding-32">
            <h1 class="w3-text-white">Produtos em Destaque</h1>
        </header>
        
        <div class="w3-content" style="max-width:1600px">
            <div class="w3-row-padding" style="padding:0 32px">
                <div class="w3-col m6" style="margin-bottom:48px;padding:0 24px">
                    <div class="w3-card w3-black vinyl-item" data-src="assets/songs/the hellp - stunn.mp3" style="max-width:650px;margin:0 auto">
                        <div class="vinyl-cover">
                            <img src="assets/images/LL.jpg" alt="Album One" class="w3-image">
                            <div class="play-overlay">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                        <div class="vinyl-info w3-container w3-padding w3-center">
                            <h3>LL</h3>
                            <p class="artist">The Hellp</p>
                            <p class="price">$59.99</p>
                            <div class="album-buttons" style="display:flex;gap:5px;justify-content:center">
                                <button class="w3-button w3-white btn-buy" style="width:40%;padding:8px 4px">Comprar</button>
                                <button class="w3-button w3-transparent w3-border w3-border-white btn-cart" style="width:40%;padding:8px 4px">Carrinho</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w3-col m6" style="margin-bottom:48px;padding:0 24px">
                    <div class="w3-card w3-black vinyl-item" data-src="assets/songs/cities aviv_ Black pleasure.mp3" style="max-width:650px;margin:0 auto">
                        <div class="vinyl-cover">
                            <img src="assets/images/MAN PLAYS THE HORN.jpg" alt="Album Two" class="w3-image">
                            <div class="play-overlay">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                        <div class="vinyl-info w3-container w3-padding w3-center">
                            <h3>MAN PLAYS THE HORN</h3>
                            <p class="artist">Cities Aviv</p>
                            <p class="price">$79.99</p>
                            <div class="album-buttons" style="display:flex;gap:5px;justify-content:center">
                                <button class="w3-button w3-white btn-buy" style="width:40%;padding:8px 4px">Comprar</button>
                                <button class="w3-button w3-transparent w3-border w3-border-white btn-cart" style="width:40%;padding:8px 4px">Carrinho</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w3-row-padding" style="padding:0 32px">
                <div class="w3-col m6" style="margin-bottom:48px;padding:0 24px">
                    <div class="w3-card w3-black vinyl-item" data-src="assets/songs/Me oh myriorama - Fanta seaworld.mp3" style="max-width:650px;margin:0 auto">
                        <div class="vinyl-cover">
                            <img src="assets/images/Iris.jpg" alt="Album THREE" class="w3-image">
                            <div class="play-overlay">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                        <div class="vinyl-info w3-container w3-padding w3-center">
                            <h3>Iris</h3>
                            <p class="artist">Me oh myriorama</p>
                            <p class="price">$49.99</p>
                            <div class="album-buttons" style="display:flex;gap:5px;justify-content:center">
                                <button class="w3-button w3-white btn-buy" style="width:40%;padding:8px 4px">Comprar</button>
                                <button class="w3-button w3-transparent w3-border w3-border-white btn-cart" style="width:40%;padding:8px 4px">Carrinho</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w3-col m6" style="margin-bottom:48px;padding:0 24px">
                    <div class="w3-card w3-black vinyl-item" data-src="assets/songs/Somalia Park.mp3" style="max-width:650px;margin:0 auto">
                        <div class="vinyl-cover">
                            <img src="assets/images/SOUL ON FIRE.webp" alt="Album FOUR" class="w3-image">
                            <div class="play-overlay">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                        <div class="vinyl-info w3-container w3-padding w3-center">
                            <h3>SOUL ON FIRE</h3>
                            <p class="artist">Dean Blunt</p>
                            <p class="price">$49.99</p>
                            <div class="album-buttons" style="display:flex;gap:5px;justify-content:center">
                                <button class="w3-button w3-white btn-buy" style="width:40%;padding:8px 4px">Comprar</button>
                                <button class="w3-button w3-transparent w3-border w3-border-white btn-cart" style="width:40%;padding:8px 4px">Carrinho</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="audio-player"></audio>
    <script src="assets/js/player.js"></script>
    <script src="assets/js/bounce.js"></script>
    <script src="assets/js/cart.js"></script>

<?php include 'includes/footer.php'; ?>

</body>
</html> 
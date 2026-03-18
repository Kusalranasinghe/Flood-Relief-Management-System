<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flood Relief Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="has-video">

    <div class="video-bg-wrapper">
        <video autoplay muted loop playsinline class="video-bg" style="filter: blur(8px);">
            <source src="flood.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    </div>

    <header class="navbar">
        <div class="logo">#HelpSriLanka</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="#about">About</a>
            <a href="#footer">Contact</a>
            <button class="btn-login" style="width:auto;padding:10px 24px;" onclick="window.location.href='adminlogin.php'">Admin Login</button>
        </nav>
    </header>

    <section class="hero">
        <div class="badge">🔴 Emergency Flood Help and Resources</div>
        <h1>
            FLOOD RELIEF<br>
            <span>SUPPORT CENTER</span>
        </h1>
        <p>
            Digital platform supporting flood affected people in Sri Lanka.
            Sign in or register to submit your flood relief request and get help fast.
        </p>
        <div class="buttons">
            <button class="primary" onclick="window.location.href='userlogin.php'">SIGN IN</button>
            <button class="secondary" onclick="window.location.href='userregister.php'">REGISTER</button>
        </div>
    </section>

    <div class="section-divider"></div>

    <section id="about">
        <div class="about-container">
            <h1 class="about-title">About Us</h1>
            <p class="about-text">
                The Flood Relief Management Center is a digital platform dedicated to supporting communities affected by
                floods by providing timely information, coordination of relief services, and emergency assistance.
                Our goal is to connect victims, volunteers, and relief organizations in one centralized system to
                ensure faster response and efficient distribution of resources.
            </p>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>
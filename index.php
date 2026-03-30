<?php
// index.php – main controller

// Determine which page to show (default to 'home')
$page = $_GET['page'] ?? 'home';

// Site name for dynamic titles
$site_name = "Hakima Chabane's Helpful Crane | WEB250 PHP Site";

// Map page names to content files (inside contents/)
$allowed_pages = [
    'home'         => 'contents/index.php',
    'introduction' => 'contents/introduction.php',
    'contract'     => 'contents/contract.php'
];

// Get the content file, fallback to home.php if page is invalid
$content = $allowed_pages[$page] ?? 'contents/home.php';

// Dynamic page title
$title = $site_name . " | " . ucfirst($page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="styles/default.css">
</head>
<body>

<header>
    <h1>Hakima Chabane's Helpful Crane | WEB250</h1>
    <nav>
        <a href="index.php?page=index">Home</a> |
        <a href="index.php?page=introduction">Introduction</a> |
        <a href="index.php?page=contract">Contract</a>
    </nav>
</header>

<main>
    <?php include($content); ?>
</main>

<footer>
    <p>Page built by Hakima Chabane</p>
    <p>
        <a href="https://github.com/hakima16/" target="_blank">GitHub</a> |
        <a href="https://hakima16.github.io/" target="_blank">GitHub.io</a> |
        <a href="https://hakima16.github.io/web115/" target="_blank">WEB115</a> |
        <a href="https://hakima16.github.io/web250" target="_blank">WEB250</a> |
        <a href="https://hakima16.github.io/web215" target="_blank">WEB215</a> |
        <a href="https://www.freecodecamp.org/kima16" target="_blank">freeCodeCamp</a> |
        <a href="https://www.codecademy.com/profiles/kima16" target="_blank">Codecademy</a> |
        <a href="https://www.linkedin.com/in/hakima-chabane-08674a1a4/" target="_blank">LinkedIn</a>
    </p>
</footer>

</body>
</html>
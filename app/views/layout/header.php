<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo htmlspecialchars($data["title"]); ?></title>
<link href="/assets/css/reset.css" rel="stylesheet">
<link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
<header>
    <a href="/" class="menu-home mob-see"><img src="/assets/pic/logo-mob.svg" alt="Logo" class="logo"></a>
    <a href="#"><img class="flag mob-see" src="/assets/pic/lang-engl.png" alt="flag" title="English"></a>
    <label class="menu-toggle-label" aria-label="Toggle flyout menu" onclick="toggleElements()">
        <img src="/assets/pic/logo-so/menu.svg" alt="Menu" class="menu-toggle">
    </label>
    <label class="close mob-see" aria-label="Toggle flyout menu" onclick="reloadPage()">
        <img src="/assets/pic/logo-so/close.svg" alt="close" class="close-toggle">
    </label>

    <div class="menu-flyout">
        <nav class="menu-main">
            <a href="#about-me">About me</a>
            <a href="#skills">Skills</a>
            <a href="#portfolio">Portfolio</a>
            <a id="contact-me" href="#contact">CONTACT ME</a>
        </nav>
        <a href="#"><img class="flag" src="/assets/pic/lang-engl.png" alt="flag" title="English"></a>
    </div>
</header>
<body>
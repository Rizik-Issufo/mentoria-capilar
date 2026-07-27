<?php require_once __DIR__ . '/config.php'; ?>
<!doctype html>
<html lang="pt-MZ">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($tituloPagina) ? htmlspecialchars($tituloPagina) . ' — ' : '' ?><?= MARCA_NOME ?> · Mentoria Capilar
  </title>
  <meta name="description"
    content="Mentoria de capilarização com <?= htmlspecialchars(MENTORA_NOME) ?>: rotinas personalizadas, aulas ao vivo com partilha de ecrã e manual digital.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Jost:wght@400;500;600&family=Space+Mono:wght@400;700&display=swap"
    rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-coroa fixed-top" id="navbarPrincipal">
    <div class="container">
      <a class="navbar-brand" href="index.php"><span>Ekharari</span></a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link" href="index.php#sobre">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#mentorias">Mentorias</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#aula-ao-vivo">Aula ao Vivo</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#manual">Manual</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#galeria">Galeria</a></li>
          <li class="nav-item ms-lg-2">
            <a class="btn-whatsapp"
              href="<?= link_whatsapp('Olá ' . MENTORA_NOME . '! Vim pelo site e quero saber mais sobre as mentorias de capilarização.') ?>"
              target="_blank" rel="noopener">
              <i class="fa-brands fa-whatsapp"></i> Falar Agora
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
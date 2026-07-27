<?php
require_once __DIR__ . '/includes/config.php';
$tituloPagina = 'Sala de aula em directo';

$papel = ($_GET['papel'] ?? 'aluna') === 'mentora' ? 'mentora' : 'aluna';
$salaPreenchida = htmlspecialchars($_GET['sala'] ?? '');

require __DIR__ . '/includes/header.php';
?>

<header class="hero" style="padding-top:8.5rem; padding-bottom:2.5rem;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <p class="eyebrow justify-content-center mb-3">Sala Online · Directo</p>
        <h1 class="display mb-3">
          <?= $papel === 'mentora' ? 'Painel da Mentora' : 'Entrar na Aula' ?>
        </h1>
        <p class="lead mx-auto" style="max-width:55ch;">
          <?= $papel === 'mentora'
            ? 'Cria a sala, partilha o código com as tuas mentoradas e ativa a partilha de ecrã quando quiseres demonstrar uma técnica.'
            : 'Introduz o código da sala que a mentora enviou no WhatsApp para entrares na aula.' ?>
        </p>
      </div>
    </div>
  </div>
</header>

<section style="padding-top:0;">
  <div class="container">

    <!-- Painel de configuração da sala -->
    <div class="row justify-content-center mb-4">
      <div class="col-lg-8">
        <div class="painel-coroa">
          <div class="row g-3 align-items-end form-coroa">
            <div class="col-md-4">
              <label>Entrar como</label>
              <select id="papelSelect" class="form-select">
                <option value="aluna" <?= $papel === 'aluna' ? 'selected' : '' ?>>Aluna</option>
                <option value="mentora" <?= $papel === 'mentora' ? 'selected' : '' ?>>Mentora</option>
              </select>
            </div>
            <div class="col-md-5">
              <label
                id="labelSala"><?= $papel === 'mentora' ? 'Código da sala (deixa em branco para gerar)' : 'Código da sala' ?></label>
              <input type="text" id="salaInput" class="form-control" placeholder="ex: Cabelo-123"
                value="<?= $salaPreenchida ?>">
            </div>
            <div class="col-md-3">
              <button id="btnEntrar" class="btn-copper w-100"><i class="fa-solid fa-door-open me-1"></i> Entrar na
                sala</button>
            </div>
          </div>
          <p id="statusTexto" class="text-secondary small mt-3 mb-0">Preenche os dados e clica em "Entrar na sala" para
            ligar câmara e microfone.</p>
        </div>
      </div>
    </div>

    <!-- Sala de vídeo -->
    <div id="salaVideo" class="d-none">
      <div class="row justify-content-center mb-3">
        <div class="col-lg-8 text-center">
          <span class="badge rounded-pill" style="background:var(--sage); font-family:var(--font-mono);">
            Código da sala: <strong id="codigoAtual">—</strong>
          </span>
        </div>
      </div>

      <div class="live-mock mx-auto" style="max-width:900px;">
        <div class="screen" id="telaPrincipal">
          <span class="pill"><span class="dot"></span> <span id="painelStatus">Ao vivo</span></span>
          <video id="videoRemoto" autoplay playsinline style="width:100%;height:100%;object-fit:cover;"></video>
          <div class="cam">
            <video id="videoLocal" autoplay playsinline muted style="width:100%;height:100%;object-fit:cover;"></video>
          </div>
        </div>
        <div class="toolbar">
          <span id="btnMic" role="button" title="Silenciar/Ativar microfone"><i
              class="fa-solid fa-microphone"></i></span>
          <span id="btnCam" role="button" title="Ligar/Desligar câmara"><i class="fa-solid fa-video"></i></span>
          <span id="btnTela" role="button" title="Partilhar ecrã"><i class="fa-solid fa-display"></i></span>
          <span id="btnSair" role="button" title="Sair da chamada"><i class="fa-solid fa-phone-slash"></i></span>
        </div>
      </div>

      <p class="text-center text-secondary small mt-3">
        Participantes na sala: <span id="contadorParticipantes">1</span>
      </p>
    </div>

  </div>
</section>

<script src="https://unpkg.com/peerjs@1.5.4/dist/peerjs.min.js"></script>
<script src="js/chamada.js"></script>

<?php require __DIR__ . '/includes/footer.php'; ?>
<?php
require_once __DIR__ . '/includes/config.php';
session_start();

$pedido = $_SESSION['ultimo_pedido'] ?? null;
if (!$pedido || ($_GET['pedido'] ?? '') !== $pedido['id']) {
    header('Location: comprar.php');
    exit;
}

$tituloPagina = 'Pedido Recebido';
$mensagemWpp = "Olá " . MENTORA_NOME . "! Fiz o pedido do Manual Coroa Real.\n"
    . "Pedido: {$pedido['id']}\n"
    . "Nome: {$pedido['nome']}\n"
    . "Forma de pagamento: {$pedido['metodo']}\n"
    . "Podes confirmar os dados para eu finalizar o pagamento?";

require __DIR__ . '/includes/header.php';
?>

<header class="hero" style="padding-top:9rem;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-7 text-center">
        <p class="eyebrow justify-content-center mb-3">Pedido nº <?= htmlspecialchars($pedido['id']) ?></p>
        <h1 class="display mb-3">Falta só um passo, <?= htmlspecialchars(explode(' ', $pedido['nome'])[0]) ?>!</h1>
        <p class="lead mx-auto mb-4" style="max-width:55ch;">Recebemos o teu pedido do manual. Agora é só confirmar o pagamento diretamente comigo pelo WhatsApp para receberes o PDF na hora.</p>
        <a href="<?= link_whatsapp($mensagemWpp) ?>" class="btn-whatsapp" target="_blank" rel="noopener">
          <i class="fa-brands fa-whatsapp"></i> Finalizar no WhatsApp
        </a>
        <p class="mt-4"><a href="index.php" class="text-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Voltar à página inicial</a></p>
      </div>
    </div>
  </div>
</header>

<?php require __DIR__ . '/includes/footer.php'; ?>

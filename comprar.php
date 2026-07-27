<?php
require_once __DIR__ . '/includes/config.php';
$tituloPagina = 'Comprar Manual';

$erros = [];
if (isset($_GET['erro'])) {
    $mapa = [
        'campos' => 'Preenche o nome e o WhatsApp para continuar.',
        'whatsapp' => 'Verifica o número de WhatsApp introduzido.',
    ];
    $erros[] = $mapa[$_GET['erro']] ?? 'Verifica os dados e tenta novamente.';
}

require __DIR__ . '/includes/header.php';
?>

<header class="hero" style="padding-top:8.5rem;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <p class="eyebrow justify-content-center mb-3">Manual Digital</p>
        <h1 class="display mb-3"><?= htmlspecialchars($MANUAL['nome']) ?></h1>
        <p class="lead mx-auto" style="max-width:60ch;"><?= htmlspecialchars($MANUAL['descricao']) ?></p>
      </div>
    </div>
  </div>
</header>

<section style="padding-top:0;">
  <div class="container">
    <div class="row g-5 justify-content-center">

      <div class="col-lg-4">
        <div class="book-cover mb-4">
          <div>
            <p class="book-eyebrow">Coroa Real · Edição Digital</p>
            <h3><?= htmlspecialchars($MANUAL['nome']) ?></h3>
          </div>
          <div class="book-foot">
            <span><?= $MANUAL['paginas'] ?> páginas</span>
            <span>PDF</span>
          </div>
        </div>
        <p class="plano-preco text-center"><?= formatar_preco($MANUAL['preco']) ?></p>
      </div>

      <div class="col-lg-6">
        <div class="painel-coroa">
          <h2 class="h4 mb-4">Os teus dados para a compra</h2>

          <?php if ($erros): ?>
            <div class="alert alert-danger">
              <?php foreach ($erros as $e): ?><div><?= htmlspecialchars($e) ?></div><?php endforeach; ?>
            </div>
          <?php endif; ?>

          <form class="form-coroa" action="processar_compra.php" method="post" novalidate>
            <div class="mb-3">
              <label for="nome">Nome completo</label>
              <input type="text" class="form-control" id="nome" name="nome" required
                     value="<?= htmlspecialchars($_GET['nome'] ?? '') ?>">
            </div>
            <div class="mb-3">
              <label for="whatsapp">Número de WhatsApp</label>
              <input type="tel" class="form-control" id="whatsapp" name="whatsapp" placeholder="Ex: 84 123 4567" required
                     value="<?= htmlspecialchars($_GET['whatsapp'] ?? '') ?>">
            </div>
            <div class="mb-3">
              <label for="email">E-mail (opcional)</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-4">
              <label for="metodo">Forma de pagamento preferida</label>
              <select class="form-select" id="metodo" name="metodo">
                <option value="M-Pesa">M-Pesa</option>
                <option value="E-Mola">E-Mola</option>
                <option value="Transferência bancária">Transferência bancária</option>
                <option value="A combinar no WhatsApp">A combinar no WhatsApp</option>
              </select>
            </div>
            <button type="submit" class="btn-copper w-100">
              <i class="fa-solid fa-cart-shopping me-1"></i> Continuar para o WhatsApp
            </button>
            <p class="text-secondary small mt-3 mb-0 text-center">Depois de enviares, abrimos o WhatsApp com o teu pedido pronto para confirmares o pagamento com <?= MENTORA_NOME ?>.</p>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

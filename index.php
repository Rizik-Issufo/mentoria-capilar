<?php
require_once __DIR__ . '/includes/config.php';
$tituloPagina = 'Início';
require __DIR__ . '/includes/header.php';
?>

<!-- ============ HERO ============ -->
<header class="hero">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <p class="eyebrow mb-3">Mentoria de Capilarização</p>
        <h1 class="display mb-4">O teu cabelo tem uma <em>coroa</em> para mostrar. Eu ensino-te a cuidar dela.</h1>
        <p class="lead mb-4">Sou <?= MENTORA_NOME ?> e acompanho mulheres que querem recuperar o crescimento, a força e
          o brilho do cabelo — com rotina personalizada, aulas ao vivo e suporte direto no WhatsApp.</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="<?= link_whatsapp('Olá ' . MENTORA_NOME . '! Quero começar a minha mentoria de capilarização.') ?>"
            class="btn-whatsapp" target="_blank" rel="noopener">
            <i class="fa-brands fa-whatsapp"></i> Falar no WhatsApp
          </a>
          <a href="#mentorias" class="btn-outline-copper">Ver Mentorias e Preços</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="position-relative">
          <div class="hero-frame">
            <img src="https://images.unsplash.com/photo-1632765854612-9b02b6ec2b15?auto=format&fit=crop&w=1000&q=80"
              alt="Mulher com afro sorrindo, cabelo saudável e volumoso">
          </div>
          <div class="hero-badge">
            <strong>+500</strong>
            <small>mentoradas já transformaram a rotina capilar</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<?php include __DIR__ . '/includes/curl-divider.php'; ?>

<!-- ============ SOBRE ============ -->
<section id="sobre">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <div class="mentor-photo">
          <img src="https://images.unsplash.com/photo-1613876214872-a73df2a1b8bc?auto=format&fit=crop&w=900&q=80"
            alt="Retrato profissional da mentora capilar Nádia Cossa">
        </div>
      </div>
      <div class="col-lg-7">
        <p class="eyebrow mb-3">Quem te acompanha</p>
        <h2 class="display mb-3">Olá, eu sou a <?= MENTORA_NOME ?></h2>
        <p class="text-secondary mb-4">Há mais de 4 anos ajudo mulheres a entenderem o próprio tipo de cabelo, a
          montarem uma rotina realista e a recuperarem cabelos danificados por químicos, calor e falta de cuidado. A
          minha missão é simples: nenhum cabelo é impedido de crescer.</p>
        <ul class="credencial-lista list-unstyled">
          <li>Especialista em tricologia capilar aplicada</li>
          <li>Mais de 100 mentoradas atendidas em Moçambique</li>
          <li>Formadora de capilarizadoras profissionais</li>
          <li>Aulas ao vivo com demonstração prática em tempo real</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/curl-divider.php'; ?>

<!-- ============ MENTORIAS / PREÇOS ============ -->
<section id="mentorias" class="section-alt">
  <div class="container">
    <div class="text-center mb-5">
      <p class="eyebrow justify-content-center mb-3">Preçário</p>
      <h2 class="display">Escolhe a mentoria certa para ti</h2>
      <p class="text-secondary mx-auto" style="max-width:60ch;">Todos os planos incluem contacto direto comigo via
        WhatsApp. Toca em "Quero este plano" e a conversa já começa com os detalhes certos.</p>
    </div>
    <div class="row g-4">
      <?php foreach ($PLANOS as $plano): ?>
        <div class="col-lg-4">
          <div class="card-plano <?= $plano['destaque'] ? 'destaque' : '' ?>">
            <?php if ($plano['destaque']): ?>
              <p class="plano-tag">★ Mais Procurada</p><?php endif; ?>
            <h3 class="display h4 mb-0"><?= htmlspecialchars($plano['nome']) ?></h3>
            <p class="plano-preco"><?= formatar_preco($plano['preco']) ?> <small>/
                <?= htmlspecialchars($plano['periodo']) ?></small></p>
            <p class="plano-desc"><?= htmlspecialchars($plano['descricao']) ?></p>
            <ul class="plano-beneficios">
              <?php foreach ($plano['beneficios'] as $b): ?>
                <li><?= htmlspecialchars($b) ?></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?= link_whatsapp('Olá ' . MENTORA_NOME . '! Quero este plano: ' . $plano['nome'] . ' (' . formatar_preco($plano['preco']) . '). Pode me explicar os próximos passos?') ?>"
              class="btn-whatsapp justify-content-center mt-auto" target="_blank" rel="noopener">
              <i class="fa-brands fa-whatsapp"></i> Quero este plano
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/curl-divider.php'; ?>

<!-- ============ AULA AO VIVO ============ -->
<section id="aula-ao-vivo">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 order-lg-2">
        <p class="eyebrow mb-3">Sala Online</p>
        <h2 class="display mb-3">Aulas ao vivo, com partilha de ecrã</h2>
        <p class="text-secondary mb-4">Nas mentorias com acompanhamento, as aulas acontecem numa sala de vídeo própria
          do site. Eu partilho o ecrã para mostrar produtos, técnicas e cronogramas passo a passo — como se estivesses
          ao meu lado.</p>
        <ul class="credencial-lista list-unstyled mb-4">
          <li>Vídeo e áudio direto do navegador, sem instalar nada</li>
          <li>Partilha de ecrã da mentora durante a demonstração</li>
          <li>Sala privada por código, só para ti e a tua turma</li>
        </ul>
        <div class="d-flex flex-wrap gap-3">
          <a href="chamada.php?papel=aluna" class="btn-copper"><i class="fa-solid fa-video me-1"></i> Entrar numa
            aula</a>
          <a href="chamada.php?papel=mentora" class="btn-outline-copper">Sou a mentora</a>
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <div class="live-mock">
          <div class="screen">
            <span class="pill"><span class="dot"></span> Ao vivo</span>
            <img src="https://images.unsplash.com/photo-1634449571010-02389ed0f9b0?auto=format&fit=crop&w=900&q=80"
              alt="Demonstração de tratamento capilar durante aula ao vivo">
            <div class="cam">
              <img src="https://images.unsplash.com/photo-1577746838851-816a43ca8733?auto=format&fit=crop&w=200&q=80"
                alt="Câmara da aluna ligada durante a aula">
            </div>
          </div>
          <div class="toolbar">
            <span><i class="fa-solid fa-microphone"></i></span>
            <span><i class="fa-solid fa-video"></i></span>
            <span><i class="fa-solid fa-display"></i></span>
            <span><i class="fa-solid fa-phone-slash"></i></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/curl-divider.php'; ?>

<!-- ============ MANUAL DIGITAL ============ -->
<section id="manual" class="section-alt">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <div class="book-cover mx-auto" style="max-width:320px;">
          <div>
            <p class="book-eyebrow">Ekharari · Edição Digital</p>
            <h3><?= htmlspecialchars($MANUAL['nome']) ?></h3>
          </div>
          <div class="book-foot">
            <span><?= $MANUAL['paginas'] ?> páginas</span>
            <span>PDF</span>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <p class="eyebrow mb-3">Manual Digital</p>
        <h2 class="display mb-3"><?= htmlspecialchars($MANUAL['nome']) ?></h2>
        <p class="text-secondary mb-4"><?= htmlspecialchars($MANUAL['descricao']) ?></p>
        <ul class="credencial-lista list-unstyled mb-4">
          <li>Cronograma capilar semana a semana</li>
          <li>Receitas para hidratação, nutrição e reconstrução</li>
          <li>Ficha de diagnóstico para identificares o teu tipo de cabelo</li>
          <li>Acesso imediato após a confirmação da compra</li>
        </ul>
        <div class="d-flex align-items-center flex-wrap gap-4">
          <p class="plano-preco mb-0"><?= formatar_preco($MANUAL['preco']) ?></p>
          <a href="comprar.php" class="btn-copper"><i class="fa-solid fa-cart-shopping me-1"></i> Comprar o Manual</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/curl-divider.php'; ?>

<!-- ============ GALERIA ============ -->
<section id="galeria">
  <div class="container">
    <div class="text-center mb-5">
      <p class="eyebrow justify-content-center mb-3">Inspiração</p>
      <h2 class="display">Cuidado capilar em cada detalhe</h2>
    </div>
    <div class="row g-3">
      <div class="col-6 col-md-4">
        <div class="galeria-item">
          <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=700&q=80"
            alt="Mulher com cabelo cuidado em frente a parede rosa">
        </div>
      </div>
      <div class="col-6 col-md-4">
        <div class="galeria-item">
          <img src="https://images.unsplash.com/photo-1595475884562-073c30d45670?auto=format&fit=crop&w=700&q=80"
            alt="Escova de cabelo profissional">
        </div>
      </div>
      <div class="col-6 col-md-4">
        <div class="galeria-item">
          <img src="https://images.unsplash.com/photo-1664293282001-0363011a3cc9?auto=format&fit=crop&w=700&q=80"
            alt="Mulher com cabelo cacheado natural">
        </div>
      </div>
      <div class="col-6 col-md-4">
        <div class="galeria-item">
          <img src="https://images.unsplash.com/photo-1632765866070-3fadf25d3d5b?auto=format&fit=crop&w=700&q=80"
            alt="Mulher penteando o cabelo afro com pente">
        </div>
      </div>
      <div class="col-6 col-md-4">
        <div class="galeria-item">
          <img src="https://images.unsplash.com/photo-1580618672591-eb180b1a973f?auto=format&fit=crop&w=700&q=80"
            alt="Tratamento capilar com secador">
        </div>
      </div>
      <div class="col-6 col-md-4">
        <div class="galeria-item">
          <img src="https://images.unsplash.com/photo-1535588706069-af8f2d837332?auto=format&fit=crop&w=700&q=80"
            alt="Mulher em pé junto a parede branca, cabelo natural">
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/curl-divider.php'; ?>

<!-- ============ DEPOIMENTOS ============ -->
<section class="section-alt">
  <div class="container">
    <div class="text-center mb-5">
      <p class="eyebrow justify-content-center mb-3">Resultados</p>
      <h2 class="display">O que dizem as mentoradas</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="depoimento">
          <div class="estrelas">★★★★★</div>
          <p class="mt-3">Em três meses o meu cabelo parou de quebrar na nuca. A rotina era simples de seguir e as aulas
            ao vivo ajudaram muito a perceber onde eu errava.</p>
          <p class="autor">— Cátia M., Maputo</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="depoimento">
          <div class="estrelas">★★★★★</div>
          <p class="mt-3">O manual digital ficou guardado no telemóvel e uso todas as semanas. Vale cada metical
            investido.</p>
          <p class="autor">— Denise A., Nampula</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="depoimento">
          <div class="estrelas">★★★★★</div>
          <p class="mt-3">Fiz a formação de capilarizadoras e hoje atendo clientes em casa. A mentoria de negócio fez
            toda a diferença.</p>
          <p class="autor">— Ivone S., Matola</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA FINAL ============ -->
<section class="text-center">
  <div class="container">
    <p class="eyebrow justify-content-center mb-3">Vamos começar?</p>
    <h2 class="display mb-4">A tua coroa merece cuidado hoje</h2>
    <a href="<?= link_whatsapp('Olá ' . MENTORA_NOME . '! Vim pelo site e quero começar a minha mentoria de capilarização.') ?>"
      class="btn-whatsapp" target="_blank" rel="noopener">
      <i class="fa-brands fa-whatsapp"></i> Falar com <?= MENTORA_NOME ?> agora
    </a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
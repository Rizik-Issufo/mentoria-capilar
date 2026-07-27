<footer class="footer-coroa">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="navbar-brand mb-3">Ekharari</div>
        <p class="opacity-75">Mentoria de capilarização com acompanhamento próximo, aulas ao vivo e material de apoio para transformar a relação com o teu cabelo.</p>
      </div>
      <div class="col-lg-2 col-6">
        <p class="fw-bold text-uppercase small" style="letter-spacing:.08em;">Navegação</p>
        <ul class="list-unstyled d-flex flex-column gap-2 opacity-75">
          <li><a href="index.php#sobre">Sobre</a></li>
          <li><a href="index.php#mentorias">Mentorias</a></li>
          <li><a href="index.php#aula-ao-vivo">Aula ao Vivo</a></li>
          <li><a href="index.php#manual">Manual</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-6">
        <p class="fw-bold text-uppercase small" style="letter-spacing:.08em;">Sala Online</p>
        <ul class="list-unstyled d-flex flex-column gap-2 opacity-75">
          <li><a href="chamada.php?papel=mentora">Entrar como mentora</a></li>
          <li><a href="chamada.php?papel=aluna">Entrar como aluna</a></li>
        </ul>
      </div>
      <div class="col-lg-4">
        <p class="fw-bold text-uppercase small" style="letter-spacing:.08em;">Contacto</p>
        <p class="opacity-75 mb-2"><i class="fa-brands fa-whatsapp me-2"></i><?= WHATSAPP_NUMERO ?></p>
        <a class="btn-whatsapp" href="<?= link_whatsapp('Olá ' . MENTORA_NOME . '! Tenho uma dúvida antes de escolher a mentoria.') ?>" target="_blank" rel="noopener">
          <i class="fa-brands fa-whatsapp"></i> Enviar mensagem
        </a>
      </div>
    </div>
    <hr class="border-secondary opacity-25 my-4">
    <p class="text-center small opacity-50 mb-0">&copy; <?= date('Y') ?> Ekharari Mentoria Capilar. Todos os direitos reservados.</p>
  </div>
</footer>

<a href="<?= link_whatsapp('Olá ' . MENTORA_NOME . '! Vim pelo site da Ekharari e quero mais informações.') ?>"
   class="whatsapp-float" target="_blank" rel="noopener" aria-label="Falar no WhatsApp">
  <i class="fa-brands fa-whatsapp"></i>
</a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>

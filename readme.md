# Coroa Real — Site de Mentoria Capilar

Site completo em HTML + Bootstrap 5 + PHP para divulgar mentorias de capilarização,
com contacto direto via WhatsApp, preçário, venda de manual digital e sala de
aula ao vivo com partilha de ecrã.

## Como colocar a funcionar

**Requisitos:** PHP 8+ (com extensão `session`, incluída por padrão).

1. Copia a pasta `mentoria-capilar` para o teu servidor (qualquer hospedagem
   com PHP: Hostinger, cPanel, etc.) ou testa localmente:
   ```bash
   cd mentoria-capilar
   php -S localhost:8000
   ```
   Depois abre `http://localhost:8000` no navegador.

2. **Configura o teu número de WhatsApp** em `includes/config.php`:
   ```php
   define('WHATSAPP_NUMERO', '258841234567'); // formato internacional, sem "+"
   ```
   Também podes ajustar aqui o nome da mentora, os planos de mentoria, os
   preços e os dados do manual digital.

3. A pasta `data/` guarda os pedidos de compra do manual num ficheiro
   `pedidos.json` (substitui por uma base de dados real se preferires mais
   tarde). Garante que essa pasta tem permissão de escrita no servidor:
   ```bash
   chmod 775 data
   ```

## Sobre a sala de aula ao vivo

A videochamada usa [PeerJS](https://peerjs.com/) (WebRTC) através da rede de
sinalização gratuita do PeerJS Cloud — não precisas de configurar servidor
próprio. Funciona assim:

1. A mentora entra em `chamada.php?papel=mentora`, cria a sala (recebe um
   código curto) e partilha esse código com as mentoradas pelo WhatsApp.
2. A aluna entra em `chamada.php?papel=aluna`, introduz o código e liga-se.
3. O botão de "partilhar ecrã" troca o vídeo da câmara pelo ecrã em tempo
   real para todos os participantes ligados.

Para uso profissional com muitas alunas em simultâneo, recomenda-se mais
tarde migrar para um serviço de vídeo dedicado (Daily.co, Twilio, Jitsi
self-hosted, etc.), mas esta versão já funciona de imediato, sem custos.

## Imagens

As imagens usadas são fotografias do banco gratuito Unsplash (licença livre
para uso comercial). Substitui os links `https://images.unsplash.com/...`
em `index.php` pelas tuas próprias fotos sempre que quiseres.

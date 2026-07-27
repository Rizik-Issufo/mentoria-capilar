/**
 * Sala de aula ao vivo — Coroa Real
 * WebRTC via PeerJS (sinalização na nuvem gratuita do PeerJS).
 * A mentora cria a sala (peer host); a aluna liga-se pelo código da sala.
 */
(function () {
  const papelSelect      = document.getElementById('papelSelect');
  const salaInput         = document.getElementById('salaInput');
  const labelSala         = document.getElementById('labelSala');
  const btnEntrar         = document.getElementById('btnEntrar');
  const statusTexto       = document.getElementById('statusTexto');
  const salaVideo         = document.getElementById('salaVideo');
  const codigoAtual       = document.getElementById('codigoAtual');
  const videoLocal        = document.getElementById('videoLocal');
  const videoRemoto       = document.getElementById('videoRemoto');
  const painelStatus      = document.getElementById('painelStatus');
  const contadorEl        = document.getElementById('contadorParticipantes');
  const btnMic            = document.getElementById('btnMic');
  const btnCam            = document.getElementById('btnCam');
  const btnTela           = document.getElementById('btnTela');
  const btnSair           = document.getElementById('btnSair');

  const PREFIXO = 'coroareal-';

  let peer = null;
  let localStream = null;
  let cameraTrack = null;
  let chamadasAtivas = new Map(); // peerId -> MediaConnection
  let micAtivo = true;
  let camAtiva = true;
  let partilhandoTela = false;

  papelSelect.addEventListener('change', function () {
    labelSala.textContent = papelSelect.value === 'cabelo'
      ? 'Código da sala (deixa em branco para gerar)'
      : 'Código da sala';
  });

  function gerarCodigo() {
    return 'Cabelo-' + Math.floor(100 + Math.random() * 900);
  }

  function sanitizarCodigo(txt) {
    return txt.trim().toLowerCase().replace(/[^a-z0-9-]/g, '');
  }

  async function entrarNaSala() {
    const papel = papelSelect.value;
    let codigo = sanitizarCodigo(salaInput.value);

    if (papel === 'mentora' && !codigo) {
      codigo = gerarCodigo();
    }
    if (papel === 'aluna' && !codigo) {
      statusTexto.textContent = 'Introduz o código da sala enviado pela mentora.';
      return;
    }

    btnEntrar.disabled = true;
    statusTexto.textContent = 'A pedir acesso à câmara e microfone...';

    try {
      localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
    } catch (err) {
      statusTexto.textContent = 'Não foi possível aceder à câmara/microfone. Verifica as permissões do navegador.';
      btnEntrar.disabled = false;
      return;
    }

    cameraTrack = localStream.getVideoTracks()[0];
    videoLocal.srcObject = localStream;

    const idPeer = papel === 'mentora' ? (PREFIXO + codigo) : (PREFIXO + codigo + '-aluna-' + Math.random().toString(36).slice(2, 7));

    statusTexto.textContent = 'A ligar à sala...';
    peer = new Peer(idPeer);

    peer.on('open', function () {
      salaVideo.classList.remove('d-none');
      codigoAtual.textContent = codigo;
      statusTexto.textContent = '';

      if (papel === 'mentora') {
        painelStatus.textContent = 'Sala aberta — a aguardar alunas';
      } else {
        painelStatus.textContent = 'A ligar à mentora...';
        const mentoraId = PREFIXO + codigo;
        const chamada = peer.call(mentoraId, localStream);
        if (chamada) registarChamada(mentoraId, chamada);
      }
    });

    peer.on('call', function (chamada) {
      chamada.answer(localStream);
      registarChamada(chamada.peer, chamada);
    });

    peer.on('error', function (err) {
      console.error(err);
      if (err.type === 'peer-unavailable') {
        statusTexto.textContent = 'Sala não encontrada. Confirma o código com a mentora.';
        painelStatus.textContent = 'Sem ligação';
      } else if (err.type === 'unavailable-id') {
        statusTexto.textContent = 'Já existe uma sala aberta com este código. Escolhe outro código.';
      } else {
        statusTexto.textContent = 'Ocorreu um erro na ligação. Tenta novamente.';
      }
    });
  }

  function registarChamada(idRemoto, chamada) {
    chamadasAtivas.set(idRemoto, chamada);
    atualizarContador();
    chamada.on('stream', function (streamRemoto) {
      videoRemoto.srcObject = streamRemoto;
      painelStatus.textContent = 'Ao vivo';
    });
    chamada.on('close', function () {
      chamadasAtivas.delete(idRemoto);
      atualizarContador();
      videoRemoto.srcObject = null;
      painelStatus.textContent = 'Participante saiu da sala';
    });
  }

  function atualizarContador() {
    contadorEl.textContent = String(1 + chamadasAtivas.size);
  }

  function trocarFaixaVideo(novaFaixa) {
    chamadasAtivas.forEach(function (chamada) {
      const pc = chamada.peerConnection;
      if (!pc) return;
      const sender = pc.getSenders().find(function (s) { return s.track && s.track.kind === 'video'; });
      if (sender) sender.replaceTrack(novaFaixa);
    });
  }

  btnMic.addEventListener('click', function () {
    if (!localStream) return;
    micAtivo = !micAtivo;
    localStream.getAudioTracks().forEach(function (t) { t.enabled = micAtivo; });
    btnMic.innerHTML = micAtivo
      ? '<i class="fa-solid fa-microphone"></i>'
      : '<i class="fa-solid fa-microphone-slash"></i>';
  });

  btnCam.addEventListener('click', function () {
    if (!localStream) return;
    camAtiva = !camAtiva;
    localStream.getVideoTracks().forEach(function (t) { t.enabled = camAtiva; });
    btnCam.innerHTML = camAtiva
      ? '<i class="fa-solid fa-video"></i>'
      : '<i class="fa-solid fa-video-slash"></i>';
  });

  btnTela.addEventListener('click', async function () {
    if (!localStream) return;

    if (!partilhandoTela) {
      let telaStream;
      try {
        telaStream = await navigator.mediaDevices.getDisplayMedia({ video: true });
      } catch (err) {
        return; // utilizador cancelou a partilha
      }
      const telaTrack = telaStream.getVideoTracks()[0];
      trocarFaixaVideo(telaTrack);
      videoLocal.srcObject = telaStream;
      partilhandoTela = true;
      btnTela.innerHTML = '<i class="fa-solid fa-display" style="color:var(--gold);"></i>';
      painelStatus.textContent = 'A partilhar o ecrã';

      telaTrack.addEventListener('ended', function () {
        pararPartilhaTela();
      });
    } else {
      pararPartilhaTela();
    }
  });

  function pararPartilhaTela() {
    if (cameraTrack) trocarFaixaVideo(cameraTrack);
    videoLocal.srcObject = localStream;
    partilhandoTela = false;
    btnTela.innerHTML = '<i class="fa-solid fa-display"></i>';
    painelStatus.textContent = 'Ao vivo';
  }

  btnSair.addEventListener('click', function () {
    chamadasAtivas.forEach(function (c) { c.close(); });
    chamadasAtivas.clear();
    if (localStream) localStream.getTracks().forEach(function (t) { t.stop(); });
    if (peer) peer.destroy();
    salaVideo.classList.add('d-none');
    btnEntrar.disabled = false;
    statusTexto.textContent = 'Saíste da sala. Podes entrar novamente quando quiseres.';
  });

  btnEntrar.addEventListener('click', entrarNaSala);
})();

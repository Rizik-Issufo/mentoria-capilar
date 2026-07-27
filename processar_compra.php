<?php
require_once __DIR__ . '/includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: comprar.php');
    exit;
}

$nome     = trim($_POST['nome'] ?? '');
$whatsapp = trim($_POST['whatsapp'] ?? '');
$email    = trim($_POST['email'] ?? '');
$metodo   = trim($_POST['metodo'] ?? 'A combinar no WhatsApp');

// Validação simples
if ($nome === '' || $whatsapp === '') {
    header('Location: comprar.php?erro=campos&nome=' . urlencode($nome) . '&whatsapp=' . urlencode($whatsapp));
    exit;
}

$digitos = preg_replace('/\D/', '', $whatsapp);
if (strlen($digitos) < 7) {
    header('Location: comprar.php?erro=whatsapp&nome=' . urlencode($nome) . '&whatsapp=' . urlencode($whatsapp));
    exit;
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email = ''; // ignora e-mail inválido em vez de bloquear a compra
}

// Gera um número de pedido simples
$pedidoId = 'CR' . date('ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));

$pedido = [
    'id'        => $pedidoId,
    'nome'      => $nome,
    'whatsapp'  => $digitos,
    'email'     => $email,
    'metodo'    => $metodo,
    'produto'   => $MANUAL['nome'],
    'preco'     => $MANUAL['preco'],
    'data'      => date('Y-m-d H:i:s'),
];

// Regista o pedido num ficheiro JSON simples (substituir por base de dados em produção)
$ficheiro = __DIR__ . '/data/pedidos.json';
$pedidos = [];
if (is_file($ficheiro)) {
    $conteudo = file_get_contents($ficheiro);
    $pedidos = json_decode($conteudo, true) ?: [];
}
$pedidos[] = $pedido;
file_put_contents($ficheiro, json_encode($pedidos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Guarda o pedido numa sessão temporária para a página de agradecimento
session_start();
$_SESSION['ultimo_pedido'] = $pedido;

header('Location: obrigado.php?pedido=' . urlencode($pedidoId));
exit;

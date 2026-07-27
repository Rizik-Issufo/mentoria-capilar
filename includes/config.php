<?php
/**
 * Configuração central — Coroa Real Mentoria Capilar
 * Altere aqui o número de WhatsApp, nomes e preços.
 */

// Número de WhatsApp da mentora, formato internacional SEM "+" e sem espaços
// Exemplo Moçambique: 258841234567
define('WHATSAPP_NUMERO', '258840584001');

define('MENTORA_NOME', 'Mércia Alfandega');
define('MARCA_NOME', 'Ekharari');
define('MOEDA', 'MT'); // Metical

// Planos de mentoria — usados na página inicial e nos botões de WhatsApp
$PLANOS = [
    [
        'id' => 'transformacao',
        'nome' => 'Mentoria Transformação',
        'preco' => 6000,
        'periodo' => 'pacote de 7 dias',
        'descricao' => 'Acompanhamento próximo para reverter quebra e falhas.',
        'destaque' => true,
        'beneficios' => [
            'Diagnostico capilar',
            '4 aulas ao vivo com partilha de ecrã',
            'Cronograma capilar semana a semana',
            'Ajustes semanais da rotina',
            'Dicas de melhoramento do couro cabeludo',
            'Cuidados a ter com o cabelo'
        ],
    ],
    [
        'id' => 'formacao',
        'nome' => 'Formação de Capilarizadoras',
        'preco' => 7500,
        'periodo' => 'curso completo · 4 semanas',
        'descricao' => 'Para quem quer transformar o cuidado capilar em profissão.',
        'destaque' => false,
        'beneficios' => [
            'Tudo da Mentoria Transformação',
            'Aulas ao vivo semanais com demonstração prática',
            'Certificado de conclusão',
            'Manual digital completo incluído',
            'Mentoria de negócio para atender clientes',
        ],
    ],
];

// Manual digital
$MANUAL = [
    'nome' => 'E-book de Capilarização em criancas',
    'preco' => 950,
    'paginas' => 64,
    'descricao' => 'O passo a passo usado nas mentorias: diagnóstico capilar, cronograma, receitas  e rotina semana a semana para a sua criança.',
];

/** Gera link do WhatsApp com mensagem pré-preenchida */
function link_whatsapp(string $mensagem): string
{
    return 'https://wa.me/' . WHATSAPP_NUMERO . '?text=' . rawurlencode($mensagem);
}

/** Formata valores monetários em Metical */
function formatar_preco($valor): string
{
    return number_format((float) $valor, 0, ',', '.') . ' ' . MOEDA;
}

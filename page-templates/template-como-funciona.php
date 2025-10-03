<?php
/**
 * Template Name: Como Funciona / Documentação
 * Template Post Type: page
 *
 * Esta página detalha o processo de integração e uso da API PixGo,
 * conforme o conteúdo de pages/como_funciona.php.
 *
 * Tema: PixGo Institutional Theme
 *
 */

get_header(); // Carrega o header.php, incluindo o menu fixo e responsivo
?>

<div class="py-5">
    <h1 class="display-4 mb-4">Como Funciona o PixGo?</h1>
    <p class="lead mb-5">
        Integre Pix em 3 passos e gere QR Codes em tempo real. Nossa API é simples, com documentação clara e exemplos de código prontos.
    </p>

    <!-- Seção: 3 Passos para Integrar -->
    <div class="row gx-4 mb-5">
        <div class="col-md-4">
            <div class="card p-4 h-100 shadow-sm border-0">
                <h3 class="h4 text-primary">1. Configure Suas Chaves</h3>
                <p>Após o registro, acesse "Minha Chave API".</p>
                <ul>
                    <li><strong>Sua API Key PixGo:</strong> Chave de 64 caracteres para autenticar suas chamadas.</li>
                    <li><strong>Sua Chave do Mercado Pago:</strong> Você armazena sua `AccessToken` de produção. É mantida de forma criptografada em nosso banco de dados.</li>
                </ul>
                <a href="/api_key" class="btn btn-sm btn-outline-primary mt-auto">Gerenciar Chaves</a>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card p-4 h-100 shadow-sm border-0">
                <h3 class="h4 text-success">2. Recarregue Seus Créditos</h3>
                <p>Nosso sistema opera com créditos pré-pagos. Você recarrega um valor (mínimo R$ 10,00) convertido em requisições.</p>
                <p>O processo de recarga gera um Pix para pagamento. Créditos são adicionados quando o pagamento é confirmado.</p>
                <a href="/precos" class="btn btn-sm btn-outline-success mt-auto me-2">Ver Preços</a>
                <a href="/topup_credits" class="btn btn-sm btn-success mt-auto">Recarregar</a>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card p-4 h-100 shadow-sm border-0">
                <h3 class="h4 text-info">3. Chame o Endpoint</h3>
                <p>Para gerar um Pix, faça uma chamada simples ao nosso Endpoint único: <code>/gerar-pix</code>.</p>
                <p>O <em>Output</em> retorna o QR Code em <code>base64</code> e o link de pagamento. Cada chamada bem-sucedida deduz o custo da requisição do seu saldo.</p>
                <a href="/generate_pix" class="btn btn-sm btn-outline-info mt-auto">Ver Geração Pix</a>
            </div>
        </div>
    </div>

    <!-- Documentação Técnica da API PixGo -->
    <section class="documentation mt-5">
        <h2 class="display-6 mb-4 border-bottom pb-2">Documentação Técnica da API PixGo</h2>
        <p>
            Nossa API é desenhada para ser RESTful, segura e extremamente simples.
        </p>

        <!-- Endpoint POST /gerar-pix -->
        <div class="card mb-4 bg-light-subtle">
            <div class="card-body">
                <h3 class="card-title"><code>POST /gerar-pix</code> — Cria a Cobrança Pix</h3>
                <p class="mb-3">
                    Este endpoint deduz os créditos do seu saldo e aciona a API do Mercado Pago (usando sua chave cadastrada) para gerar o QR Code Pix e o link de pagamento.
                </p>

                <h4 class="h5">URL</h4>
                <p><code>POST https://pixgo.api.br/gerar-pix</code></p>

                <h4 class="h5">Autenticação (Obrigatória)</h4>
                <p class="alert alert-warning p-2">
                    Deve ser fornecida no cabeçalho HTTP:
                    <br><code>Authorization: Bearer SUA_API_KEY_PIXGO</code>
                </p>
                
                <h4 class="h5">Corpo da Requisição (JSON)</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Parâmetro</th>
                                <th>Tipo</th>
                                <th>Obrigatório</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>valor</code></td>
                                <td>Decimal</td>
                                <td>Sim</td>
                                <td>Valor total da transação. Formato decimal (ex: 15.50).</td>
                            </tr>
                            <tr>
                                <td><code>descricao</code></td>
                                <td>String</td>
                                <td>Sim</td>
                                <td>Descrição da cobrança Pix (Será exibida no extrato do pagador).</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="h5">Exemplo de Resposta de Sucesso (HTTP 200)</h4>
                <pre class="bg-dark text-white p-3 rounded"><code>{
"success": true,
"valor": 15.5,
"descricao": "Pedido de Teste #12345",
"pix_copia_cola": "00020126...",
"qr_code_base64": "data:image/png;base64,iVBORw0GgoA...",
"link_pagamento": "https://checkout.mercadopago.com.br/...",
"external_reference": "PEDIDO_101",
"custo_requisição": 0.02,
"novo_saldo": 9.98
}</code></pre>
            </div>
        </div>

        <!-- Endpoint GET /consultar-pix -->
        <div class="card mb-4 bg-light-subtle">
            <div class="card-body">
                <h3 class="card-title"><code>GET /consultar-pix</code> — Consulta o Status da Cobrança</h3>
                <p class="mb-3">
                    Utilize este endpoint para verificar o status de uma cobrança Pix específica (registrada na tabela <code>transactions</code> do PixGo).
                </p>

                <h4 class="h5">URL</h4>
                <p><code>GET https://pixgo.api.br/consultar-pix?reference=PEDIDO_XXX</code></p>
                
                <h4 class="h5">Parâmetros da Query String</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Parâmetro</th>
                                <th>Tipo</th>
                                <th>Obrigatório</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>reference</code></td>
                                <td>String</td>
                                <td>Sim</td>
                                <td>A referência externa (<code>external_reference</code>, ex: PEDIDO_101) retornada por <code>/gerar-pix</code>.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="h5">Possíveis Status de Retorno</h4>
                <p class="alert alert-secondary p-2">
                    <code>pendente</code>, <code>aprovado</code>, <code>recusado</code>, <code>cancelado</code>, <code>erro</code>.
                </p>
            </div>
        </div>

        <!-- Exemplos de Uso -->
        <h2 class="h3 mt-5">Exemplos de Código</h2>
        <div class="accordion" id="accordionExamples">
            
            <!-- Exemplo PHP (cURL) -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingPhp">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePhp" aria-expanded="false" aria-controls="collapsePhp">
                        PHP (cURL) - Geração Pix
                    </button>
                </h2>
                <div id="collapsePhp" class="accordion-collapse collapse" aria-labelledby="headingPhp" data-bs-parent="#accordionExamples">
                    <div class="accordion-body">
                        <pre><code class="language-php"><?php echo htmlspecialchars('
$api_key = \'SUA_API_KEY_PIXGO\';
$endpoint = \'https://pixgo.api.br/gerar-pix\';
$payload = json_encode([
    \'valor\' => 50.00,
    \'descricao\' => \'Compra de Ebook XYZ\'
]);

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    \'Authorization: Bearer \' . $api_key,
    \'Content-Type: application/json\'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
if ($data[\'success\']) {
    // Exibe o código Copia e Cola
    echo "PIX COPIA E COLA: " . $data[\'pix_copia_cola\'];
} else {
    echo "Erro: " . $data[\'message\'];
}
'); ?></code></pre>
                    </div>
                </div>
            </div>

            <!-- Exemplo Javascript (Fetch API) -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingJs">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseJs" aria-expanded="false" aria-controls="collapseJs">
                        Javascript (Fetch API) - Geração Pix
                    </button>
                </h2>
                <div id="collapseJs" class="accordion-collapse collapse" aria-labelledby="headingJs" data-bs-parent="#accordionExamples">
                    <div class="accordion-body">
                        <pre><code class="language-js"><?php echo htmlspecialchars('
const apiKey = \'SUA_API_KEY_PIXGO\';
const endpoint = \'https://pixgo.api.br/gerar-pix\';
const payload = {
    valor: 15.50,
    descricao: \'Serviço de Consultoria\'
};

fetch(endpoint, {
    method: \'POST\',
    headers: {
        \'Authorization\': `Bearer ${apiKey}`,
        \'Content-Type\': \'application/json\'
    },
    body: JSON.stringify(payload)
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        // Usa a base64 para exibir o QR Code
        document.getElementById(\'qrcode-img\').src = data.qr_code_base64;
        console.log("Link de Pagamento: ", data.link_pagamento);
    } else {
        console.error(\'Falha na Geração: \', data.message);
    }
})
.catch(error => {
    console.error(\'Erro de Conexão:\', error);
});
'); ?></code></pre>
                    </div>
                </div>
            </div>

            <!-- Exemplo Python (Requests) -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingPython">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePython" aria-expanded="false" aria-controls="collapsePython">
                        Python (Requests) - Geração Pix
                    </button>
                </h2>
                <div id="collapsePython" class="accordion-collapse collapse" aria-labelledby="headingPython" data-bs-parent="#accordionExamples">
                    <div class="accordion-body">
                        <pre><code class="language-python"><?php echo htmlspecialchars('
import requests
import json

api_key = \'SUA_API_KEY_PIXGO\'
endpoint = \'https://pixgo.api.br/gerar-pix\'
headers = {
    \'Authorization\': f\'Bearer {api_key}\',
    \'Content-Type\': \'application/json\'
}
payload = {
    \'valor\': 25.00,
    \'descricao\': \'Doacao Mensal\'
}

try:
    response = requests.post(endpoint, headers=headers, data=json.dumps(payload))
    response.raise_for_status() # Lança exceção para erros HTTP (4xx ou 5xx)
    data = response.json()

    if data.get(\'success\'):
        print(f"PIX gerado. Referência: {data[\'external_reference\']}")
        print(f"Novo Saldo: R$ {data[\'novo_saldo\']}")
    else:
        print(f"Erro na API: {data.get(\'message\', \'Erro desconhecido\')}")

except requests.exceptions.RequestException as e:
    print(f"Erro de Conexão ou HTTP: {e}")
'); ?></code></pre>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- CTA Final -->
    <section class="text-center mt-5 p-4 border rounded bg-light">
        <h2 class="h3">Pronto para Simplificar Seus Pagamentos?</h2>
        <p class="lead">Comece a usar a API Pix mais simples do Mercado. Pague apenas pelo uso, sem mensalidades.</p>
        <a href="/register" class="btn btn-primary btn-lg">Criar Minha Conta Grátis</a>
    </section>

</div>

<?php 
get_footer(); // Carrega o footer.php
?>
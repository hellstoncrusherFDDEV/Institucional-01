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

<div class="container my-2">
    <h1 class="display-4 text-primary text-center"><i class="fas fa-question-circle me-2"></i>Como Funciona o PixGo?</h1>
    <p class="lead text-center mb-5">Integre Pix em 3 passos e gere QR Codes em tempo real.</p>

    <div class="row">
        <!-- Passo 1: Configuração -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary"><i class="fas fa-key me-2"></i>1. Configure Suas Chaves</h3>
                    <p>Após o registro, acesse "Minha Chave API" para duas configurações essenciais:</p>
                    <ul>
                        <li><i class="fas fa-lock me-1 text-primary"></i> <strong>Sua API Key PixGo:</strong> Chave de 64 caracteres gerada automaticamente no registro e usada para autenticar suas chamadas.</li>
                        <li><i class="fas fa-shield-alt me-1 text-primary"></i> <strong>Sua Chave do Mercado Pago:</strong> Você armazena sua `AccessToken` de produção, que é mantida de forma <strong>criptografada</strong> em nosso banco de dados.</li>
                    </ul>
                    <a href="/api_key" class="btn btn-sm btn-outline-primary"><i class="fas fa-cog me-1"></i>Gerenciar Chaves</a>
                </div>
            </div>
        </div>

        <!-- Passo 2: Recarga de Créditos -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary"><i class="fas fa-wallet me-2"></i>2. Recarregue Seus Créditos</h3>
                    <p>Nosso sistema opera com créditos pré-pagos. Você recarrega um valor (mínimo R$ 10,00) e esse valor é convertido em requisições à API, conforme a tabela de preços.</p>
                    <p>O processo de recarga gera um Pix para pagamento, e seus créditos são adicionados apenas quando o pagamento é <strong>confirmado</strong> (via webhook, em um sistema real).</p>
                    <a href="/topup_credits" class="btn btn-sm btn-outline-primary"><i class="fas fa-coins me-1"></i>Recarregar</a>
                </div>
            </div>
        </div>

        <!-- Passo 3: Geração do Pix -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary"><i class="fas fa-code me-2"></i>3. Chame o Endpoint</h3>
                    <p>Para gerar um Pix, você fará uma chamada simples ao nosso Endpoint único: `/gerar-pix`.</p>
                    <p>O <strong>Input</strong> requer: <code>valor</code>, <code>descrição</code> e sua chave do Mercado Pago (implícita, pois já está cadastrada).</p>
                    <p>O <strong>Output</strong> retorna: O QR Code em `base64` e o link de pagamento.</p>
                    <p class="mt-2 text-success"><i class="fas fa-check-circle me-1"></i> Cada chamada bem-sucedida deduz o custo da requisição do seu saldo.</p>
                    <a href="/generate_pix" class="btn btn-sm btn-outline-primary"><i class="fas fa-qrcode me-1"></i>Ver Geração Pix</a>
                </div>
            </div>
        </div>
    </div>

	<h2 class="mt-2 mb-4">Documentação Técnica da API PixGo</h2>

  <div class="ratio ratio-16x9 mx-auto" style="max-width: 900px;">
      <iframe
      src="https://www.youtube.com/embed/S86zAxbwa3k?si=YJvbwiXoNz9xBxe8"
      title="YouTube video player"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
      referrerpolicy="strict-origin-when-cross-origin"
      allowfullscreen>
      </iframe>
  </div>

	<p class="lead">Nossa API foi desenhada para ser RESTful, segura (requer API Key no cabeçalho Authorization) e extremamente simples. Utilize os seguintes endpoints para integrar o Pix ao seu sistema.</p>

	<div class="accordion" id="apiDocumentationAccordion">

		<!-- Acordeon Item 1: Gerar Pix -->
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
					<strong>POST /gerar-pix</strong> &mdash; Cria a Cobrança Pix
				</button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#apiDocumentationAccordion">
				<div class="accordion-body">

					<h5 class="mb-3">Detalhes do Endpoint</h5>
					<p>Este endpoint é responsável por deduzir os créditos do seu saldo e acionar a API do Mercado Pago (usando sua chave cadastrada) para gerar o QR Code Pix e o link de pagamento.</p>

					<h6>URL</h6>
					<pre class="bg-light p-2 rounded">POST https://pixgo.api.br/gerar-pix</pre>

					<h6>Autenticação (Obrigatória)</h6>
					<p>Deve ser fornecida no cabeçalho HTTP:</p>
					<pre class="bg-light p-2 rounded">Authorization: Bearer SUA_API_KEY_PIXGO</pre>

					<h6>Corpo da Requisição (JSON)</h6>
					<table class="table table-sm">
						<thead>
							<tr><th>Parâmetro</th><th>Tipo</th><th>Obrigatório</th><th>Descrição</th></tr>
						</thead>
						<tbody>
							<tr><td><code>valor</code></td><td>Decimal</td><td>Sim</td><td>Valor total da transação. Formato decimal (ex: 15.50).</td></tr>
							<tr><td><code>descricao</code></td><td>String</td><td>Sim</td><td>Descrição da cobrança Pix (Será exibida no extrato do pagador).</td></tr>
						</tbody>
					</table>

					<h6>Exemplo de Resposta de Sucesso (HTTP 200)</h6>
					<pre class="bg-success text-white p-2 rounded">
	{
		"success": true,
		"valor": 15.5,
		"descricao": "Pedido de Teste #12345",
		"pix_copia_cola": "00020126...",
		"qr_code_base64": "data:image/png;base64,iVBORw0GgoA...",
		"link_pagamento": "https://checkout.mercadopago.com.br/...",
		"external_reference": "PEDIDO_101",
		"custo_requisição": 0.02,
		"novo_saldo": 9.98
	}
					</pre>

					<h5 class="mt-4">Exemplos de Uso</h5>

					<!-- PHP Example -->
					<div class="card card-body bg-light mb-2">
						<h6>PHP (cURL)</h6>
						<pre><code>
	$api_key = 'SUA_API_KEY_PIXGO';
	$endpoint = 'https://pixgo.api.br/gerar-pix';

	$payload = json_encode([
		'valor' => 50.00,
		'descricao' => 'Compra de Ebook XYZ'
	]);

	$ch = curl_init($endpoint);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Authorization: Bearer ' . $api_key,
		'Content-Type: application/json'
	]);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
	$response = curl_exec($ch);
	curl_close($ch);

	$data = json_decode($response, true);

	if ($data['success']) {
		// Exibe o código Copia e Cola
		echo "PIX COPIA E COLA: " . $data['pix_copia_cola'];
	} else {
		echo "Erro: " . $data['message'];
	}
						</code></pre>
					</div>

					<!-- Javascript Example -->
					<div class="card card-body bg-light mb-2">
						<h6>Javascript (Fetch API)</h6>
						<pre><code>
	const apiKey = 'SUA_API_KEY_PIXGO';
	const endpoint = 'https://pixgo.api.br/gerar-pix';

	const payload = {
		valor: 15.50,
		descricao: 'Serviço de Consultoria'
	};

	fetch(endpoint, {
		method: 'POST',
		headers: {
			'Authorization': `Bearer ${apiKey}`,
			'Content-Type': 'application/json'
		},
		body: JSON.stringify(payload)
	})
	.then(response => response.json())
	.then(data => {
		if (data.success) {
			// Usa a base64 para exibir o QR Code
			document.getElementById('qrcode-img').src = data.qr_code_base64;
			console.log("Link de Pagamento: ", data.link_pagamento);
		} else {
			console.error('Falha na Geração: ', data.message);
		}
	})
	.catch(error => {
		console.error('Erro de Conexão:', error);
	});
						</code></pre>
					</div>

					<!-- Python Example -->
					<div class="card card-body bg-light">
						<h6>Python (Requests)</h6>
						<pre><code>
	import requests
	import json

	api_key = 'SUA_API_KEY_PIXGO'
	endpoint = 'https://pixgo.api.br/gerar-pix'

	headers = {
		'Authorization': f'Bearer {api_key}',
		'Content-Type': 'application/json'
	}

	payload = {
		'valor': 25.00,
		'descricao': 'Doacao Mensal'
	}

	try:
		response = requests.post(endpoint, headers=headers, data=json.dumps(payload))
		response.raise_for_status() # Lança exceção para erros HTTP (4xx ou 5xx)

		data = response.json()

		if data.get('success'):
			print(f"PIX gerado. Referência: {data['external_reference']}")
			print(f"Novo Saldo: R$ {data['novo_saldo']}")
		else:
			print(f"Erro na API: {data.get('message', 'Erro desconhecido')}")

	except requests.exceptions.RequestException as e:
		print(f"Erro de Conexão ou HTTP: {e}")
						</code></pre>
					</div>

				</div>
			</div>
		</div>

		<!-- Acordeon Item 2: Consultar Pix -->
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingTwo">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					<strong>GET /consultar-pix</strong> &mdash; Consulta o Status da Cobrança
				</button>
			</h2>
			<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#apiDocumentationAccordion">
				<div class="accordion-body">
					<h5 class="mb-3">Detalhes do Endpoint</h5>
					<p>Utilize este endpoint para verificar o status de uma cobrança Pix específica (registrada na tabela <code>transactions</code> do PixGo [6]).</p>

					<h6>URL</h6>
					<pre class="bg-light p-2 rounded">GET https://pixgo.api.br/consultar-pix?reference=PEDIDO_XXX</pre>

					<h6>Autenticação (Obrigatória)</h6>
					<p>Deve ser fornecida no cabeçalho HTTP:</p>
					<pre class="bg-light p-2 rounded">Authorization: Bearer SUA_API_KEY_PIXGO</pre>

					<h6>Parâmetros da Query String</h6>
					<table class="table table-sm">
						<thead>
							<tr><th>Parâmetro</th><th>Tipo</th><th>Obrigatório</th><th>Descrição</th></tr>
						</thead>
						<tbody>
							<tr><td><code>reference</code></td><td>String</td><td>Sim</td><td>A referência externa (<code>external_reference</code>, ex: <code>PEDIDO_101</code>) retornada pelo endpoint <code>/gerar-pix</code>.</td></tr>
						</tbody>
					</table>

					<h6>Exemplo de Resposta de Sucesso (HTTP 200)</h6>
					<pre class="bg-success text-white p-2 rounded">
	{
		"success": true,
		"status": "aprovado",
		"valor": 15.50,
		"descricao": "Serviço de Consultoria",
		"data_criacao": "2025-05-15 10:30:00"
	}
					</pre>
					<p class="text-muted small">Possíveis status de retorno: <code>pendente</code>, <code>aprovado</code>, <code>recusado</code>, <code>cancelado</code>, <code>erro</code>.</p>

					<h5 class="mt-4">Exemplos de Uso</h5>

					<!-- PHP Example -->
					<div class="card card-body bg-light mb-2">
						<h6>PHP (cURL)</h6>
						<pre><code>
	$api_key = 'SUA_API_KEY_PIXGO';
	$external_reference = 'PEDIDO_101';
	$endpoint = 'https://pixgo.api.br/consultar-pix?reference=' . $external_reference;

	$ch = curl_init($endpoint);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Authorization: Bearer ' . $api_key
	]);
	$response = curl_exec($ch);
	curl_close($ch);

	$data = json_decode($response, true);

	if ($data['success']) {
		echo "Status da Cobrança ({$external_reference}): " . strtoupper($data['status']);
	} else {
		echo "Erro ao consultar: " . $data['message'];
	}
						</code></pre>
					</div>

					<!-- Javascript Example -->
					<div class="card card-body bg-light mb-2">
						<h6>Javascript (Fetch API)</h6>
						<pre><code>
	const apiKey = 'SUA_API_KEY_PIXGO';
	const externalReference = 'PEDIDO_101';
	const endpoint = `https://pixgo.api.br/consultar-pix?reference=${externalReference}`;

	fetch(endpoint, {
		method: 'GET',
		headers: {
			'Authorization': `Bearer ${apiKey}`
		}
	})
	.then(response => response.json())
	.then(data => {
		if (data.success) {
			alert(`Status: ${data.status.toUpperCase()}`);
		} else {
			console.error('Falha na Consulta: ', data.message);
		}
	})
	.catch(error => {
		console.error('Erro de Conexão:', error);
	});
						</code></pre>
					</div>

					<!-- Python Example -->
					<div class="card card-body bg-light">
						<h6>Python (Requests)</h6>
						<pre><code>
	import requests

	api_key = 'SUA_API_KEY_PIXGO'
	external_reference = 'PEDIDO_101'
	endpoint = 'https://pixgo.api.br/consultar-pix'

	headers = {
		'Authorization': f'Bearer {api_key}'
	}

	params = {
		'reference': external_reference
	}

	try:
		response = requests.get(endpoint, headers=headers, params=params)
		response.raise_for_status()

		data = response.json()

		if data.get('success'):
			print(f"Referência {external_reference} status: {data['status'].upper()}")
		else:
			print(f"Erro na API: {data.get('message', 'Erro desconhecido')}")

	except requests.exceptions.RequestException as e:
		print(f"Erro de Conexão ou HTTP: {e}")
						</code></pre>
					</div>

				</div>
			</div>
		</div>
	</div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <h2 class="mt-4"><i class="fas fa-server me-2"></i>Tecnologia e Escalabilidade</h2>
            <p><i class="fas fa-shield-alt me-1 text-muted"></i> O PixGo é desenvolvido usando as tecnologias mais avançadas sem abrir mão da segurança, robustez e confiabilidade para gerenciar clientes e transações. A arquitetura é preparada para futuras integrações (como Stripe e/ou PayPal) e para monitoramento de logs e métricas.</p>
            <p><i class="fas fa-book me-1 text-muted"></i> Nossa documentação é clara e voltada para desenvolvedores, permitindo que você gere QR Codes Pix com apenas algumas linhas de código.</p>
        </div>
    </div>
</div>

<?php
get_footer(); // Carrega o footer.php
?>

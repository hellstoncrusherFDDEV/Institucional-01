<?php
/*
Template Name: Contato
Template Post Type: page
*/

get_header();
?>

<div class="py-5">
    <h1 class="display-4 mb-4">Entre em Contato com a PixGo</h1>
    <p class="lead">Tem dúvidas sobre a integração, preços ou precisa de suporte? Fale conosco.</p>

    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-3">Informações de Contato</h2>
            <ul class="list-unstyled">
                <!-- Usamos o e-mail do ADM encontrado nas fontes [20, 21] como referência para contato -->
                <li><strong>E-mail de Suporte:</strong> <a href="mailto:contato@fddev.com.br">contato@fddev.com.br</a></li>
                <li><strong>Central de Ajuda:</strong> (Link para documentação interna/FAQ, use /como-funciona)</li>
                <li><strong>Administração:</strong> contato@fddev.com.br</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Formulário de Contato</h2>
            <!-- Form: Usaria a função contact form 7 ou um código customizado -->
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="assunto" class="form-label">Assunto</label>
                    <input type="text" class="form-control" id="assunto">
                </div>
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea class="form-control" id="mensagem" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>
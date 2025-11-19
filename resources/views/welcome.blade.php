<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WeAgenda - Agendamento Online para Hospitais e Clínicas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { font-family: 'Helvetica Neue', sans-serif; }
    .hero { background: linear-gradient(rgba(0,123,255,0.6), rgba(0,123,255,0.6)), url('https://images.unsplash.com/photo-1588776814546-ec7e5c1783fa?auto=format&fit=crop&w=1350&q=80') center/cover no-repeat; height: 90vh; display: flex; align-items: center; justify-content: center; text-align: center; color: white; }
    .info-section { padding: 80px 0; }
    .footer { background: #f8f9fa; padding: 40px 0; text-align: center; font-size: 14px; }
    .card-benefit { border: none; }
    .faq-item { margin-bottom: 15px; }
  </style>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <img src="/img/logo-weagenda.png" alt="WeAgenda" height="50">
    </a>
    <div class="d-flex">
      <a href="/demo" class="btn btn-primary me-3">Solicitar Demonstração</a>
      <a href="/login" class="btn btn-outline-primary">Área do Cliente</a>
    </div>
  </div>
</nav>

<!-- Hero -->
<header class="hero">
  <div>
    <h1 class="display-4 fw-bold">Simplifique o Agendamento na Sua Clínica</h1>
    <p class="lead">Integração com Tasy e total controle do fluxo de consultas.</p>
    <div class="mt-4">
      <a href="/demo" class="btn btn-light btn-lg">Solicitar Demonstração</a>
    </div>
  </div>
</header>

<!-- Prints/Demonstração -->
<section class="info-section text-center">
  <div class="container">
    <h2 class="mb-5">Veja o WeAgenda em Ação</h2>
    <div id="carouselPrints" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/img/print1.png" class="d-block w-100" alt="Agendamento">
        </div>
        <div class="carousel-item">
          <img src="/img/print2.png" class="d-block w-100" alt="Dashboard">
        </div>
        <div class="carousel-item">
          <img src="/img/print3.png" class="d-block w-100" alt="Relatórios">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselPrints" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselPrints" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>
</section>

<!-- Benefícios -->
<section class="info-section bg-light text-center">
  <div class="container">
    <h2 class="mb-5">Por que escolher o WeAgenda?</h2>
    <div class="row">
      <div class="col-md-3">
        <div class="card card-benefit">
          <div class="card-body">
            <i class="bi bi-calendar-check display-4 text-primary"></i>
            <h5 class="mt-3">Redução de Ausências</h5>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-benefit">
          <div class="card-body">
            <i class="bi bi-graph-up-arrow display-4 text-primary"></i>
            <h5 class="mt-3">Otimização de Processos</h5>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-benefit">
          <div class="card-body">
            <i class="bi bi-shield-check display-4 text-primary"></i>
            <h5 class="mt-3">Segurança de Dados</h5>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-benefit">
          <div class="card-body">
            <i class="bi bi-link display-4 text-primary"></i>
            <h5 class="mt-3">Integração com Tasy</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Como Funciona -->
<section class="info-section text-center">
  <div class="container">
    <h2 class="mb-5">Como Funciona</h2>
    <div class="row">
      <div class="col-md-2">Cadastro da Clínica</div>
      <div class="col-md-2">Especialidades</div>
      <div class="col-md-2">Configuração de Horários</div>
      <div class="col-md-2">Agendamento Online</div>
      <div class="col-md-2">Dashboard em Tempo Real</div>
      <div class="col-md-2">Relatórios</div>
    </div>
  </div>
</section>

<!-- Planos e Preços -->
<section class="info-section bg-light text-center">
  <div class="container">
    <h2 class="mb-5">Planos para sua necessidade</h2>
    <p class="lead">Solicite contato para personalizar o seu plano.</p>
    <a href="/demo" class="btn btn-primary btn-lg">Solicitar Contato</a>
  </div>
</section>

<!-- Depoimentos -->
<section class="info-section text-center">
  <div class="container">
    <h2 class="mb-5">Confiabilidade e Eficiência</h2>
    <p class="lead">Utilizado por hospitais de referência com +100 mil agendamentos mensais.</p>
  </div>
</section>

<!-- FAQ -->
<section class="info-section bg-light">
  <div class="container">
    <h2 class="text-center mb-5">Perguntas Frequentes</h2>
    <div class="accordion" id="faqAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
            Como funciona a integração com o Tasy?
          </button>
        </h2>
        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            A integração é feita por API ou consultas em views do banco de dados Oracle do Tasy.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
            O sistema é seguro?
          </button>
        </h2>
        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Sim, toda comunicação é criptografada e seguimos as boas práticas de proteção de dados.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="footer">
  <div class="container">
    <p>&copy; 2025 WeAgenda. Desenvolvido por WCIC. Todos os direitos reservados.</p>
    <p><a href="#">Política de Privacidade</a> | <a href="#">Termos de Uso</a> | contato@weagenda.com.br</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

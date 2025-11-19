# WeAgenda — Sistema de Agendamento de Consultas e Exames

**WeAgenda** é um sistema completo de agendamento online para hospitais, clínicas e consultórios médicos.

Desenvolvido em **Laravel 10** + **Bootstrap 5**, com painel administrativo moderno, área pública para pacientes e recursos profissionais como relatórios Excel e PDF.

---

## 🚀 Funcionalidades Principais

- ✅ Cadastro de Médicos e Especialidades
- ✅ Definição de Horários Disponíveis por Médico
- ✅ Área Pública para Pacientes:
  - Consulta de agendamentos por CPF
  - Cancelamento de agendamento
  - Reagendamento direto online
- ✅ Dashboard Administrativo:
  - Indicadores (total, confirmados, cancelados, pendentes)
  - Gráficos de resumo (Pizza e Linha)
- ✅ Listagem de Agendamentos:
  - Filtros por médico, especialidade, status e datas
  - Paginação de registros
  - Exportação para **Excel** e **PDF**
- ✅ Toasts Animados para mensagens de sucesso e erro
- ✅ Design responsivo e limpo
- ✅ Área preparada para expansão futura (multi-clínicas, login de médico, notificações internas)

---

## 🛠️ Tecnologias Utilizadas

- **PHP 8.2**
- **Laravel 10**
- **MySQL**
- **Bootstrap 5**
- **Chart.js**
- **Maatwebsite/Laravel-Excel** (Exportação Excel)
- **Barryvdh/Laravel-Dompdf** (Exportação PDF)

---

## 📋 Estrutura do Projeto

| Módulo | Descrição |
|:-------|:----------|
| Dashboard | Painel de controle geral com indicadores e gráficos |
| Médicos | Cadastro e gestão de médicos da clínica |
| Especialidades | Cadastro de especialidades médicas |
| Horários | Definição dos horários disponíveis para agendamento |
| Agendamentos | Gerenciamento de agendamentos (filtros, exportações) |
| Área do Paciente | Consulta, cancelamento e reagendamento de agendamentos |

---

## ⚡ Requisitos de Instalação

- PHP 8.1 ou superior
- Composer
- Banco de Dados MySQL
- Node.js (opcional, se quiser trabalhar com assets/compilar frontend)

### Instalação:

```bash
# Clonar o projeto
git clone https://seurepositorio.com/weagenda.git

# Acessar a pasta
cd weagenda

# Instalar dependências PHP
composer install

# Configurar o arquivo .env
cp .env.example .env

# Gerar chave do sistema
php artisan key:generate

# Rodar migrations
php artisan migrate

# Iniciar servidor
php artisan serve
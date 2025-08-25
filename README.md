# Sistema de Registro de Livros

Sistema de gerenciamento de livros desenvolvido em Laravel com arquitetura limpa e padrões de design modernos.

## Comandos de Instalação

```bash
docker-compose up -d --build
docker-compose exec app bash
php artisan migrate --seed
php artisan queue:work
```

## Principais Funcionalidades

- **Gerenciamento de Livros**: Cadastro, edição, visualização e exclusão de livros
- **Gestão de Autores**: Controle completo de autores com relacionamentos
- **Gestão de Assuntos**: Controle completo de Assuntos com relacionamentos
- **Relacionamentos Many-to-Many**: Livros podem ter múltiplos autores e assuntos
- **Geração de Relatórios**: Relatórios em PDF com dados dos autores

## Arquitetura e Padrões de Design

### **Domain-Driven Design (DDD)**
- Estrutura modular organizada por domínios (`BookRegistry/`)
- Separação clara entre `Autor`, `Livro` e `Assunto`
- Cada domínio possui suas próprias camadas

### **Clean Architecture**
- **Domain Layer**: Entidades e regras de negócio
- **Application Layer**: Casos de uso e serviços de aplicação
- **Infrastructure Layer**: Repositories

### **Padrões Implementados**
- **Service Layer Pattern**: Serviços dedicados para lógica de negócio
- **Repository Pattern**: Abstração de acesso a dados
- **Request Validation**: Validação centralizada com Form Requests
- **Event-Driven Architecture**: Sistema de eventos para relatórios
- **Dependency Injection**: Injeção de dependências nativa do Laravel

## Esquema Visual do Banco de Dados

```
┌────────────────────────────┐                    ┌────────────────────────────┐
│         Livro              │                    │      Livro_Autor           │
├────────────────────────────┤                    ├────────────────────────────┤
|                            |                    | 🔑 id: INTEGER             |
│ 🔑 Codl: INTEGER           │                    │ ▼ Livro_Codl: INTEGER (FK) │
│ ◆ Titulo: VARCHAR(40)      │      N:N           │ ▼ Autor_CodAu: INTEGER (FK)│
│ ◆ Editora: VARCHAR(40)     │◄──────────────────►│                            │
│ ◆ Edicao: INTEGER          │                    │ 📁 Livro_Autor_FKIndex1    │
│ ◆ AnoPublicacao: VARCHAR(4)│                    │ 📁 Livro_Autor_FKIndex2    │
└────────────────────────────┘                    └────────────────────────────┘
           │                                              │
           │ N:N                                          │ N:1
           │                                              │
           ▼                                              ▼
┌──────────────────────────────┐                    ┌─────────────────────────┐
│      Livro_Assunto           │                    │         Autor           │
├──────────────────────────────┤                    ├─────────────────────────┤
| 🔑 id: INTEGER               |                    │ 🔑 CodAu: INTEGER       │
│ ▼ Livro_Codl: INTEGER (FK)   │                    │ ◆ Nome: VARCHAR(40)     │
│ ▼ Assunto_codAs: INTEGER (FK)│                    └─────────────────────────┘
│                              │
│ 📁 Livro_Assunto_FKIndex1    │
│ 📁 Livro_Assunto_FKIndex2    │
└──────────────────────────────┘
           │
           │ N:1
           ▼
┌─────────────────────────┐
│        Assunto          │
├─────────────────────────┤
│ 🔑 codAs: INTEGER       │
│ ◆ Descricao: VARCHAR(20)│
└─────────────────────────┘

                           ┌───────────────────────────────┐
                           │    vw_relatorio_autor         │
                           ├───────────────────────────────┤
                           │  autor_id: INTEGER            │
                           │  autor_nome: VARCHAR          │
                           │  total_livros: INTEGER        │
                           │  total_valor: DECIMAL         │
                           │  total_assuntos: INTEGER      │
                           │  media_valor: DECIMAL         │
                           └───────────────────────────────┘
```

## Tecnologias Utilizadas

### **Backend**
- **PHP 8.3**: Linguagem principal
- **Laravel 12.0**: Framework web
- **MySQL**: Sistema de gerenciamento de banco de dados

### **Frontend**
- **AdminLTE 3.15**: Template administrativo responsivo
- **Bootstrap**: Framework CSS para interface
- **Blade Templates**: Sistema de templates do Laravel
- **Vite**: Build tool para assets frontend

### **Ferramentas de Desenvolvimento**
- **Docker & Docker Compose**: Containerização da aplicação
- **Pest 4.0**: Framework de testes moderno
- **Faker**: Geração de dados fictícios para testes

### **Bibliotecas Especializadas**
- **DomPDF**: Geração de relatórios em PDF
- **Laravel Report Generator**: Geração avançada de relatórios
- **Laravel Tinker**: REPL para interação com a aplicação

### **Infraestrutura**
- **Nginx**: Servidor web de alta performance
- **PHP-FPM**: FastCGI Process Manager
- **Composer**: Gerenciador de dependências PHP
- **NPM**: Gerenciador de pacotes JavaScript

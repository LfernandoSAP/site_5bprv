# Portal Institucional - 5º BPRv (Polícia Rodoviária)

Este é o portal modernizado do 5º Batalhão de Polícia Rodoviária da PMESP. O projeto utiliza o framework Laravel com um design system personalizado de alta fidelidade ("Modern Authority").

## 📋 Características Principais
- **Layout "Apple-style":** Design focado em tipografia, espaços em branco e autoridade visual.
- **Rodovia Animada:** Canvas dinâmicos com animações de viaturas TOR e giroflex em tempo real na home.
- **Bento Carousel:** Slider responsivo para destaques institucionais.
- **Compatibilidade Intranet:** Arquitetura adaptada para servidores sem suporte a mod_rewrite/Nginx rewrites.

## ⚙️ Configuração de Ambiente (Importante)
Devido às restrições dos servidores de Intranet da PMESP, o projeto utiliza **Shims Físicos** para o roteamento:

- `index.php`: Gerencia a Home.
- `historico.php`: Gerencia a página de Histórico.
- `redes-sociais.php`: Gerencia a página de Redes Sociais.
- `contato.php`: Gerencia a página de Contato.

**Atenção com Imagens:** O roteador da Intranet busca as imagens em `V:\imagens\`, enquanto o Laravel busca em `V:\public\imagens\`. Sempre mantenha as imagens sincronizadas nessas duas pastas e JAMAIS use a palavra "qrcode" nos nomes de arquivo (os firewalls de rede os bloqueiam).

**Não remova estes arquivos da raiz.** Para adicionar novos links, siga o padrão estabelecido no arquivo `routes/web.php`.

## 📁 Estrutura de Pastas
- `resources/views/layouts/apple.blade.php`: Header, Nav e Footer globais.
- `resources/views/public/`: Conteúdo das páginas individuais.
- `app/Http/Controllers/Site/`: Lógica das páginas principais.

## 🚀 Como Executar Localmente
Para desenvolvimento local:
1. Instale as dependências: `composer install`.
2. Configure o `.env` (DB_HOST, APP_URL).
3. Execute o servidor: `php artisan serve`.

---
*5º BPRv - O Guardião das Rodovias do Sudoeste Paulista*

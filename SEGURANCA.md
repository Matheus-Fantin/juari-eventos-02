# Segurança — Juari Eventos

Guia curto: o que já está protegido, e o que fazer se algo der errado.

## O que já está implementado no código

- **Limite de tentativas de login**: depois de 5 senhas erradas, o sistema bloqueia por um tempo (evita ataque de "adivinhação" de senha).
- **Limite de envio nos formulários públicos** (orçamento e depoimento): no máximo 5 envios por minuto do mesmo visitante — evita spam e sobrecarga.
- **Proteção contra ataques comuns de navegador** (CSRF, clickjacking, MIME sniffing) já ativa em todas as páginas.
- **Upload de fotos restrito**: só aceita imagem (jpg, png, webp), até 8MB, e o arquivo é salvo com nome aleatório — não dá pra enviar um arquivo malicioso disfarçado de foto.
- **Painel administrativo** só acessível por quem tem `papel = admin` no banco — qualquer outra conta logada recebe acesso negado.
- **Sem SQL solto no código**: todas as buscas no banco passam pelo Eloquent (ORM do Laravel), que já evita injeção de SQL.

Isso reduz bastante o risco de spam, força bruta e abuso dos formulários. Mas important: **nenhum código sozinho impede 100% um ataque de "derrubar o site" (DDoS)** — isso se resolve principalmente na hospedagem (Cloudflare, firewall do provedor, etc.), não no código da aplicação. Quando for colocar no ar de verdade, vale a pena usar um provedor que já ofereça isso (a maioria das hospedagens boas já vem com proteção básica).

## Antes de colocar no ar (checklist)

- [ ] `APP_DEBUG=false` no `.env` de produção — **isso é crítico**. Com debug ligado, qualquer erro mostra código-fonte, senhas de configuração e caminhos do servidor pra quem visitar o site.
- [ ] `APP_ENV=production`
- [ ] `SESSION_SECURE_COOKIE=true` (só funciona com HTTPS ativo)
- [ ] Site rodando com **HTTPS** (certificado SSL) — sem isso, senhas e dados trafegam sem criptografia.
- [ ] `.env` nunca deve ser enviado pro GitHub nem ficar acessível pela internet (já está no `.gitignore`).
- [ ] Trocar a senha do primeiro usuário admin de teste antes de divulgar o site.

## O que fazer se algo der errado

**Site fora do ar ou muito lento**
1. Verifique com a hospedagem se o servidor está de pé.
2. Veja o arquivo de log: `storage/logs/laravel.log` (as últimas linhas mostram o erro mais recente).
3. Se for durante uma manutenção sua, pode colocar o site em modo manutenção controlado: `php artisan down` (e `php artisan up` quando terminar) — mostra uma página avisando, em vez de erro.

**Desconfia de acesso indevido (alguém mexeu no painel sem ser você)**
1. Troque a senha de todas as contas com `papel = admin` imediatamente.
2. Revise em `/admin/depoimentos` e `/admin/galeria` se algo foi publicado ou apagado sem você saber.
3. Confira `storage/logs/laravel.log` por atividade fora do horário normal.
4. Se usar WhatsApp Cloud API, gere um novo token de acesso (o antigo pode ter vazado).

**Formulário de orçamento/depoimento sendo usado para spam**
- O limite de 5 envios por minuto já ajuda. Se persistir, dá pra reduzir esse número ou bloquear o IP na hospedagem.

**Perda de dados (depoimentos, fotos, orçamentos sumiram)**
- Sem backup configurado, não tem como recuperar. **Configure backup automático do banco de dados na hospedagem assim que for pro ar** — é o item de segurança mais importante que não está no código, porque depende de onde o site vai morar.

## Próximos passos (quando quiser evoluir aos poucos)

- Backup automático do banco de dados.
- Autenticação em duas etapas (2FA) pro login do admin.
- Monitoramento de erros (ex: alertas por e-mail quando algo quebra).
- Política de senha mais rígida para novas contas.

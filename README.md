# AppBIO

Este é um guia passo-a-passo para instalar e implantar em ambientes de desenvolvimento e produção.

## Instalação em Desenvolvimento

Siga estas etapas para configurar esta aplicação em seu ambiente de desenvolvimento:

1. **Requisitos do Sistema:**
   - Certifique-se de ter o PHP (8.1 ou superior), Composer e Npm instalados em seu sistema. Você pode verificar isso executando:
     ```
     php --version
     composer --version
     npm --version
     ```

2. **Instalação:**
   - Clone este repositório:
     ```
     git clone https://github.com/elvisthermiranda/appbio.git
     ```
   - Instale as dependências com composer:
     ```
     composer install
     composer update
     ```
   - Instale as dependências com npm:
      ```
      npm install
      npm update
      ```

3. **Configuração do Ambiente:**
   - Renomeie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente necessárias, como conexão com banco de dados.

4. **Geração da Chave de Aplicativo:**
   - Execute o comando abaixo para gerar uma chave de aplicativo única:
     ```
     php artisan key:generate
     ```

5. **Execução das Migrações e Seeders:**
    - Se você estiver usando migrações e seeders, execute-os no servidor de produção:
      ```
      php artisan migrate --seed
      ```
    - Caso queira cadastrar alguns pacientes fictícios (senha `password`):
    ```
    php artisan db:seed --class=UserSeeder
    ```

6. **Executando o Servidor de Desenvolvimento:**
   - Inicie o servidor de desenvolvimento:
     ```
     php artisan serve
     ```

6. **Acessando a Aplicação:**
   - Abra seu navegador e vá para `http://localhost:8000` para visualizar a aplicação.

## Deploy em Produção

Aqui estão os passos para implantar este aplicativo em um ambiente de produção:

1. **Preparação do Ambiente:**
   - Certifique-se de que seu ambiente de produção atende aos requisitos do Laravel, incluindo PHP e extensões necessárias.
   ```
   https://laravel.com/docs/10.x/deployment
   ```
   para verificar os módulos instalados `php --modules ou php -m`

2. **Configuração do Banco de Dados:**
   - Configure seu banco de dados no arquivo `.env` do servidor de produção.

3. **Otimização do Ambiente:**
   - Defina o ambiente Laravel como `production` em `.env`:
     ```
     APP_ENV=production
     ```

4. **Configuração do Cache:**
   - Execute os comandos abaixo para limpar e otimizar o cache:
     ```
     php artisan cache:clear
     php artisan config:cache
     php artisan route:cache
     ```

5. **Configuração de filas e Supervisor (opcional):**
   - Se você estiver executando tarefas em segundo plano que precisam ser monitoradas e gerenciadas, como filas de trabalhos (queues), pode ser útil configurar o Supervisor para garantir que esses processos estejam sempre em execução, basta seguir o tutorial da documentação abaixo.
     ```
     https://laravel.com/docs/10.x/queues
     https://laravel.com/docs/10.x/queues#supervisor-configuration
     ```

6. **Servidor Web:**
   - Configure seu servidor web (como Apache ou Nginx) para servir a aplicação a partir do diretório `public`.


7. **Atualização das Dependências:**
   - No servidor de produção, execute:
     ```
     composer install --optimize-autoloader --no-dev
     ```

8. **Atualização das Permissões:**
   - Certifique-se de que as permissões corretas estejam definidas para os arquivos e diretórios da aplicação, conforme necessário.

9. **Execução das Migrações e Seeders:**
    - Se você estiver usando migrações e seeders, execute-os no servidor de produção:
      ```
      php artisan migrate --seed
      ```

10. **Teste da Aplicação:**
    - Após a implantação, teste sua aplicação em um ambiente de produção para garantir que tudo esteja funcionando conforme o esperado.

---

Este guia deve ajudá-lo a instalar e implantar este aplicativo tanto em ambientes de desenvolvimento quanto de produção. Ao executar as migratios e os seeders, vai ser criado um usuário administrador `superadmin@email.com.br` e a senha é `password`, não se esqueça de alterá-los.

## Requisitos

* PHP 8.1 ou superior
* Composer
* Npm
## Instalação e configuração

#### Instalando pacotes e dependências

1º (obrigatório)
```
Faça uma cópia do arquivo '.env.example' e renomeie a cópia para '.env'
```

2º - instalação das bibliotecas e dependências(obrigatório)
```
composer install
```

3º - instalação das bibliotecas e dependências(obrigatório)
```
npm install
```

4º - Gera uma chave secreta da aplicação(obrigatório)
```
php artisan key:generate
```

5º - Inicializar o servidor de desenvolvimento
```
php artisan serve
```

6º - Gerar bundle dos recursos(css/js)
```
npm run dev
```

7º Executar as migrations
```
php artisan migrate
```

8º Executar Seeder
```
php artisan db:seed
```

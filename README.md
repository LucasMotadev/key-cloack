#### Cometa KeyCloack

Uma simples biblioteca para "authentication/authorization" no sso *[keycloack](<https://www.keycloak.org/>)* ultilizando o protrotocolo **openid-connect**.

A **authorization** funciona apens para permissoes baseadas em _escopos_ ou permissoes baseadas em _recursos_, para saber mais acesse *[KeyCloack Authorization Services](<https://www.keycloak.org/docs/latest/authorization_services/index.html>)*

##### Instalação 
 * Instalar usando o composer: ``composer require cometa/keycloack``
 * Publicar arquivos de configuração: Se você esta ultilizando **laravel** execulte o senguite codigo no terminal ``php artisan vendor:publish`` isso fará com com o laravel crie os arquivos de configuração em _config/keyCloack.php_ e _config/auth.php_ caso isso não sai como esperado ou se voce ultiliza  **laravel/lumen** será necessario fazer isso manualmente. Basta copiar _vendor/cometa-keycloack/config/*_ para _config/_.
 * Registrar providers: Adicione a linha em *_bootstrap/app.php_* 
 ~~~php
 $app->register(Cometa\KeyCloack\Providers\KeyCloackServiceProvider::class);
 ~~~

 * Registrar middlewares **authorization** e **authentication**: adicionar as linhas em _bootstrap/app.php_ 
 
 ~~~php 
 $app->routeMiddleware([
    'auth' => Cometa\KeyCloack\Middlewares\Authenticate::class,
    'permission' => Cometa\KeyCloack\Middlewares\Authorization::class
 ]);

~~~

Se voce seguiu todas os passos corretamente basta chamar o middleware um sua rota. O middleware **permission** recebe um parametro _route#scoped_, para entender mais sobre contrele de acesso com keyclock acesse *[keycloack](<https://www.keycloak.org/>)*

~~~php
$router->get('/keycloack', [
    'uses' => "KeyCloackController@index",
    'middleware' => ['auth', 'permission:users#list-all']
]);

~~~

#### Exemplos

* Captura o usuario autheticado

~~~php
    
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     **/
    Illuminate\Support\Facades\Auth::user();

~~~
 * Verificar se o usuario logado possui um papel
  
~~~php

    /**
     * @param  array<App\Model\Role>| Role
     * @return bool
     **/
     Illuminate\Support\Facades\Auth::hasRoles(Role::admin);
     ## OR
     Illuminate\Support\Facades\Auth::hasRoles([Role::admin, Role::gestor]);
~~~

* Retornas todas as permissoes do usuario logado

~~~php
    /**
     * @return array
     **/
    Illuminate\Support\Facades\Auth::allPermission();
~~~

* Retornas todos os papeis

~~~php
    /**
     * @return array
     **/
    Illuminate\Support\Facades\Auth::getRoles();

~~~

* Retorna um atributos contido no token

~~~php
    /**
     * @param string
     * @return mixed
     **/
    Illuminate\Support\Facades\Auth::getAttribute("name");

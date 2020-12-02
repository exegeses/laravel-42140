# Notas de autenticación

> Vamos a utilizar Jetstream que tambien utiliza Tailwind

> Además hay dos stacks que son: Livewire o Inertia.js

> Livewire es Laravel + Blade 

> Inertia.js utiliza Vue.js

> Guía de Jetstream  
    https://jetstream.laravel.com/1.x/introduction.html

## Comandos:

    composer require laravel/jetstream     

> Instalar con livewire

    php artisan jetstream:install livewire   
    
> npm

    npm intall
    npm run dev    
    
> ejecutar migraciones

    php artisan migrate   


## Exportar componentes de blade

    php artisan vendor:publish --tag=jetstream-views

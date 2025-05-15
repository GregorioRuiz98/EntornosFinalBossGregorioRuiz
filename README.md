# Gestión de Eventos - Proyecto Laravel

Este proyecto es una aplicación Laravel para la gestión de eventos. Permite listar eventos, mostrar sus detalles y gestionar los datos desde un sistema backend.

A continuación, se presenta una guía paso a paso sobre cómo configurar el proyecto, los problemas encontrados y cómo se han solucionado.

---

## **Requisitos Previos**

Antes de iniciar la configuración del proyecto, asegúrese de cumplir con los siguientes requisitos:

- **PHP**: Versión 8.1 o superior.
- **Composer**: Herramienta de gestión de dependencias para PHP.
- **MySQL** o **MariaDB**: Base de datos relacional.
- **Node.js y npm**: Para la gestión de dependencias del frontend.
- **Git**: Para clonar el repositorio y gestionar el código fuente.

---

## **Pasos Iniciales para Configurar el Proyecto**

### 1. **Clonar el Repositorio**
Abra una terminal y ejecute el siguiente comando para clonar el repositorio del proyecto en su máquina local:

```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd gestion-eventos
```

### 2. **Instalar Dependencias**
Instale las dependencias necesarias para el backend (PHP) y el frontend (JavaScript):

- **Dependencias de PHP**:
  ```bash
  composer install
  ```

- **Dependencias de Node.js**:
  ```bash
  npm install
  ```

### 3. **Configurar el Archivo `.env`**
Cree un archivo `.env` basado en `.env.example` para configurar las credenciales del entorno:

```bash
cp .env.example .env
```

Edite el archivo `.env` con las credenciales de su base de datos, por ejemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_eventos
DB_USERNAME=root
DB_PASSWORD=
```

### 4. **Generar la Clave de la Aplicación**
Laravel requiere una clave única para la aplicación. Genérela con el siguiente comando:

```bash
php artisan key:generate
```

### 5. **Ejecutar Migraciones**
Para crear las tablas necesarias en la base de datos, ejecute las migraciones:

```bash
php artisan migrate
```

Si encuentra errores como `Base table or view already exists`, consulte la sección [Solución de Problemas](#solución-de-problemas).

---

## **Rutas y Controladores**

### Rutas Configuradas
El archivo `routes/web.php` contiene las siguientes rutas principales:

```php
use App\Http\Controllers\EventosController;

// Página de inicio con lista de eventos
Route::get('/', [EventosController::class, 'index'])->name('eventos.index');

// Página de detalles de un evento
Route::get('/eventos/{id}', [EventosController::class, 'show'])->name('eventos.show');
```

### Controlador `EventosController`
El controlador `EventosController` gestiona las solicitudes para las rutas definidas:

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventosController extends Controller
{
    // Mostrar lista de eventos
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    // Mostrar detalles de un evento
    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.show', compact('evento'));
    }
}
```

---

## **Vistas**

A continuación, se presentan las vistas utilizadas en el proyecto.

### Lista de Eventos (`resources/views/eventos/index.blade.php`)
Muestra la lista de eventos disponibles:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
</head>
<body>
    <h1>Lista de Eventos</h1>
    <ul>
        @foreach ($eventos as $evento)
            <li>
                <h2>{{ $evento->titulo }}</h2>
                <p>{{ $evento->descripcion }}</p>
                <p>Fecha: {{ $evento->fecha }}</p>
                <a href="{{ route('eventos.show', $evento->id) }}">Ver más</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
```

### Detalles del Evento (`resources/views/eventos/show.blade.php`)
Muestra los detalles de un evento específico:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Evento</title>
</head>
<body>
    <h1>{{ $evento->titulo }}</h1>
    <p>{{ $evento->descripcion }}</p>
    <p>Fecha: {{ $evento->fecha }}</p>
    <a href="{{ route('eventos.index') }}">Regresar a la lista</a>
</body>
</html>
```

---

## **Solución de Problemas**

### Problema 1: `Base table or view already exists`
Si al ejecutar una migración aparece el error `Base table or view already exists`, significa que la tabla ya existe. Para solucionarlo, puede:

1. **Eliminar la Tabla Manualmente**:
   - Acceda a la base de datos con phpMyAdmin o MySQL Workbench.
   - Ejecute el comando:
     ```sql
     DROP TABLE eventos;
     ```

2. **Eliminar el Registro de la Migración**:
   - Abra la tabla `migrations`.
   - Elimine la fila correspondiente a `create_eventos_table`.

3. **Reiniciar Todas las Migraciones**:
   - Este comando eliminará todas las tablas y volverá a migrar:
     ```bash
     php artisan migrate:reset
     php artisan migrate
     ```

---

### Problema 2: Error con el Comando `vendor:publish`
Si aparece un error relacionado con el comando `vendor:publish`, asegúrese de ejecutarlo correctamente:

- Publicar todos los recursos:
  ```bash
  php artisan vendor:publish
  ```

- Publicar un proveedor específico:
  ```bash
  php artisan vendor:publish --provider="Nombre\Proveedor"
  ```

---

## **Iniciar el Servidor de Desarrollo**

1. Inicie el servidor de desarrollo de Laravel:
   ```bash
   php artisan serve
   ```

2. Abra la URL generada en su navegador (por defecto: [http://localhost:8000](http://localhost:8000)).

---

## **Notas para el Profesor**

- Los pasos están documentados para replicar la configuración desde cero, solucionar errores comunes y entender cómo está estructurado el proyecto.
- Si algo no está claro o persiste un problema, los mensajes de error recientes se pueden encontrar en el archivo `storage/logs/laravel.log`.

Gracias por su paciencia y atención al revisar el proyecto.

---

## **Licencia**
El proyecto está licenciado bajo la [MIT License](LICENSE).
# Guía de Contribución - E-Vet

¡Gracias por interesarte en contribuir a E-Vet! Este documento proporciona directrices para contribuir al proyecto.

## 📋 Antes de Comenzar

1. Lee el [README.md](README.md) para entender el proyecto
2. Familiarízate con la estructura del proyecto
3. Asegúrate de tener los requisitos previos instalados

## 🔧 Configuración del Entorno de Desarrollo

### Paso 1: Fork y Clone
```bash
# Fork el repositorio en GitHub
# Luego clona tu fork:
git clone https://github.com/TU_USUARIO/e-vet.git
cd e-vet
```

### Paso 2: Crear una Rama de Trabajo
```bash
git checkout -b feature/mi-caracteristica
# o para bugs:
git checkout -b fix/mi-bug
```

### Paso 3: Configurar Entorno Local
```bash
# Instalar dependencias PHP
composer install

# Instalar dependencias Node
npm install

# Copiar archivo de configuración
cp .env.example .env

# Generar APP_KEY
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# (Opcional) Llenar BD con datos de ejemplo
php artisan db:seed
```

### Paso 4: Iniciar Servidor de Desarrollo
En una terminal:
```bash
php artisan serve
```

En otra terminal (para compilar assets con hot-reload):
```bash
npm run dev
```

La aplicación estará en: http://localhost:8000

## ✅ Estándares de Código

### PHP
- Seguir [PSR-12](https://www.php-fig.org/psr/psr-12/) como estándar de código
- Usar Laravel best practices
- Hacer el código legible y bien comentado
- Usar nombres descriptivos para variables y funciones

### Verificar Formato
```bash
./vendor/bin/pint  # Formatea el código automáticamente
./vendor/bin/pint --check  # Solo verifica sin cambiar
```

### JavaScript/Frontend
- Seguir estándares de ES6+
- Usar nombres significativos
- Comentar código complejo
- Mantener consistencia con el código existente

### Blade Templates
- Identar correctamente (2 espacios)
- Usar componentes de Blade cuando sea posible
- Mantener templates simples y legibles

## 🧪 Tests

### Ejecutar Tests
```bash
php artisan test                    # Ejecutar todos los tests
php artisan test --filter=NombreTest  # Ejecutar test específico
php artisan test --debug           # Modo verbose
```

### Escribir Tests

#### Test Unitario Ejemplo
```php
// tests/Unit/ExampleTest.php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_basic_math()
    {
        $this->assertEquals(2, 1 + 1);
    }
}
```

#### Test Funcional Ejemplo
```php
// tests/Feature/ExampleTest.php
namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_application_returns_a_successful_response()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
```

### Requisitos de Tests
- Todos los tests deben pasar antes de enviar un Pull Request
- Agregar tests para nuevas funcionalidades
- Mantener o mejorar la cobertura de tests

```bash
php artisan test --coverage  # Ver cobertura de tests
```

## 📝 Commits

### Mensajes de Commit
- Usar presente indicativo: "Agregar" en lugar de "Agregó"
- Ser conciso pero descriptivo
- Primera línea máximo 50 caracteres
- Detalles adicionales en líneas posteriores si es necesario

Ejemplos:
```bash
git commit -m "Agregar validación de email en formulario de registro"
git commit -m "Corregir bug en cálculo de edad de mascotas"
git commit -m "Mejorar rendimiento de consultas de propietarios"
```

### Buenas Prácticas
- Hacer commits pequeños y atómicos
- Un cambio lógico = un commit
- No mezclar cambios de funcionalidades diferentes

## 🔄 Pull Requests

### Antes de Enviar

1. **Actualizar rama con main**
   ```bash
   git fetch origin
   git rebase origin/main
   ```

2. **Verificar código**
   ```bash
   ./vendor/bin/pint              # Formatear código
   php artisan test               # Ejecutar tests
   ```

3. **Verificar funcionalidad manualmente** en el navegador

### Enviar Pull Request

1. Push a tu fork:
   ```bash
   git push origin feature/mi-caracteristica
   ```

2. Crea un Pull Request en GitHub:
   - Título claro y descriptivo
   - Descripción detallada del cambio
   - Referencia a issues relacionados (si existen)
   - Pasos para probar el cambio

### Plantilla de Descripción PR
```markdown
## Descripción
Breve descripción del cambio

## Tipo de Cambio
- [ ] Bug fix
- [ ] Nueva funcionalidad
- [ ] Cambio que rompe compatibilidad
- [ ] Documentación

## Cambios
- Cambio 1
- Cambio 2

## Tests
- [ ] He agregado tests para mi cambio
- [ ] Todos los tests pasan
- [ ] Nueva cobertura de código

## Pasos para Probar
1. Paso 1
2. Paso 2

## Screenshots (si aplica)
Agregar capturas si es cambio visual
```

### Durante la Revisión

- Responde con respeto a los comentarios
- Haz los cambios solicitados
- Re-solicita revisión cuando completes cambios

## 🎨 Estilo de Código - Ejemplos

### Estructura de Modelos
```php
// app/Models/Pet.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    protected $fillable = [
        'name',
        'species',
        'breed',
        'age',
        'owner_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
}
```

### Filament Resources
```php
// app/Filament/Resources/PetResource.php
namespace App\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;

class PetResource extends Resource
{
    protected static ?string $model = Pet::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                // más campos...
            ]);
    }
}
```

## 🐛 Reporte de Bugs

### Si encuentras un bug:
1. Verifica que no esté ya reportado
2. Crea un issue con:
   - Título descriptivo
   - Pasos para reproducir
   - Comportamiento esperado
   - Comportamiento actual
   - Capturas de pantalla (si aplica)
   - Información del sistema

## 🚀 Características Nuevas

### Para proponer una nueva característica:
1. Abre un issue de "feature request"
2. Describe la funcionalidad
3. Explica casos de uso
4. Espera feedback antes de empezar a trabajar

## 📖 Documentación

- Actualizar README.md para cambios visibles al usuario
- Agregar comentarios en código complejo
- Documenta funciones públicas
- Actualizar CONTRIBUTING.md si cambian procesos

## 🔐 Seguridad

- No hagas commit de información sensible (.env, credenciales, keys)
- Valida inputs de usuario
- Sigue Laravel security practices
- Reporta vulnerabilidades en privado

## 📚 Recursos Útiles

- [Laravel Documentation](https://laravel.com/docs)
- [Filament Documentation](https://filamentphp.com)
- [PSR Standards](https://www.php-fig.org)
- [Git Documentation](https://git-scm.com/doc)

## ❓ Preguntas?

- Abre un issue con la etiqueta "question"
- Revisa issues cerrados similares
- Contacta a los mantenedores

## 📋 Checklist Pre-Submisión

Antes de enviar un Pull Request, verifica:

- [ ] El código sigue los estándares (ejecutar `./vendor/bin/pint`)
- [ ] Todos los tests pasan (`php artisan test`)
- [ ] Agregué tests para funcionalidad nueva
- [ ] La documentación está actualizada
- [ ] No hay conflictos con main
- [ ] Los commits tienen mensajes claros
- [ ] No hay código comentado innecesario
- [ ] No hay archivos secretos (.env, credentials)
- [ ] He testeado manualmente en el navegador

¡Gracias por contribuir! 🎉

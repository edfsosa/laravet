# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Development (PHP server + Vite en una terminal)
composer run dev

# Individual servers
php artisan serve
npm run dev

# Tests
php artisan test
php artisan test --filter=NombreDelTest

# Code formatting
./vendor/bin/pint

# Migrations & seeders
php artisan migrate
php artisan db:seed
php artisan migrate:fresh --seed

# Filament
php artisan filament:make-resource NombreRecurso --generate
php artisan filament:make-widget NombreWidget
```

## Arquitectura

**Laravet** es un sistema de gestión clínica veterinaria para la clínica "Mbopivet" (Areguá, Paraguay). Proyecto de tesis final de Ingeniería Informática — UCSA.

Stack: Laravel 11 + Filament 3 (panel admin) + Vite + SQLite (default) / MySQL.

### Modelo de dominio

El flujo central es: `User (veterinario)` atiende `Pet (mascota)` que pertenece a `Owner (propietario)`.

Cada `Pet` tiene cuatro tipos de registros médicos, todos con `belongs_to` a `Pet` y `User`:
- `Consultation` — anamnesis, diagnóstico, tratamiento
- `Vaccination` — fecha aplicación, próxima aplicación, lote, fabricante
- `Surgery` — fecha, tipo, observación
- `Test` — fecha, tipo, resultado

La localización sigue la jerarquía paraguaya: `Department → City → Neighborhood`. Tanto `User` como `Owner` tienen los tres campos de ubicación. Los selects de ciudad y barrio son dinámicos (dependen del departamento/ciudad seleccionado).

### Panel admin (Filament)

Toda la funcionalidad CRUD vive en `/app/Filament/Resources/`. No hay controladores personalizados — Filament maneja todo. El panel se configura en `app/Providers/Filament/AdminPanelProvider.php` (color amber, modo SPA, sidebar colapsable).

Los recursos principales son `PetResource` y `OwnerResource`. `PetResource` agrupa los cuatro tipos de registros médicos como **RelationManagers** (en `/app/Filament/Resources/PetResource/RelationManagers/`), permitiendo gestión contextual desde la ficha de la mascota.

`ConsultationResource`, `SurgeryResource` y `TestResource` usan página tipo `ManageRecords` (sin List/Create/Edit separados). `VaccinationResource` tiene páginas Create y Edit propias.

El widget `PetSpeciesOverview` muestra estadísticas de especies en el dashboard.

### Tareas programadas

`routes/console.php` define el comando `send:vaccination-notifications` que corre cada minuto para recordatorios de vacunación.

### Convenciones del proyecto

- Los modelos usan `cascadeOnDelete()` en las foreign keys — no hay soft deletes.
- Los campos de `Pet` como `species`, `gender`, `size`, `reproduction` son enums PHP definidos directamente en el modelo.
- Las imágenes de mascotas se suben con el editor de imágenes de Filament.
- La base de datos por defecto es SQLite (`database/database.sqlite`). Para MySQL, configurar `DB_*` en `.env`.

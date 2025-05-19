# 🏨 Sistema de Gestión Hotelera - Laravel

<div align="center">
    <img title="a title" alt="Alt text" src="https://github.com/user-attachments/assets/14b2d50e-6dc0-4745-ba4b-c039f795bb38">
</div>

Este proyecto es un **Sistema de Información para la Optimización y Gestión de Hoteles**, desarrollado con Laravel. Su propósito principal es centralizar y optimizar la administración de reservas, facturación, servicios adicionales y clientes, proporcionando una plataforma moderna, segura y accesible.

## 🎯 Objetivo General

Desarrollar un sistema integral que permita centralizar y optimizar los procesos de reservas, facturación, control de servicios adicionales y gestión integral de clientes en un entorno hotelero.

## 🎯 Objetivos Específicos

1. Recolectar información operativa mediante entrevistas y cuestionarios.
2. Centralizar operaciones hoteleras en una sola plataforma.
3. Automatizar la gestión de reservas con disponibilidad en tiempo real.
4. Controlar el estado de las habitaciones (disponible, ocupada, mantenimiento, limpieza).
5. Gestionar servicios adicionales como spa, lavandería, transporte, etc.
6. Mejorar la experiencia del huésped con un portal interactivo.
7. Facilitar la facturación electrónica cumpliendo normativas fiscales.
8. Ofrecer herramientas de análisis y generación de reportes.
9. Implementar roles y niveles de acceso para seguridad y privacidad.
10. Diseñar una interfaz intuitiva y accesible para distintos dispositivos.
11. Garantizar la accesibilidad multiplataforma.
12. Minimizar errores operativos y tareas repetitivas.
13. Asegurar la escalabilidad del sistema.

## 📦 Alcance del Sistema

### 📅 Reservas y Administración de Habitaciones
- Calendario con disponibilidad en tiempo real.
- Confirmaciones automáticas por correo.
- Check-in y check-out digitales.
- Historial de reservas para clientes.

### 🔐 Gestión de Usuarios y Seguridad
- Roles (administrador, recepcionista, limpieza, cliente).
- Autenticación segura con cifrado y doble factor.
- Auditoría y registro de accesos.

### 💳 Facturación y Pagos
- Integración con métodos de pago: tarjetas, PayPal, transferencias.
- Facturas digitales automáticas.
- Historial de pagos y deudas.

### 🛎️ Servicios Adicionales y Catálogo Digital
- Catálogo interactivo de servicios adicionales.
- Reserva y cobro integrado de servicios extra.

### 🗺️ Geolocalización y Mapa Interactivo
- Mapa con ubicación del hotel.
- Rutas, transporte y atracciones cercanas.

---

## 🛠️ Instalación y Configuración del Proyecto en Windows

### ✅ Requisitos Previos

- PHP >= 8.1
- Composer
- Laravel >= 10
- MySQL o MariaDB
- Node.js & NPM
- Git (opcional)
- Extensiones PHP: `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`

# 🤝 Contribuir al Proyecto: Sistema de Información 1-1-2025

¡Gracias por tu interés en contribuir a este sistema de gestión hotelera desarrollado con Laravel!

Este proyecto busca centralizar procesos clave como la gestión de clientes, reservas, servicios, facturación y más, para mejorar la eficiencia operativa de los hoteles.

---

## 🚀 Cómo empezar

### 1. Haz un Fork del repositorio

Dirígete a [https://github.com/NoelSandoval-15/sistema-de-informacion1-1-2025](https://github.com/NoelSandoval-15/sistema-de-informacion1-1-2025) y haz clic en el botón `Fork` (arriba a la derecha). Esto creará una copia del repositorio en tu cuenta de GitHub.

### 2. Clona tu fork en tu máquina local

```bash
git clone https://github.com/TU_USUARIO/sistema-de-informacion1-1-2025.git
cd sistema-de-informacion1-1-2025
```

3. Crea una nueva rama para tus cambios
```bash
git checkout -b nombre-de-tu-rama
```

## Pasos para levantar el proyecto

```bash
composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

npm run dev

php artisan serve

```
Luego abre tu navegador en http://localhost:8000


## 📤 Subir cambios y enviar PR
Guarda tus cambios:

```bash
git add .

git commit -m "Un mensaje descriptivo"

git push origin nombre-de-tu-rama
```
Ve a tu fork en GitHub y haz clic en "Compare & pull request" para enviar tu solicitud de cambios al repositorio original.

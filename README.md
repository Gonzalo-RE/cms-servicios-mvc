# 🚀 Sistema CMS de Gestión de Servicios (PHP, MySQL & MVC)

Un sistema de gestión de contenidos (CMS) modular, seguro y escalable desarrollado en PHP 8+ nativo utilizando el patrón de arquitectura **MVC (Modelo-Vista-Controlador)**, **Front Controller**, **Prepared Statements (PDO)** y una **API RESTful**.

---

## 🛠️ Tecnologías y Características

- **Backend:** PHP 8+ (Programación Orientada a Objetos, PDO)
- **Base de Datos:** MySQL / MariaDB
- **Arquitectura:** MVC (Model-View-Controller) con Front Controller (`public/index.php`)
- **Seguridad:**
  - Encriptación de contraseñas con `password_hash()` (BCRYPT).
  - Autenticación mediante sesiones seguras.
  - Protección contra ataques **CSRF** mediante tokens validados a tiempo constante (`hash_equals`).
  - Control de Acceso Basado en Roles (**RBAC**): Diferenciación de permisos entre `admin` y `cliente`.
  - Sanitización de entradas contra ataques **XSS** (`htmlspecialchars`).
  - Prevención de **Inyección SQL** mediante *Prepared Statements* con PDO.
- **Frontend:** HTML5, CSS3 (Componentes y plantillas reutilizables `header.php` y `footer.php`).
- **API RESTful:** Endpoints públicos en formato JSON para consumo desde aplicaciones externas.

---

## 📂 Estructura del Proyecto

```text
mi-primer-backend/
├── app/
│   ├── config/
│   │   ├── database.php       # Conexión PDO y cargador de .env
│   │   └── security.php       # Utilidades para tokens CSRF
│   ├── controllers/
│   │   ├── ServicioController.php  # Lógica del panel administrativo
│   │   └── ApiController.php       # Endpoints de la API RESTful (JSON)
│   ├── models/
│   │   └── Servicio.php       # Consultas SQL centralizadas
│   └── views/
│       ├── auth/
│       │   └── login.php
│       ├── servicios/
│       │   ├── index.php
│       │   ├── crear.php
│       │   └── editar.php
│       └── templates/
│           ├── header.php
│           └── footer.php
├── public/
│   └── index.php              # Front Controller / Enrutador principal
├── .env                       # Variables de entorno (Ignorado por Git)
├── .env.example               # Plantilla de variables de entorno
└── .gitignore                 # Archivos excluidos del repositorio
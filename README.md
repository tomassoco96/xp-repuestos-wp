# XP Repuestos · Child theme de WordPress

Child theme de Blocksy para el rediseño de **xprepuestos.com.ar**. Aplica la identidad oficial XP (paleta carbón + rojo, tipografía Montserrat + Saira) sobre WooCommerce. Cero mensualidades nuevas — todo gratis.

## Stack

| Capa | Solución |
|---|---|
| CMS | WordPress 6.5+ |
| Ecommerce | WooCommerce |
| Pagos | Plugin Mercado Pago (existente, no se toca) |
| Theme padre | **Blocksy** (gratis) — debe estar instalado y activo |
| Theme child | **este repo** (XP Repuestos) |
| Bloques custom | Patterns nativos de Gutenberg + clases CSS del theme |
| Motion | CSS animations + IntersectionObserver vanilla — sin librerías externas |

Todo MIT / GPL. Cero licencias pagas.

## Requisitos

- WordPress **6.5** o superior
- PHP **8.0** o superior
- WooCommerce activado
- Theme **Blocksy** instalado (Apariencia → Temas → Buscar "Blocksy" → Instalar)

## Instalación

### Opción A — Subir desde el panel de WordPress

1. Descargar el contenido de esta carpeta como `.zip`.
2. WP admin → Apariencia → Temas → Añadir nuevo → Subir tema → seleccionar el .zip → Instalar → Activar.
3. Listo: el child theme se activa, hereda Blocksy y aplica los estilos XP.

### Opción B — Vía SFTP (recomendado para producción)

1. Conectarse al hosting por SFTP/FTP.
2. Subir esta carpeta a `wp-content/themes/xp-repuestos/`.
3. WP admin → Apariencia → Temas → Activar **XP Repuestos**.

### Opción C — Vía CLI (si hay acceso SSH al hosting)

```bash
cd wp-content/themes/
git clone https://github.com/tomassoco96/xp-repuestos-wp.git xp-repuestos
wp theme activate xp-repuestos
```

## Configuración después de activar

### 1. Datos del comercio

Apariencia → Personalizar → **XP Repuestos · Datos del comercio**

Editables: WhatsApp, email, dirección, Instagram, mensaje de envío gratis. Todo lo que aparece en header / footer / FAB se controla acá.

### 2. Crear las páginas estáticas con los patterns

WP admin → Páginas → Añadir nueva. En el editor de bloques, click en `+` (Inserter) → tab **Patterns** → categoría **XP Repuestos**.

Para la **home**:
- Insertar pattern **XP Hero**
- Insertar pattern **XP Marquee de marcas**
- Insertar pattern **XP Categorías destacadas**
- Insertar pattern **XP Productos destacados** (requiere productos marcados como destacados en WooCommerce)
- Insertar pattern **XP Por qué elegirnos**
- Insertar pattern **XP CTA Mayorista**
- Apariencia → Personalizar → Página de inicio estática → seleccionar esta página.

Para **mayorista**, **nuestra historia**, **contacto**, **FAQs**, **políticas** — crear cada página y armarla con bloques nativos de Gutenberg + las clases utilitarias del theme (`xp-section`, `xp-container`, `xp-eyebrow`, etc.).

### 3. Importar los 250 productos

Los productos limpios y categorizados están en el otro repo:
[`tomassoco96/xp-repuestos`](https://github.com/tomassoco96/xp-repuestos) → `src/data/products.json`

**Opciones de importación**, en orden de fricción:

**A. Plugin gratis "Product Import Export for WooCommerce"** (recomendado)
1. Convertir el JSON a CSV con el script `scripts/json-to-woocommerce-csv.php` (ver más abajo).
2. WooCommerce → Productos → Importar → seleccionar CSV → mapear columnas → ejecutar.
3. Tiempo: 5 min para los 250.

**B. Vía REST API + Application Password** (lo que hago yo cuando me pases credenciales)
1. Generás Application Password (ver sección "MCP de WordPress" abajo).
2. Yo corro un script Node que hace `POST /wp-json/wc/v3/products` por cada producto.
3. Tiempo: ~5 min.

**C. WP-CLI** (si hay SSH al hosting)
```bash
wp wc product create --name="Casco Vertigo V32" --regular_price="57983" --user=admin
```

### 4. Categorías de WooCommerce

Crear estos slugs exactos en Productos → Categorías para que coincidan con los patterns:
- `cascos`
- `motor`
- `electrico`
- `rodante`
- `tornilleria`

## Estructura del repo

```
xp-repuestos-wp/
├── style.css                       Header del child theme
├── functions.php                   Bootstrap (carga inc/, helpers)
├── theme.json                      Config Gutenberg (paleta, fuentes, spacing)
├── README.md                       Esto
├── .gitignore
├── .mcp-config.example.json        Plantilla MCP para cuando lleguen accesos
├── assets/
│   ├── css/theme.css              Todos los estilos (tokens + components + WC overrides)
│   ├── js/motion.js               Reveal, tilt, mobile nav, progress bar
│   └── images/                    Logos SVG (color, dark, stack, favicon)
├── inc/
│   ├── enqueue.php                Registro de assets + fonts + favicon
│   ├── woocommerce.php            Customizer + WC overrides + WhatsApp FAB + schema
│   └── patterns-loader.php        Categoría custom de patterns
├── patterns/                      Block patterns (Gutenberg)
│   ├── hero.php                   Hero cinemático con logo + trust bar
│   ├── marquee.php                Ticker de marcas
│   ├── categories.php             Grid 4 columnas categorías
│   ├── featured-products.php      Productos destacados (top ventas)
│   ├── why-xp.php                 4 razones por qué XP
│   └── wholesale-cta.php          Banner mayorista
└── woocommerce/                   Templates override
    └── content-product.php        Card de producto en archive (estilo .xp-card)
```

## MCP de WordPress · Plan de instalación

### Estado actual

- **NO instalado todavía.** Esperamos los accesos al WP del cliente para configurar el MCP con Application Password real (sin accesos, la config queda vacía y no sirve).
- **Investigado**: el más reputable y oficial es [Automattic/mcp-wordpress-remote](https://github.com/Automattic/mcp-wordpress-remote) (publicado por Automattic, los creadores de WordPress.com y WooCommerce). Se autentica vía Application Password — no expone usuario/contraseña real. Permisos limitados al rol del usuario que generó el password.
- Alternativa oficial nueva: [WordPress/mcp-adapter](https://github.com/wordpress/mcp-adapter) — plugin server-side basado en Abilities API (en core de WP 6.9). Más capacidades pero requiere instalar plugin en el sitio del cliente.

### Cuando lleguen accesos

1. **WP admin** → Users → Profile → Application Passwords → crear una con nombre `Claude Code XP`.
2. Copiar el password generado (formato `xxxx xxxx xxxx xxxx xxxx xxxx`).
3. Configurar el MCP en `~/.claude.json` o `settings.json`:
   ```json
   {
     "mcpServers": {
       "wordpress": {
         "command": "npx",
         "args": ["-y", "@automattic/mcp-wordpress-remote"],
         "env": {
           "WP_API_URL": "https://xprepuestos.com.ar",
           "WP_API_USERNAME": "tu-usuario-wp",
           "WP_API_PASSWORD": "xxxx xxxx xxxx xxxx xxxx xxxx"
         }
       }
     }
   }
   ```
4. Reiniciar Claude Code → el MCP queda disponible para crear/editar productos, posts, páginas, etc.

### Seguridad — checklist antes de instalar

- ✅ El MCP corre **localmente** (en tu máquina con Claude Code), no expone nada en el servidor del cliente.
- ✅ La autenticación usa **Application Password** (revocable individualmente, no tira el login normal).
- ✅ El password se guarda en el archivo de config de Claude Code (filesystem local, no en repo).
- ✅ El paquete está en npm bajo el namespace `@automattic/` — verificable en https://www.npmjs.com/package/@automattic/mcp-wordpress-remote.
- ⚠️ Antes del `npx`, revisar el package.json del MCP por si tiene postinstall scripts sospechosos. La política sana es **siempre auditar antes de correr** un paquete que no es nuestro.

## Cómo previsualizar el theme sin instalar nada

Ver el diseño en acción **antes** de tener accesos al WP del cliente:

### Opción 1 — WordPress Playground (en navegador, 30-60 seg)

WordPress Playground corre WP en WASM dentro del navegador (proyecto oficial de WordPress.org). Le pegás este link y se levanta WP + Blocksy + WooCommerce + este child theme con 14 productos demo cargados:

**👉 [Abrir preview en Playground](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/tomassoco96/xp-repuestos-wp/main/playground/blueprint.json)**

Notas:
- La carga inicial demora 30-60 seg porque baja WP, Blocksy y WooCommerce sobre la marcha.
- Es una sesión efímera — todo lo que cambies en la preview se pierde al cerrar la pestaña.
- No hay checkout funcional (no tiene sentido en preview), solo el catálogo + diseño.
- Si querés ver el admin, agregá `/wp-admin/` al final de la URL del Playground.

### Opción 2 — Local con `wp-now` (requiere Node.js)

```bash
# En la carpeta del child theme
npx @wp-now/wp-now start
```

`wp-now` levanta WP local en `http://localhost:8881` con el theme actual cargado. Hay que instalar Blocksy y WooCommerce manualmente desde el admin la primera vez.

### Opción 3 — Local con LocalWP (app gráfica)

Descargar [Local](https://localwp.com/) (gratis), crear un sitio, copiar este folder a `wp-content/themes/xp-repuestos/`, instalar Blocksy + WooCommerce desde el admin, activar el child theme.

## Próximos pasos sin accesos del cliente

Lo que SÍ se puede hacer hoy sin accesos:
- ✅ Tener el child theme listo (este repo).
- ✅ Setup local con WordPress + WooCommerce + Mercado Pago de prueba (LocalWP, DDEV o XAMPP) para validar que todo funciona contra una BD real.
- ✅ Convertir los 250 productos a CSV de WooCommerce para importar de un paso.
- ❌ Subir nada a producción (requiere acceso al hosting).
- ❌ Probar el MCP (requiere URL + Application Password reales).

## Mantenimiento futuro

Como ya hablamos: WP + WooCommerce + plugins requieren updates regulares. Recomendaciones:

- **Backups automáticos**: instalar **UpdraftPlus** (gratis, free tier suficiente) y configurar backup diario a Google Drive o similar.
- **Updates**: WP core, plugins y theme cada 2-4 semanas. Antes de actualizar, hacer backup.
- **Monitoreo**: **WP Activity Log** (free) para auditar cambios. **Wordfence Free** o **Solid Security Free** para seguridad básica.
- **Cache**: si el hosting es LiteSpeed, **LiteSpeed Cache** (gratis). Si no, **W3 Total Cache** o **WP Super Cache** (free).
- **Imágenes**: **EWWW Image Optimizer** (free tier) o **WebP Express** (gratis).

## Referencias

- Repo Astro/Vercel del rediseño: [tomassoco96/xp-repuestos](https://github.com/tomassoco96/xp-repuestos) — wireframe visual de referencia.
- Web preview Vercel: https://xp-repuestos.vercel.app
- WordPress MCP oficial: https://github.com/wordpress/mcp-adapter
- Automattic remote MCP: https://github.com/Automattic/mcp-wordpress-remote

---

**Autor**: TomerClicks · Desarrollado para xprepuestos.com.ar

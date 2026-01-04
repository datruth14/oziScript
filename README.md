# 🚀 oziScript Framework

**oziScript** is a modern, component-based PHP framework designed for building high-performance PWAs and Hybrid Apps with a **"No-Script" philosophy**. Build beautiful, functional experiences by simply composing reusable widgets—no deep PHP or CSS knowledge required.

---

## ✨ Key Features

- 🧩 **Function-Based Components**: Build your UI using simple PHP functions (Widgets).
- 🌐 **Native PWA Support**: Out-of-the-box service workers, manifest, and offline support.
- 🛣️ **Pretty URLs**: Clean, path-based routing (e.g., `/about/id/1`) built-in.
- 📦 **Remote Ecosystem**: Install widgets and plugins directly from the [oziDependencies](https://github.com/datruth14/oziDependencies) repository.
- 🛠️ **Powerful CLI**: Manage your entire app life cycle with the `ozi` command-line tool.
- 🎨 **Premium UI Kit**: Standardized, high-quality widgets with animations (Cyberpunk, Glassmorphism, Aurora).

---

## 📥 Installation

### 1. Requirements
- PHP 8.1+
- Apache with `mod_rewrite` enabled (XAMPP/cPanel)

### 2. Setup
Download and install oziScript via Composer:
```bash
composer create-project ozi/ozi_script projectName
cd projectName
```

### 3. Serve Locally
Use the built-in development server:
```bash
php ozi serve
```
Your app is now live at `http://localhost:3000`!

---

## 🛠 Command Line Tool (ozi CLI)

The `ozi` tool is your companion for building apps.

### Manage Screens
- **Create**: `php ozi screen <name> create`
- **Delete**: `php ozi screen <name> delete`

### Manage Widgets
- **List Available**: `php ozi widget list` (Fetches from oziDependencies)
- **Search**: `php ozi widget search <query>`
- **Install**: `php ozi widget <name> install`
- **Remove**: `php ozi widget <name> remove`

### Manage Plugins
- **Install**: `php ozi plugin <name> install` (e.g., `php ozi plugin mailer install`)
- **Remove**: `php ozi plugin <name> remove`

---

## 📐 Building Your App

### 1. Functional Navigation
Use the `linkTo()` helper to generate clean, pretty URLs:
```php
<a href="<?= linkTo("about&&productId=123"); ?>">View Product</a>
<!-- Generates: /about/productId/123 -->
```

### 2. Composition (No-Code Style)
In oziScript, you don't write complex HTML. You call widgets like Lego blocks in your `components/` files:

```php
// components/index.php
ozi_nav_simple("My Brand");

heroSection11(
    title: "The Future is Now",
    subTitle: "Composed entirely using Ozi Widgets.",
    btnText: "Join Now"
);

// 3. Using a Plugin (e.g., mailer)
// OziMailer("contact@example.com", "Subject");

ozi_footer_clean();
```

### 3. Accessing Data
Pretty URL parameters are automatically parsed into the `$_GET` superglobal:
```php
// URL: /product/id/99
echo $_GET['id']; // Outputs: 99
```

---

## 📂 Project Structure

- `assets/`: Media, icons, and local styles.
- `components/`: Pure logic/UI functions for your pages.
- `screens/`: Route entry points (automatically handled).
- `system_files/`: Core libraries, plugins, and installed widgets.
- `view.php`: Central registry for your screen functions.
- `system_config.php`: Global configuration and auto-loading.

---

## 🌟 Vision
oziScript aims to be the go-to framework for designers and creators. By abstracting complexity into a searchable marketplace of widgets and plugins, we empower anyone to build "App-Store ready" applications using just a few lines of functional code.

---

## 📝 License
MIT License. Free for personal and commercial use.

#OziScript #PHP #PWA #NoCode #WebDevelopment #HybridApps

---

## 🎥 Tutorials & Learning
Watch our video tutorials to master oziScript:
- [Ozi Script YouTube Channel](https://www.youtube.com/watch?v=9T42YqABTM0)

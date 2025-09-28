

🚀 **Ozi Script Documentation**  


Ozi Script is an easy-to-use web development framework designed to simplify both front-end and back-end web development. Built on modern development principles, it adopts a **component-based architecture**, where every element is a reusable component. Ozi Script ensures that your projects follow DRY (Don't Repeat Yourself) and KISS (Keep It Simple, Stupid) principles for efficient coding.

---

## Key Features  
- 🧩 **Component-Based Architecture**:  
   Create reusable, modular components to improve scalability and maintainability of your app.

- 🌐 **Progressive Web App (PWA) Capabilities**:  
   Ozi Script apps are installable, work offline, and can access native device features like push notifications, contacts, and file storage.

- ⚙️ **Extensibility with Widgets and Plugins**:  
   Easily enhance your app with pre-built widgets and plugins that offer powerful additional functionality.

- ⚡ **Easy Setup and Development**:  
   Ozi Script streamlines your workflow with a simple installation process and intuitive structure, helping you get started quickly.

---

## Installation  

### Prerequisites  
Ensure you have the following installed on your machine:  
- 💻 **XAMPP** (or any PHP server)  
- 📦 **Composer**

### Step-by-Step Installation  
1. ✅ Verify PHP and Composer installation:  
```bash  
php --version  
composer --version  
```  
Both commands should return the installed versions.

2. 📥 Install Ozi Script:  
```bash  
composer create-project ozi/ozi_script projectName  
```  
Replace `projectName` with your desired project name.

3. 📂 Navigate to the project folder:  
```bash  
cd projectName  
```

4. 🚀 Start the development server:  
```bash  
php ozi serve  
```  
By default, the server runs on **port 3000**. To use a custom port, specify it like this:  
```bash  
php ozi serve 5000  
```

5. 🌍 Open the app in your browser:  
- For default: `http://localhost:3000`  
- For custom: `http://localhost:5000`

**Congratulations!** 🎉 Ozi Script is successfully installed.

---

## Folder Structure  
Here's an overview of the default folder structure for Ozi Script (v0.5):

```
projectName/
├── Assets/
├── Components/
│   ├── Comp_files/
│   └── Index.php
├── Cores/
│   ├── Cores_files/
│   └── HandleLogin.php
├── Screens/
├── System_files/
│   ├── ozi_command/
│   ├── Cssd.php
│   ├── Jsd.php
│   ├── Router.php
│   ├── Plugins/
│   └── Widgets/
├── .htaccess
├── Call_bk_request.php
├── Create_bk_request.php
├── Index.php
├── Manifest.json
├── Offline.html
├── Ozi
├── sw.js
├── System_config.php
├── Ui_config.php
└── View.php
```

### Detailed Folder Overview  

#### **1. `Assets/`**  
This folder stores all your project’s media and styling files.  
- 📸 **Media/**: Store images and icons.  
- 🎨 **Styles/**: Default styles and scripts (`default_css.css`, `default_js.js`).

#### **2. `Components/`**  
Houses all your app’s screens (pages) and reusable components.  
- 🔧 **Comp_files/**: Contains small reusable components like `header.php` and `footer.php`.

#### **3. `Cores/`**  
All back-end logic resides here.  
- 🖥️ **Cores_files/**: Auxiliary scripts for backend processes (e.g., database connections).

#### **4. `Screens/`**  
Contains app route definitions (e.g., home, about, etc.).

#### **5. `System_files/`**  
Stores dependencies and essential files for your project.  
- 🛠️ **`ozi_command/`**: Powers Ozi CLI commands.  
- 🎨 **`Cssd.php`**: Handles CSS dependencies (uses Bootstrap by default).  
- 💻 **`Jsd.php`**: Manages JavaScript dependencies (default: Bootstrap.js).  
- 🌐 **`Router.php`**: Implements routing (supports SPA and MPA).  
- 🔌 **`Plugins/`**: Optional third-party plugins.  
- 🧩 **`Widgets/`**: Optional reusable UI components.

#### **6. Others**  
- 📱 **`Manifest.json`**: Configures PWA features.  
- 🌍 **`sw.js`**: Service worker for offline functionality.  
- ⚙️ **`offline.html`**: Offline fallback page.  
- 🛠️ **`System_config.php`**: Manages project-wide settings.  
- 🧑‍💻 **`Ui_config.php`**: Central template for client-side dependencies.

---

## Widgets  

### What Are Widgets?  
Widgets are reusable UI components that come pre-styled and pre-configured. Examples include Floating Action Buttons (FAB) and navbars.

### Installing Widgets  
Run the following command to install a widget:  
```bash  
php ozi widget <widget_name> install  
```  
Example (to install FAB):  
```bash  
php ozi widget fab install  
```

To remove a widget:  
```bash  
php ozi widget <widget_name> remove  
```

### Using Widgets  
Once installed, call the widget in your component files.  

#### Example: Calling FAB Widget  
```php  
<?php  
fab(); // Default FAB style  
?>  

<?php  
fab("param1", "param2", "param3", "param4"); // Custom FAB  
?>  
```

---

## Plugins  

### What Are Plugins?  
Plugins add advanced functionalities to your project, such as API integrations or complex processing tools.

### Installing Plugins  
Run the following command to install a plugin:  
```bash  
php ozi plugin <plugin_name> install  
```

### Using Plugins  
After installation, include the plugin in your desired components.

#### Example: Using a Plugin  
```php  
<?php  
PluginName("param1", "param2", "param3", "param4");  
?>  
```

---

## Additional Notes  
- 📚 Every widget and plugin includes documentation and usage examples.  
- 🎥 Video tutorials are available on the [Ozi Script YouTube Channel](#).

**Start building powerful web apps effortlessly with Ozi Script!** 🚀

#OziScript #WebDevelopment #PWA #PHP #OpenSource #TechTools #WebDesign #AppDev #Widgets #Plugins


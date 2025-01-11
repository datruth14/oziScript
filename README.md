🚀 **Ozi Script Documentation** 🚀  
**Version**: 0.5  

Ozi Script is an easy-to-use web development framework that simplifies both front-end and back-end development. It follows modern principles with a **component-based architecture**, ensuring reusable components for efficient and scalable projects. By adopting the **DRY (Don't Repeat Yourself)** and **KISS (Keep It Simple, Stupid)** principles, Ozi Script helps you write clean, maintainable code.

### **Key Features**
✨ **Component-Based Architecture**: Build reusable, modular components for better scalability and maintainability.  
✨ **Progressive Web App (PWA) Capabilities**: Installable apps, offline support, and access to native device features like push notifications.  
✨ **Extensibility with Widgets and Plugins**: Easily enhance your app with pre-built widgets and plugins.  
✨ **Easy Setup and Development**: Streamlined installation and a simple, intuitive structure.

### **Installation Guide**
**Prerequisites**:  
• XAMPP (or any PHP server)  
• Composer  

**Steps**:  
1. Verify PHP and Composer installation:
   ```bash
   php --version
   composer --version
   ```
2. Install Ozi Script:
   ```bash
   composer create-project ozi/ozi_script projectName
   ```
3. Navigate to your project folder:
   ```bash
   cd projectName
   ```
4. Start the development server:
   ```bash
   php ozi serve
   ```
   (For custom port: `php ozi serve 5000`)

5. Open in browser:  
   Default: `http://localhost:3000`  
   Custom: `http://localhost:5000`

🎉 Ozi Script is now installed and ready to go!

### **Folder Structure Overview**  
Explore the default folder structure:
```plaintext
projectName/
├── Assets/
├── Components/
├── Cores/
├── Screens/
├── System_files/
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

**Key Folders**:  
- **Assets/**: Media & styling files  
- **Components/**: Screens and reusable components  
- **Cores/**: Back-end logic  
- **System_files/**: Dependencies and essential files  
- **Manifest.json & sw.js**: PWA configuration & offline support

### **Widgets**  
**What are Widgets?**  
Reusable UI components, pre-styled and pre-configured. Examples: Floating Action Buttons (FAB) and navbars.

**Installing Widgets**:
```bash
php ozi widget <widget_name> install
```
**Example**: To install FAB:
```bash
php ozi widget fab install
```

**Using Widgets**:
```php
<?php fab(); ?>  // Default FAB style
<?php fab("param1", "param2"); ?>  // Custom FAB style
```

### **Plugins**  
**What are Plugins?**  
Advanced functionalities like API integrations or tools for complex processing.

**Installing Plugins**:
```bash
php ozi plugin <plugin_name> install
```

**Using Plugins**:
```php
<?php PluginName("param1", "param2"); ?>
```

**Additional Notes**:  
🎥 Video tutorials available on the Ozi Script YouTube Channel!  
💡 Each widget and plugin comes with documentation and usage examples.

Start building powerful web apps effortlessly with **Ozi Script**! 💻✨

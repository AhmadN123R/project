// ===== THEME MANAGEMENT SYSTEM =====

class ThemeManager {
    constructor() {
        this.init();
    }

    init() {
        // Get saved theme or default to light
        this.currentTheme = localStorage.getItem('theme') || 'light';
        
        // Apply saved theme on page load
        this.applyTheme(this.currentTheme);
        
        // Create theme toggle button
        this.createThemeToggle();
        
        // Listen for system theme changes
        this.watchSystemTheme();
        
        // Update settings page toggle if exists
        this.updateSettingsToggle();
    }

    applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        this.currentTheme = theme;
        
        // Save to localStorage
        localStorage.setItem('theme', theme);
        
        // Update all theme-dependent elements
        this.updateThemeElements();
        
        // Dispatch custom event for other components
        window.dispatchEvent(new CustomEvent('themeChanged', { 
            detail: { theme: theme } 
        }));
    }

    toggleTheme() {
        const newTheme = this.currentTheme === 'light' ? 'dark' : 'light';
        this.applyTheme(newTheme);
        
        // Animate the toggle
        this.animateToggle();
        
        // Mark as manually set
        localStorage.setItem('theme-manual', 'true');
    }

    createThemeToggle() {
        // Check if toggle already exists
        if (document.getElementById('themeToggle')) return;
        
        const toggle = document.createElement('button');
        toggle.id = 'themeToggle';
        toggle.className = 'theme-toggle';
        toggle.setAttribute('aria-label', 'Toggle theme');
        toggle.setAttribute('title', 'Toggle Dark/Light Theme');
        
        this.updateToggleIcon(toggle);
        
        toggle.addEventListener('click', () => {
            this.toggleTheme();
        });
        
        // Add to body
        document.body.appendChild(toggle);
    }

    updateToggleIcon(toggle) {
        const isDark = this.currentTheme === 'dark';
        toggle.innerHTML = `<i class="bi bi-${isDark ? 'sun' : 'moon'}-fill"></i>`;
        
        // Update title
        const title = isDark ? 'Switch to Light Mode' : 'Switch to Dark Mode';
        toggle.setAttribute('title', title);
    }

    animateToggle() {
        const toggle = document.getElementById('themeToggle');
        if (toggle) {
            toggle.style.transform = 'scale(0.8) rotate(180deg)';
            
            setTimeout(() => {
                this.updateToggleIcon(toggle);
                toggle.style.transform = 'scale(1) rotate(0deg)';
            }, 150);
        }
    }

    updateThemeElements() {
        // Update toggle button
        const toggle = document.getElementById('themeToggle');
        if (toggle) {
            this.updateToggleIcon(toggle);
        }
        
        // Update settings page dark mode toggle
        this.updateSettingsToggle();
        
        // Update meta theme color
        this.updateMetaThemeColor();
    }

    updateSettingsToggle() {
        const settingsToggle = document.getElementById('darkModeToggle');
        if (settingsToggle) {
            settingsToggle.checked = this.currentTheme === 'dark';
        }
    }

    updateMetaThemeColor() {
        // Update meta theme color for mobile browsers
        let metaThemeColor = document.querySelector('meta[name="theme-color"]');
        if (!metaThemeColor) {
            metaThemeColor = document.createElement('meta');
            metaThemeColor.setAttribute('name', 'theme-color');
            document.head.appendChild(metaThemeColor);
        }
        
        const color = this.currentTheme === 'dark' ? '#1a1d23' : '#ffffff';
        metaThemeColor.setAttribute('content', color);
    }

    watchSystemTheme() {
        // Listen for system theme changes
        if (window.matchMedia) {
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            
            mediaQuery.addListener((e) => {
                // Only auto-switch if user hasn't manually set a preference
                if (!localStorage.getItem('theme-manual')) {
                    const systemTheme = e.matches ? 'dark' : 'light';
                    this.applyTheme(systemTheme);
                }
            });
        }
    }

    setManualTheme(theme) {
        // Mark as manually set
        localStorage.setItem('theme-manual', 'true');
        this.applyTheme(theme);
    }

    resetToSystemTheme() {
        localStorage.removeItem('theme-manual');
        localStorage.removeItem('theme');
        
        // Detect system preference
        const systemTheme = window.matchMedia && 
            window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        
        this.applyTheme(systemTheme);
    }
}

// ===== SETTINGS PAGE INTEGRATION =====
function initializeSettingsTheme() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    
    if (darkModeToggle) {
        // Set initial state
        darkModeToggle.checked = window.themeManager.currentTheme === 'dark';
        
        // Handle toggle
        darkModeToggle.addEventListener('change', function() {
            const newTheme = this.checked ? 'dark' : 'light';
            window.themeManager.setManualTheme(newTheme);
            
            // Show feedback
            showThemeChangeNotification(newTheme);
        });
    }
}

function showThemeChangeNotification(theme) {
    // Create notification
    const notification = document.createElement('div');
    notification.className = 'alert alert-success position-fixed';
    notification.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 1060;
        min-width: 250px;
        animation: slideInRight 0.3s ease-out;
        border-radius: 10px;
        box-shadow: var(--shadow-lg);
    `;
    
    const themeName = theme === 'dark' ? 'Gelap' : 'Terang';
    notification.innerHTML = `
        <i class="bi bi-check-circle me-2"></i>
        Mode ${themeName} telah diaktifkan!
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-in';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// ===== LOGOUT MODAL THEME FIXES =====
function updateLogoutModalTheme() {
    const logoutModal = document.getElementById('logoutModal');
    if (!logoutModal) return;
    
    const theme = window.themeManager.currentTheme;
    
    // Update modal backdrop
    const backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) {
        backdrop.style.backgroundColor = theme === 'dark' ? 
            'rgba(0, 0, 0, 0.8)' : 'rgba(0, 0, 0, 0.5)';
    }
}

// ===== UTILITY FUNCTIONS =====
function addThemeAnimations() {
    // Add CSS animations if not already added
    if (document.getElementById('theme-animations')) return;
    
    const style = document.createElement('style');
    style.id = 'theme-animations';
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        
        .theme-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    `;
    
    document.head.appendChild(style);
}

// ===== KEYBOARD SHORTCUTS =====
function initializeKeyboardShortcuts() {
    document.addEventListener('keydown', function(e) {
        // Ctrl + Shift + T to toggle theme
        if (e.ctrlKey && e.shiftKey && e.key === 'T') {
            e.preventDefault();
            window.themeManager.toggleTheme();
            
            // Show shortcut notification
            showShortcutNotification();
        }
    });
}

function showShortcutNotification() {
    const notification = document.createElement('div');
    notification.className = 'alert alert-info position-fixed';
    notification.style.cssText = `
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1060;
        min-width: 200px;
        text-align: center;
        animation: fadeInDown 0.3s ease-out;
        border-radius: 10px;
        box-shadow: var(--shadow-lg);
    `;
    
    notification.innerHTML = `
        <i class="bi bi-keyboard me-2"></i>
        Tema diubah dengan shortcut!
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'fadeOutUp 0.3s ease-in';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 2000);
}

// ===== AUTO INITIALIZATION =====
document.addEventListener('DOMContentLoaded', function() {
    // Add theme animations
    addThemeAnimations();
    
    // Initialize keyboard shortcuts
    initializeKeyboardShortcuts();
    
    // Add theme transition class to body
    document.body.classList.add('theme-transition');
});

// ===== EXPORT FOR GLOBAL USE =====
window.ThemeManager = ThemeManager;
window.initializeSettingsTheme = initializeSettingsTheme;
window.updateLogoutModalTheme = updateLogoutModalTheme;
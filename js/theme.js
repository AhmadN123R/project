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

// JavaScript untuk Profile Menu dan Notifikasi
// Tambahkan ke file js/theme.js atau di footer.php

// Profile Menu Toggle Function
function toggleProfileMenu() {
    // Cek apakah dropdown sudah ada
    let dropdown = document.querySelector('.profile-dropdown');
    
    if (!dropdown) {
        // Buat dropdown baru
        dropdown = createProfileDropdown();
        document.querySelector('.navbar-right').appendChild(dropdown);
    }
    
    // Toggle visibility
    dropdown.classList.toggle('show');
    
    // Close dropdown saat klik di luar
    document.addEventListener('click', function closeDropdown(e) {
        if (!e.target.closest('.navbar-right')) {
            dropdown.classList.remove('show');
            document.removeEventListener('click', closeDropdown);
        }
    });
}

// Function untuk membuat Profile Dropdown
function createProfileDropdown() {
    const dropdown = document.createElement('div');
    dropdown.className = 'profile-dropdown';
    dropdown.innerHTML = `
        <a href="#" onclick="viewProfile()">
            <i class="bi bi-person me-2"></i>Lihat Profil
        </a>
        <a href="#" onclick="editProfile()">
            <i class="bi bi-pencil me-2"></i>Edit Profil
        </a>
        <a href="index.php?page=settings">
            <i class="bi bi-gear me-2"></i>Pengaturan
        </a>
        <a href="#" onclick="showLogoutModal()">
            <i class="bi bi-box-arrow-right me-2"></i>Logout
        </a>
    `;
    
    // Position dropdown relative to profile image
    dropdown.style.position = 'absolute';
    dropdown.style.top = '100%';
    dropdown.style.right = '0';
    
    return dropdown;
}

// Profile Functions
function viewProfile() {
    alert('Fitur Lihat Profil\n\nNama: Admin User\nEmail: admin@example.com\nLevel: Administrator\nTerakhir Login: ' + new Date().toLocaleString('id-ID'));
    document.querySelector('.profile-dropdown').classList.remove('show');
}

function editProfile() {
    alert('Fitur Edit Profil akan segera hadir!\n\nAnda dapat mengubah:\n• Foto Profil\n• Nama Lengkap\n• Email\n• Password');
    document.querySelector('.profile-dropdown').classList.remove('show');
}

function showLogoutModal() {
    document.querySelector('.profile-dropdown').classList.remove('show');
    const logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
    logoutModal.show();
}

// Enhanced Notification Function
function showNotifications() {
    // Buat notifikasi yang lebih interaktif
    const notifications = [
        {
            id: 1,
            title: 'Update Sistem',
            message: 'Sistem akan di-update pada malam hari',
            time: '2 menit yang lalu',
            type: 'info',
            icon: 'bi-info-circle'
        },
        {
            id: 2,
            title: 'Pesan Baru',
            message: 'Anda mempunyai pesan baru dari admin',
            time: '1 jam yang lalu',
            type: 'success',
            icon: 'bi-envelope'
        },
        {
            id: 3,
            title: 'Laporan Siap',
            message: 'Laporan bulanan telah selesai dibuat',
            time: '3 jam yang lalu',
            type: 'warning',
            icon: 'bi-file-text'
        }
    ];
    
    // Buat modal notifikasi
    showNotificationModal(notifications);
}

function showNotificationModal(notifications) {
    // Hapus modal lama jika ada
    const existingModal = document.getElementById('notificationModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Buat modal baru
    const modal = document.createElement('div');
    modal.id = 'notificationModal';
    modal.className = 'modal fade';
    modal.innerHTML = `
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-bell me-2"></i>Notifikasi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    ${notifications.map(notif => `
                        <div class="notification-item p-3 border-bottom">
                            <div class="d-flex align-items-start">
                                <div class="notification-icon me-3">
                                    <i class="${notif.icon} text-${notif.type === 'info' ? 'primary' : notif.type}"></i>
                                </div>
                                <div class="notification-content flex-grow-1">
                                    <h6 class="mb-1">${notif.title}</h6>
                                    <p class="mb-1 text-muted small">${notif.message}</p>
                                    <small class="text-muted">${notif.time}</small>
                                </div>
                                <div class="notification-actions">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="markAsRead(${notif.id})">
                                        <i class="bi bi-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" onclick="markAllAsRead()">
                        <i class="bi bi-check-all me-2"></i>Tandai Semua Dibaca
                    </button>
                    <button class="btn btn-primary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();
    
    // Hapus modal setelah ditutup
    modal.addEventListener('hidden.bs.modal', () => {
        modal.remove();
    });
}

function markAsRead(id) {
    alert(`Notifikasi ${id} ditandai sebagai telah dibaca`);
    // Update notification count
    updateNotificationCount(-1);
}

function markAllAsRead() {
    alert('Semua notifikasi ditandai sebagai telah dibaca');
    // Reset notification count
    updateNotificationCount(0, true);
}

function updateNotificationCount(change, reset = false) {
    const badge = document.querySelector('.navbar-right .badge');
    if (badge) {
        let currentCount = reset ? 0 : parseInt(badge.textContent) + change;
        if (currentCount <= 0) {
            badge.style.display = 'none';
        } else {
            badge.textContent = currentCount;
            badge.style.display = 'flex';
        }
    }
}

// Initialize pada DOM ready
document.addEventListener('DOMContentLoaded', function() {
    // Update notification button event
    const notifBtn = document.getElementById('notificationBtn');
    if (notifBtn) {
        notifBtn.addEventListener('click', showNotifications);
    }
    
    // Close profile dropdown saat ESC ditekan
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const dropdown = document.querySelector('.profile-dropdown');
            if (dropdown) {
                dropdown.classList.remove('show');
            }
        }
    });
});

// CSS untuk notification modal (tambahkan ke style)
const notificationModalStyle = `
<style>
.notification-item:hover {
    background-color: var(--bg-tertiary);
}

.notification-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--bg-tertiary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.notification-content h6 {
    color: var(--text-primary);
    font-weight: 600;
}

.notification-actions .btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}
</style>
`;

// Inject CSS
if (!document.getElementById('notification-modal-style')) {
    const styleEl = document.createElement('div');
    styleEl.id = 'notification-modal-style';
    styleEl.innerHTML = notificationModalStyle;
    document.head.appendChild(styleEl);
}
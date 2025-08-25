<!-- Footer -->
            <footer class="footer text-center py-3 bg-dark text-light mt-auto">
                © <?php echo date('Y'); ?> 
                <?php echo isset($footer_text) ? $footer_text : 'Belajar PHP Native'; ?> 
                | Dibuat dengan ❤️ dan PHP
                <?php if (isset($show_version) && $show_version): ?>
                    | v<?php echo isset($app_version) ? $app_version : '1.0.0'; ?>
                <?php endif; ?>
            </footer>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Theme Management Script -->
<script src="js/theme.js"></script>

<!-- Additional JavaScript if needed -->
<?php if (isset($additional_js)): ?>
    <?php foreach ($additional_js as $js): ?>
        <script src="<?php echo $js; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<script>
// Initialize theme system
document.addEventListener('DOMContentLoaded', function() {
    // Initialize theme manager
    window.themeManager = new ThemeManager();
    
    // Initialize settings theme integration
    if (document.getElementById('darkModeToggle')) {
        initializeSettingsTheme();
    }
    
    // Listen for theme changes to update logout modal
    window.addEventListener('themeChanged', updateLogoutModalTheme);
});

// Auto-hide sidebar pada mobile setelah klik menu
document.querySelectorAll('.menu a').forEach(link => {
    link.addEventListener('click', function() {
        if (window.innerWidth <= 768) {
            const sidebar = document.getElementById('sidebar');
            const bsCollapse = new bootstrap.Collapse(sidebar);
            bsCollapse.hide();
        }
    });
});

// Toggle sidebar dengan smooth animation
document.querySelector('[data-bs-target="#sidebar"]')?.addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const isShown = sidebar.classList.contains('show');
    
    if (!isShown) {
        sidebar.style.animation = 'slideInLeft 0.3s ease-out';
    } else {
        sidebar.style.animation = 'slideOutLeft 0.3s ease-in';
    }
});

// Logout function with theme awareness
function handleLogout(button) {
    // Show loading state
    button.classList.add('btn-loading');
    button.disabled = true;
    
    // Simulate logout process
    setTimeout(() => {
        // Hide logout modal
        const logoutModal = bootstrap.Modal.getInstance(document.getElementById('logoutModal'));
        logoutModal.hide();
        
        // Show success modal
        setTimeout(() => {
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            
            // Redirect to logout.php after showing success
            setTimeout(() => {
                window.location.href = 'logout.php';
            }, 2000);
        }, 300);
        
    }, 1500);
}

// Notification button functionality (if enabled)
<?php if (isset($show_notifications) && $show_notifications): ?>
document.getElementById('notificationBtn')?.addEventListener('click', function() {
    // Add your notification logic here
    alert('Notifikasi belum siap broo !!!');
});
<?php endif; ?>

// Additional page-specific JavaScript
<?php if (isset($page_script)): ?>
    <?php echo $page_script; ?>
<?php endif; ?>
</script>

<style>
/* Additional animations for sidebar */
@keyframes slideInLeft {
    from {
        transform: translateX(-100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutLeft {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(-100%);
        opacity: 0;
    }
}

/* Notification badge positioning */
.position-relative .badge {
    font-size: 0.7rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #sidebar {
        position: absolute;
        z-index: 1050;
        height: calc(100vh - 60px);
        box-shadow: var(--shadow-md);
    }
    
    .content {
        width: 100%;
    }
}

/* Additional page-specific CSS */
<?php if (isset($page_style)): ?>
    <?php echo $page_style; ?>
<?php endif; ?>
</style>

</body>
</html>
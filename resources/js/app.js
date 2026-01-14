/**
 * CCS Research Title Repository - Main JavaScript File
 * Handles sidebar toggle, alerts, confirmations, and other UI interactions
 */

// ============================================
// Sidebar Toggle Functions
// ============================================
// resources/js/app.js
console.log('App.js loaded!');

/**
 * Toggle sidebar visibility on mobile
 */
function toggleSidebar() {
    try {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        if (!sidebar || !overlay) {
            console.error('❌ Sidebar or overlay elements not found');
            return false;
        }

        // Check current state
        const isHidden = sidebar.classList.contains('-translate-x-full');
        
        if (isHidden) {
            // Open sidebar
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            if (menuIcon) menuIcon.classList.add('hidden');
            if (closeIcon) closeIcon.classList.remove('hidden');
            console.log('✓ Sidebar opened');
        } else {
            // Close sidebar
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            if (menuIcon) menuIcon.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
            console.log('✓ Sidebar closed');
        }
        return true;
    } catch (error) {
        console.error('❌ Error toggling sidebar:', error);
        return false;
    }
}

/**
 * Close sidebar on mobile after clicking a link
 */
function closeSidebarOnMobile() {
    try {
        if (window.innerWidth < 1024) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            if (sidebar && overlay) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                if (menuIcon) menuIcon.classList.remove('hidden');
                if (closeIcon) closeIcon.classList.add('hidden');
                console.log('✓ Sidebar closed on mobile');
            }
        }
    } catch (error) {
        console.error('❌ Error closing sidebar:', error);
    }
}

/**
 * Initialize sidebar event listeners
 */
function initSidebar() {
    try {
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const sidebarLinks = document.querySelectorAll('#sidebar a');

        console.log('📌 Initializing sidebar...');
        console.log('Toggle button:', sidebarToggle ? '✓ Found' : '❌ Not found');
        console.log('Overlay:', sidebarOverlay ? '✓ Found' : '❌ Not found');
        console.log('Links found:', sidebarLinks.length);

        // Toggle button click event
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('📌 Toggle button clicked');
                toggleSidebar();
            });
        }

        // Overlay click event to close
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('📌 Overlay clicked');
                closeSidebarOnMobile();
            });
        }

        // Close sidebar when clicking links
        sidebarLinks.forEach((link, index) => {
            link.addEventListener('click', function() {
                console.log('📌 Link clicked:', this.textContent);
                closeSidebarOnMobile();
            });
        });

        // Handle window resize
        window.addEventListener('resize', debounce(function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            if (window.innerWidth >= 1024) {
                // Reset to desktop view
                if (sidebar) sidebar.classList.remove('-translate-x-full');
                if (overlay) overlay.classList.add('hidden');
                if (menuIcon) menuIcon.classList.remove('hidden');
                if (closeIcon) closeIcon.classList.add('hidden');
                console.log('📌 Resized to desktop view');
            }
        }, 250));

        console.log('✓ Sidebar initialized successfully');
    } catch (error) {
        console.error('❌ Error initializing sidebar:', error);
    }
}

/**
 * Debounce function for resize events
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// ============================================
// Alert Functions
// ============================================

/**
 * Dismiss an alert by ID
 * @param {string} id - The alert element ID
 */
function dismissAlert(id) {
    try {
        const alert = document.getElementById(id);
        if (!alert) {
            console.warn('⚠️ Alert element not found:', id);
            return;
        }

        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        alert.style.transition = 'all 0.3s ease-in-out';

        setTimeout(() => {
            try {
                if (alert && alert.parentNode) {
                    alert.remove();
                    console.log('✓ Alert dismissed:', id);
                }
            } catch (e) {
                console.error('❌ Error removing alert:', e);
            }
        }, 300);
    } catch (error) {
        console.error('❌ Error dismissing alert:', error);
    }
}

/**
 * Auto-dismiss an alert after a delay
 * @param {string} id - The alert element ID
 * @param {number} delay - Delay in milliseconds (default: 5000)
 */
function autoDismissAlert(id, delay = 5000) {
    setTimeout(() => {
        dismissAlert(id);
    }, delay);
}

/**
 * Initialize auto-dismissing alerts
 */
function initAlerts() {
    try {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');
        const errorsAlert = document.getElementById('errors-alert');

        console.log('📌 Initializing alerts...');
        console.log('Success alert:', successAlert ? '✓ Found' : '❌ Not found');
        console.log('Error alert:', errorAlert ? '✓ Found' : '❌ Not found');
        console.log('Errors alert:', errorsAlert ? '✓ Found' : '❌ Not found');

        // Auto-dismiss success alert
        if (successAlert) {
            autoDismissAlert('success-alert', 5000);
        }

        // Add close button listeners to all alerts
        [successAlert, errorAlert, errorsAlert].forEach(alert => {
            if (alert) {
                const closeBtn = alert.querySelector('button');
                if (closeBtn) {
                    closeBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        dismissAlert(alert.id);
                    });
                }
            }
        });

        console.log('✓ Alerts initialized successfully');
    } catch (error) {
        console.error('❌ Error initializing alerts:', error);
    }
}

// ============================================
// Confirmation Functions
// ============================================

/**
 * Confirm before deleting an item
 * @param {HTMLFormElement} form - The form to submit
 */
function confirmDelete(form) {
    if (confirm('⚠️ Are you sure you want to delete this? This action cannot be undone.')) {
        form.submit();
    }
}

/**
 * Confirm before restoring an item
 * @param {HTMLFormElement} form - The form to submit
 */
function confirmRestore(form) {
    if (confirm('♻️ Are you sure you want to restore this research title?')) {
        if (form && form.method) {
            form.submit();
        } else {
            console.error('❌ Form not found or invalid');
        }
    }
}

/**
 * Confirm before permanently deleting an item
 * @param {HTMLFormElement} form - The form to submit
 */
function confirmForceDelete(form) {
    if (confirm('🔥 Are you sure you want to PERMANENTLY delete this? This action cannot be undone.')) {
        form.submit();
    }
}

// ============================================
// Photo Preview Function
// ============================================

/**
 * Preview photo before upload
 * @param {Event} event - The file input change event
 */
function previewPhoto(event) {
    try {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');

        if (!preview) {
            console.warn('⚠️ Preview element not found');
            return;
        }

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-20 h-20 rounded-lg object-cover">`;
                console.log('✓ Photo preview loaded');
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    } catch (error) {
        console.error('❌ Error previewing photo:', error);
    }
}

// ============================================
// Initialize on DOM Load
// ============================================

document.addEventListener('DOMContentLoaded', () => {
    console.log('🚀 DOM Content Loaded - Starting initialization...');

    // Initialize sidebar
    initSidebar();

    // Initialize alerts
    initAlerts();

    // Log initialization complete
    console.log('✓ CCS Research Title Repository - All modules initialized successfully');
    console.log('---');
});

// ============================================
// Debug Helper
// ============================================

/**
 * Debug helper to check if elements exist
 */
window.debugApp = function() {
    console.log('=== CCS Research Title Repository - Debug Info ===');
    console.log('Sidebar:', document.getElementById('sidebar') ? '✓' : '❌');
    console.log('Sidebar Toggle:', document.getElementById('sidebar-toggle') ? '✓' : '❌');
    console.log('Overlay:', document.getElementById('sidebar-overlay') ? '✓' : '❌');
    console.log('Menu Icon:', document.getElementById('menu-icon') ? '✓' : '❌');
    console.log('Close Icon:', document.getElementById('close-icon') ? '✓' : '❌');
    console.log('Sidebar Links:', document.querySelectorAll('#sidebar a').length);
    console.log('Viewport Width:', window.innerWidth);
    console.log('Is Mobile:', window.innerWidth < 1024 ? 'Yes' : 'No');
    console.log('========================================');
};

// Make debug function globally accessible
if (typeof window !== 'undefined') {
    console.log('💡 Tip: Type debugApp() in console to check initialization status');
}

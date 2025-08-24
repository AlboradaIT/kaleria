import './bootstrap';

document.addEventListener("alpine:init", () => { 
    Alpine.store('sidebar', { 
        open: false,  // Mobile sidebar closed by default
        expanded: false,  // Desktop sidebar collapsed by default
        userSet: false,
        open: false,  // Mobile sidebar closed by default
        toggle() {
            this.open = !this.open;
        }
    });
}); 
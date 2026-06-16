/**
 * @param {string} message - The text to display
 * @param {'success' | 'error' | 'info' | 'warning'} type - Toast theme
 * @param {number} duration - Time in ms before auto-hide
 * @returns {Promise<void>} Resolves when the toast is fully removed
 */
export async function showToast(message, type = 'success', duration = 4000, placement = 'top-center') {
    return new Promise((resolve) => {
        // 1. Get or Create Container
        let container = document.getElementById('toast-wrapper');
        if (!container) {

            container = document.createElement('div');
            container.id = 'toast-wrapper';

            if (placement === 'bottom-right')
                placement = 'bottom-4 right-4';
            else if (placement === 'bottom-left')
                placement = 'bottom-4 left-4';
            else if (placement === 'top-right')
                placement = 'top-4 right-4';
            else if (placement === 'top-left')
                placement = 'top-4 left-4';
            else {
                placement = 'top-4 left-1/2 transform -translate-x-1/2';
            }

            container.className = `fixed ${placement} z-[9999] flex flex-col gap-3 w-full max-w-xs pointer-events-none`;

            document.body.appendChild(container);
        }

        const icons = {
            success: '<svg width="24px" height="24px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.9120000000000001"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12.9L7.14286 16.5L15 7.5" stroke="#22c55e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M20 7.5625L11.4283 16.5625L11 16" stroke="#22c55e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',
            error: '<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
            info: '<svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"></path></svg>',
            warning: '<svg fill="#eab308" width="24px" height="24px" viewBox="-5.5 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>warning</title> <path d="M10.16 25.92c-2.6 0-8.72-0.24-9.88-2.24-1.28-2.28 2.040-8.24 3.080-10.040 1.040-1.76 4.64-7.56 7.12-7.56 2.8 0 7.24 7.48 8.56 10.12 1.92 3.84 2.48 6.4 1.56 7.6-1.52 2.040-8.96 2.12-10.44 2.12zM10.48 7.72c-0.72 0-3.080 2.36-5.64 6.76-2.76 4.68-3.48 7.72-3.080 8.4 0.32 0.56 3.2 1.4 8.4 1.4 5.44 0 8.64-0.88 9.080-1.48 0.28-0.36 0.040-2.28-1.72-5.84-2.64-5.28-6.12-9.24-7.040-9.24zM10.52 19.2c-0.48 0-0.84-0.36-0.84-0.84v-6.36c0-0.48 0.36-0.84 0.84-0.84s0.84 0.36 0.84 0.84v6.32c0 0.48-0.4 0.88-0.84 0.88zM11.36 21.36c0 0.464-0.376 0.84-0.84 0.84s-0.84-0.376-0.84-0.84c0-0.464 0.376-0.84 0.84-0.84s0.84 0.376 0.84 0.84z"></path> </g></svg>',
            loading: '<svg class="w-5 h-5 text-green-700 animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" stroke-dasharray="15.7 47.1"></circle></svg>',
            default: '<svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"></path></svg>'
        };

        const themes = {
            success: 'bg-green-100/50 border-green-200/50 text-green-700 shadow-green-500/5 dark:bg-green-900/20 dark:border-green-700/25 dark:text-green-300 dark:shadow-green-500/5',
            error: 'bg-red-100/50 border-red-200/30 text-red-700 shadow-red-500/5 dark:bg-red-900/20 dark:border-red-700/20 dark:text-red-300 dark:shadow-red-500/5',
            info: 'bg-purple-100/50 border-purple-200/50 text-purple-700 shadow-purple-500/5 dark:bg-purple-900/20 dark:border-purple-700/25 dark:text-purple-300 dark:shadow-purple-500/5',
            warning: 'bg-yellow-100/50 border-yellow-200/50 text-yellow-700 shadow-yellow-500/5 dark:bg-yellow-900/20 dark:border-yellow-700/25 dark:text-yellow-300 dark:shadow-yellow-500/5',
            loading: 'bg-white/50 border-gray-200/50 text-green-700 shadow-gray-500/5 dark:bg-gray-800/20 dark:border-gray-600/25 dark:text-green-300 dark:shadow-gray-500/5',
            default: 'bg-white/50 border-gray-200/50 text-gray-700 shadow-gray-500/5 dark:bg-gray-800/20 dark:border-gray-600/25 dark:text-gray-300 dark:shadow-gray-500/5'
        };

        const toast = document.createElement('div');
        toast.className = `${themes[type] || themes.default} toast-animate-in pointer-events-auto flex items-center justify-between p-4 rounded-2xl border backdrop-blur-md shadow-lg transition-all duration-300 min-w-[300px]`;

        toast.innerHTML = `
            <div class="flex items-center gap-3">
                <div class="shrink-0">${icons[type] || icons.default}</div>
                <div class="font-medium text-sm">${message}</div>
            </div>
            <button class="p-1 hover:bg-black/5 rounded-full transition-colors">
                <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;

        container.appendChild(toast);

        // --- The Async Magic Part ---
        let isResolved = false;

        const closeToast = () => {
            if (isResolved) return;
            isResolved = true;

            toast.classList.replace('toast-animate-in', 'toast-animate-out');
            // Wait for animation to finish before removing and resolving
            toast.addEventListener('animationend', () => {
                toast.remove();
                resolve(); // Now the 'await' finishes
            }, { once: true });
        };

        // Manual close
        toast.querySelector('button').onclick = closeToast;

        // Auto-hide
        setTimeout(closeToast, duration);
    });
}



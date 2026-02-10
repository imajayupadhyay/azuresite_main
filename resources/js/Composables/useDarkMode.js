import { ref } from 'vue';

const isDark = ref(false);

function applyTheme(dark) {
    if (dark) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

function initDarkMode() {
    const stored = localStorage.getItem('theme');
    isDark.value = stored === 'dark';
    applyTheme(isDark.value);
}

function toggleDarkMode() {
    isDark.value = !isDark.value;
    localStorage.setItem('theme', isDark.value ? 'dark' : 'light');
    applyTheme(isDark.value);
}

// Initialize on first import
if (typeof window !== 'undefined') {
    initDarkMode();
}

export function useDarkMode() {
    return { isDark, toggleDarkMode };
}

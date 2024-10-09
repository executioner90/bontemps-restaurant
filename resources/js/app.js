import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';

window.Alpine = Alpine;

Alpine.start();

// Register components
const componentFiles = import.meta.glob('./components/**/*.vue', {
    eager: true,
    import: 'default',
});

const app = createApp({});

Object.entries(componentFiles).forEach(([path, module]) => {
    const componentName = path
        .replace('./components/', '')
        .replaceAll('/', '')
        .replace('.vue', '');

    console.log(`Registering component: ${componentName}`);
    app.component(componentName, module);
});

// Mount the app
app.mount('#app');

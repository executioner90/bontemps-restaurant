import 'bootstrap';
import Alpine from 'alpinejs';
import Vue from "vue";
import 'bootstrap-vue/dist/bootstrap-vue.css';

window.Alpine = Alpine;

Alpine.start();

// Register mixin plugins automatically
const mixinFiles = import.meta.glob(
    './mixins/*.js',
    {
        eager: true,
    },
);

Object.entries(mixinFiles).forEach((mixinFile) => {
    const [, module] = mixinFile;

    Object.values(module.PLUGINS || {}).forEach((plugin) => Vue.use(plugin));
});

const componentFiles = import.meta.glob(
    './components/**/*.vue',
    {
        eager: true,
        import: 'default',
    },
);

Object.entries(componentFiles).forEach((componentFile) => {
    const [path, module] = componentFile;
    Vue.component(
        path
            .replace('./components/', '')
            .replaceAll('/', '')
            .split('.vue')[0],
        module,
    );
});

// eslint-disable-next-line no-unused-vars
const app = new Vue({
    el: '#app',
});

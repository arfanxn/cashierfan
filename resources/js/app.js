import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

// pinia 
const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

// fontawesome
import { library } from '@fortawesome/fontawesome-svg-core' ; 
import {fas } from   "@fortawesome/free-solid-svg-icons" ; 
library.add(fas);
// import {far } from   "@fortawesome/free-regular-svg-icons" ; 
// library.add(far);
import FontAwesomeIcon from "./Components/FontAwesomeIcon.vue"
import { dom } from "@fortawesome/fontawesome-svg-core";
dom.watch();
// end fontawesome

import { InertiaProgress } from "@inertiajs/progress";

InertiaProgress.init();

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .component("font-awesome-icon", FontAwesomeIcon)
            .mixin({
                methods: {
                    route
                }
            })
            .mount(el);
    },
    title : title => `${title || 'default'} | Cashierfan` , 
});
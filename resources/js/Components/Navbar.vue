<template>
    <nav
        class="fixed flex items-center py-1 lg:py-2.5 w-full bg-white border-b shadow-sm justify-between px-4 lg:px-8 space-x-2  z-40">
        <section>
            <button @click="showSidebar()" @mouseover="showSidebar()">
                <font-awesome-icon icon="fas fa-bars" />
            </button>
        </section>

        <section class="flex items-center">
            <div class="p-1 space-x-1 rounded-full hover:bg-gray-200">
                <font-awesome-icon icon="fas fa-user-circle" class="text-teal-700" size="xl"></font-awesome-icon>
                <span class="hidden font-semibold lg:inline text-gray-900/90">{{ `Muhammad Arfan`.substring(0, 25)
                }}</span>
            </div>

            <button @mouseover="toggleNavbarDropdown(`show`)" @click="toggleNavbarDropdown(`show`)"
                @mouseleave="toggleNavbarDropdown(`hide`)" class="relative w-8 h-8 rounded-full hover:bg-gray-200">
                <font-awesome-icon icon="fas fa-caret-down" size="lg"></font-awesome-icon>

                <div id="navbar-dropdown" class="hidden bg-gray-200 rounded shadow top-8 -left-12 ">
                    <ul class="py-1 text-sm text-left text-black bg-white rounded ">
                        <li>
                            <Link href="#" class="block px-4 py-2 hover:bg-gray-200 ">Profile</Link>
                        </li>
                        <li>
                            <Link href="#" class="block px-4 py-2 hover:bg-gray-200 ">Settings</Link>
                        </li>
                        <li class="border-t-2">
                            <Link href="#" class="block px-4 py-2 hover:bg-gray-200 ">Logout</Link>
                        </li>
                    </ul>
                </div>
            </button>
        </section>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import { useNavigation } from "../Stores/NavigationStore";

export default {
    components: { Link },

    setup() {
        const NavigationStore = useNavigation();

        function toggleNavbarDropdown(action) {
            const nvbrDropdowd = document.querySelector(`#navbar-dropdown`);
            if (nvbrDropdowd.classList.contains(`hidden`) && action == "show") {
                nvbrDropdowd.classList.remove(`hidden`);
                nvbrDropdowd.classList.add("absolute");
            } else if (nvbrDropdowd.classList.contains(`absolute`) && action == "hide") {
                nvbrDropdowd.classList.remove(`absolute`);
                nvbrDropdowd.classList.add("hidden");
            }
        }

        function showSidebar() {
            NavigationStore.$patch({
                showSidebar: Date.now(),
            })
        }

        return { toggleNavbarDropdown, showSidebar };
    }
}
</script>
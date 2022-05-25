<template>
    <nav class="flex  items-center py-2.5 w-full bg-white border-b shadow-sm justify-between px-8 space-x-2">
        <section>
            <h2 class="font-semibold text-gray-900/90">{{ now }}</h2>
        </section>

        <section class="flex items-center">
            <div class="p-1 space-x-1 rounded-full hover:bg-gray-200">
                <font-awesome-icon icon="fas fa-user-circle" class="text-teal-700" size="xl"></font-awesome-icon>
                <span class="font-semibold text-gray-900/90">{{ `Muhammad Arfan`.substring(0, 25) }}</span>
            </div>

            <button @mouseover="toggleNavbarDropdown(`show`)" @mouseleave="toggleNavbarDropdown(`hide`)"
                class="relative w-8 h-8 rounded-full hover:bg-gray-200">
                <font-awesome-icon icon="fas fa-caret-down" size="lg"></font-awesome-icon>

                <div id="navbar-dropdown" class="hidden bg-gray-200 rounded shadow top-8 -left-12 ">
                    <ul class="py-1 text-sm text-left text-black bg-white rounded ">
                        <li>
                            <Link href="#" class="block px-4 py-2 hover:bg-gray-200 ">Profile</Link>
                        </li>
                        <li>
                            <Link href="#" class="block px-4 py-2 hover:bg-gray-200 ">Settings</Link>
                        </li>
                        <li class="border-t">
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
import { ref } from "vue";

export default {
    components: { Link },

    setup() {
        //  live clock and date
        const now = ref(
            new Date().toLocaleDateString('en-US', {
                weekday: "long", year: "numeric", month: "short", day:
                    "numeric", hour: "numeric", minute: "numeric", hour12: false, second: "numeric"
            }));
        setInterval(() => {
            now.value = new Date().toLocaleDateString('en-US', {
                weekday: "long", year: "numeric", month: "short", day:
                    "numeric", hour: "numeric", minute: "numeric", hour12: false, second: "numeric"
            });
        }, 1000);
        //  end of live clock and date



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



        return { toggleNavbarDropdown, now };
    }
}
</script>
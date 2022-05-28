<template>
    <main id="sidebar-bg"
        class="fixed top-0 bottom-0 left-0 right-0 z-50 transition duration-500 ease-in-out transform -translate-x-full bg-black/50"
        @click.self="toggleSidebar('hide')">

        <nav @mouseover="toggleSidebar('show')" @mouseleave="toggleSidebar('hide')" id="sidebar"
            class="w-8/12 h-full text-white lg:w-64 bg-slate-700">
            <header class="flex items-center justify-center bg-indigo-900 py-2.5">
                <h1 class="text-base font-bold text-white lg:text-xl">Arf-Market</h1>
            </header>

            <section class="h-full overflow-y-auto text-white lg:text-md text-semibold">
                <Link href="/" class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50">
                <font-awesome-icon class="fas fa-gauge" />
                <h1>Dashboard</h1>
                </Link>

                <div class="mt-2.5">
                    <h1 class="px-4 py-2.5">
                        Master
                    </h1>

                    <Link href="/"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200">
                    <font-awesome-icon class=" fas fa-bag-shopping" />
                    <h1>Products</h1>
                    </Link>

                    <Link href="/"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200">
                    <font-awesome-icon class=" fas fa-circle-user" />
                    <h1>Customers</h1>
                    </Link>
                </div>


                <div class="mt-2.5">
                    <h1 class="px-4 py-2.5">
                        Transactions
                    </h1>

                    <Link href="/"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200">
                    <font-awesome-icon class="fas fa-cash-register" />
                    <h1>Input Transactions</h1>
                    </Link>
                </div>

                <div class="mt-2.5">
                    <h1 class="px-4 py-2.5">
                        Reports
                    </h1>

                    <Link href="/"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200">
                    <font-awesome-icon class="fas fa-chart-simple" />
                    <h1>Report Sales</h1>
                    </Link>

                    <Link href="/"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200">
                    <font-awesome-icon class="fas fa-chart-line" />
                    <h1>Report Profits</h1>
                    </Link>
                </div>

                <div class="mt-2.5">
                    <h1 class="px-4 py-2.5">
                        User Management
                    </h1>

                    <Link href="/"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200">
                    <font-awesome-icon class="fas fa-shield" />
                    <h1>Roles</h1>
                    </Link>

                    <Link href="/"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200">
                    <font-awesome-icon class="fas fa-key" />
                    <h1>Permissions</h1>
                    </Link>

                    <Link href="/"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200">
                    <font-awesome-icon class="fas fa-users" />
                    <h1>Users</h1>
                    </Link>
                </div>



            </section>
        </nav>

        <div id="content" class="w-full transition-all duration-500 ease-in-out">
            <slot>
            </slot>
        </div>

    </main>

</template>

<script>
import { storeToRefs } from 'pinia'
import { useNavigation } from "../Stores/NavigationStore";
import { watch, toRefs } from 'vue';
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: { Link },

    setup(props) {
        const NavigationStore = useNavigation();

        function toggleSidebar(action) {
            const sidebar = document.querySelector(`#sidebar-bg`);
            if (sidebar.classList.contains(`-translate-x-full`) && action == "show") {
                sidebar.classList.remove(`-translate-x-full`);
            } else if (!sidebar.classList.contains(`-translate-x-full`) && action == "hide") {
                sidebar.classList.add(`-translate-x-full`);
            }
        }

        NavigationStore.$subscribe((mutation, state) => {
            toggleSidebar('show')
        })

        return { toggleSidebar }
    }
}
</script>
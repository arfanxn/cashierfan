<template>
    <main class="flex">

        <nav id="sidebar" @mouseover="toggleSidebar(`show`)" @mouseleave="toggleSidebar(`hide`)"
            class="fixed z-50 w-64 h-full text-white transition duration-500 ease-in-out transform -translate-x-full bg-slate-700 ">
            <header class="flex items-center justify-center bg-indigo-900 py-2.5 ">
                <h1 class="text-xl font-bold text-white">Arf-Market</h1>
            </header>

            <section class="h-full overflow-y-auto text-white text-md text-semibold">
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

            <div @mouseover="toggleSidebar(`show`)"
                class="absolute px-2.5 py-5 my-auto rounded-l-none rounded-r-xl bg-inherit -right-7 top-1/2 -z-10">
                <font-awesome-icon icon="fas fa-bars" />
            </div>
        </nav>

        <div id="sidebar-wrapper" class="h-screen transition-all duration-500 ease-in-out shrink-0 ">
        </div>

        <div class="flex-grow ">
            <slot>
            </slot>
        </div>

    </main>

</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { defineComponent } from "vue";
const components = defineComponent({ Link })


function toggleSidebar(action) {
    const sidebar = document.querySelector(`#sidebar`);
    const sidebarWrap = document.querySelector('#sidebar-wrapper');

    if (sidebar.classList.contains(`-translate-x-full`) && action == "show") {
        sidebar.classList.remove(`-translate-x-full`);
        sidebarWrap.classList.add(`ml-64`);

    } else if (!sidebar.classList.contains(`-translate-x-full`) && action == "hide") {
        sidebar.classList.add(`-translate-x-full`);
        sidebarWrap.classList.remove(`ml-64`);
    }
} 
</script>
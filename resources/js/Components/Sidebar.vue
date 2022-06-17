<template>
    <main
        id="sidebar-bg"
        class="fixed top-0 bottom-0 left-0 right-0 z-50 transition duration-500 ease-in-out transform -translate-x-full bg-black/50"
        @click.self="toggleSidebar('hide')"
    >
        <nav
            @mouseover="toggleSidebar('show')"
            @mouseleave="toggleSidebar('hide')"
            id="sidebar"
            class="w-8/12 h-full text-white lg:w-64 bg-slate-700 md:w-4/12"
        >
            <header
                class="flex items-center justify-center bg-indigo-900 py-2.5"
            >
                <h1 class="text-base font-bold text-white lg:text-xl">
                    Cashierfan
                </h1>
            </header>

            <section
                class="h-full overflow-y-auto text-white lg:text-md text-semibold"
            >
                <Link
                    :href="route(`/`)"
                    class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50"
                    :class="{
                        'bg-slate-800/50': $page.component === 'Dashboard'
                    }"
                >
                    <font-awesome-icon class="fas fa-gauge" />
                    <h1>Dashboard</h1>
                </Link>

                <div
                    v-if="
                        tap(
                            $page.props?.auth?.user?.permissions || [],
                            (permissions) =>
                                permissions.includes(`products.index`) ||
                                permissions.includes(`customers.index`)
                        )
                    "
                    class="mt-2.5"
                >
                    <h1 class="px-4 py-2.5">Master</h1>

                    <Link
                        v-if="
                            $page.props?.auth?.user?.permissions?.includes(
                                `products.index`
                            )
                        "
                        :href="route(`products.index`)"
                        :class="{
                            'bg-slate-800/50':
                                $page.component.startsWith('Product')
                        }"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200"
                    >
                        <font-awesome-icon class="fas fa-bag-shopping" />
                        <h1>Products</h1>
                    </Link>

                    <Link
                        v-if="
                            $page.props?.auth?.user?.permissions?.includes(
                                `customers.index`
                            )
                        "
                        :href="route(`customers.index`)"
                        :class="{
                            'bg-slate-800/50':
                                $page.component.startsWith('Customer')
                        }"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200"
                    >
                        <font-awesome-icon class="fas fa-circle-user" />
                        <h1>Customers</h1>
                    </Link>
                </div>

                <div
                    class="mt-2.5"
                    v-if="
                        $page.props?.auth?.user?.permissions?.includes(
                            `sales.create`
                        )
                    "
                >
                    <h1 class="px-4 py-2.5">Transaction</h1>

                    <Link
                        v-if="
                            $page.props?.auth?.user?.permissions?.includes(
                                `sales.create`
                            )
                        "
                        :href="route(`sales.create`)"
                        :class="{
                            'bg-slate-800/50': $page.component === 'Sale/Create'
                        }"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200"
                    >
                        <font-awesome-icon class="fas fa-cash-register" />
                        <h1>Create Sale</h1>
                    </Link>
                </div>

                <div
                    v-if="
                        tap(
                            $page.props?.auth?.user?.permissions || [],
                            (perm) =>
                                perm.includes(`sales.index`) ||
                                perm.includes(`sales.profit_index`) ||
                                perm.includes(`sales.profits_index`)
                        )
                    "
                    class="mt-2.5"
                >
                    <h1 class="px-4 py-2.5">Reports</h1>

                    <Link
                        v-if="
                            $page.props?.auth?.user?.permissions?.includes(
                                `sales.index`
                            )
                        "
                        :href="route('sales.index')"
                        :class="{
                            'bg-slate-800/50':
                                $page.url.toLowerCase().includes('sales') &&
                                !$page.component.includes('Profit')
                        }"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200"
                    >
                        <font-awesome-icon class="fas fa-chart-simple" />
                        <h1>Sales Report</h1>
                    </Link>

                    <Link
                        v-if="
                            tap(
                                $page.props?.auth?.user?.permissions || [],
                                (perm) =>
                                    perm.includes(`sales.profit_index`) ||
                                    perm.includes(`sales.profits_index`)
                            )
                        "
                        :href="route('sale-profits.index')"
                        :class="{
                            'bg-slate-800/50':
                                $page.component.includes('Profit')
                        }"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200"
                    >
                        <font-awesome-icon class="fas fa-chart-line" />
                        <h1>Profits Report</h1>
                    </Link>
                </div>

                <div
                    v-if="
                        tap(
                            $page.props?.auth?.user?.permissions || [],
                            (permissions) =>
                                permissions.includes(`roles.index`) ||
                                permissions.includes(`permissions.index`) ||
                                permissions.includes(`users.index`)
                        )
                    "
                    class="mt-2.5"
                >
                    <h1 class="px-4 py-2.5">User Management</h1>

                    <Link
                        v-if="
                            $page.props?.auth?.user?.permissions?.includes(
                                `roles.index`
                            )
                        "
                        :href="route('roles.index')"
                        :class="{
                            'bg-slate-800/50':
                                $page.component.startsWith('Role')
                        }"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200"
                    >
                        <font-awesome-icon class="fas fa-shield" />
                        <h1>Roles</h1>
                    </Link>
                    <Link
                        v-if="
                            $page.props?.auth?.user?.permissions?.includes(
                                `permissions.index`
                            )
                        "
                        :href="route('permissions.index')"
                        :class="{
                            'bg-slate-800/50':
                                $page.component.startsWith('Permission')
                        }"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200"
                    >
                        <font-awesome-icon class="fas fa-key" />
                        <h1>Permissions</h1>
                    </Link>

                    <Link
                        v-if="
                            $page.props?.auth?.user?.permissions?.includes(
                                `users.index`
                            )
                        "
                        :href="route('users.index')"
                        :class="{
                            'bg-slate-800/50':
                                $page.component.startsWith('User')
                        }"
                        class="flex px-4 items-center py-2.5 space-x-2 hover:bg-slate-800/50 transition duration-200"
                    >
                        <font-awesome-icon class="fas fa-users" />
                        <h1>Users</h1>
                    </Link>
                </div>
            </section>
        </nav>

        <div
            id="content"
            class="w-full transition-all duration-500 ease-in-out"
        >
            <slot> </slot>
        </div>
    </main>
</template>

<script setup>
import { useNavigation } from '../Stores/NavigationStore';
import { Link } from '@inertiajs/inertia-vue3';
import { tap } from '../Helpers';

const NavigationStore = useNavigation();

function toggleSidebar(action) {
    const sidebar = document.querySelector(`#sidebar-bg`);
    if (sidebar.classList.contains(`-translate-x-full`) && action == 'show') {
        sidebar.classList.remove(`-translate-x-full`);
    } else if (
        !sidebar.classList.contains(`-translate-x-full`) &&
        action == 'hide'
    ) {
        sidebar.classList.add(`-translate-x-full`);
    }
}

NavigationStore.$subscribe((mutation, state) => {
    toggleSidebar('show');
});
</script>

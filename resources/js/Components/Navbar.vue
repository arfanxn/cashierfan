<template>
    <nav
        class="fixed flex items-center py-1 lg:py-2.5 w-full bg-white border-b shadow-sm justify-between px-4 lg:px-8 space-x-2  z-40">
        <section>
            <button @click="showSidebar()" @mouseover="showSidebar()">
                <font-awesome-icon icon="fas fa-bars" />
            </button>
        </section>

        <section class="flex items-center">
            <Link class="flex items-center h-8 p-1 space-x-1 rounded-full hover:bg-gray-200"
                :href="route(`auth.profile.edit`)">
            <div class="w-8 h-8 overflow-hidden rounded-full">
                <ImgOrRandColor class="flex justify-center" :payload="$page.props?.auth?.user?.details?.avatar">
                    <span class="self-center text-sm font-semibold text-white">{{
                            tap($page.props?.auth?.user?.name, name => name.match(/\b(\w)/g).join(``).substring(0
                                , 2).toUpperCase()/**/)
                    }}</span>
                </ImgOrRandColor>
            </div>
            <div class="">
                <span class="hidden font-semibold lg:inline text-slate-700">{{
                        $page.props?.auth?.user?.name?.substring(0,
                            25)
                }}</span>
            </div>
            </Link>

            <button @mouseover="toggleNavbarDropdown(`show`)" @click="toggleNavbarDropdown(`show`)"
                @mouseleave="toggleNavbarDropdown(`hide`)" class="relative w-8 h-8 rounded-full hover:bg-gray-200">
                <font-awesome-icon icon="fas fa-caret-down" size="lg"></font-awesome-icon>

                <div id="navbar-dropdown" class="right-0 hidden bg-gray-200 rounded shadow top-8 ">
                    <ul class="py-1 text-sm text-left text-black bg-white rounded">
                        <li>
                            <Link :href="route(`auth.profile.edit`)" class="block px-4 py-2 hover:bg-gray-200 ">Profile
                            </Link>
                        </li>
                        <li>
                            <Link :href="route(`auth.password.edit`)" class="block px-4 py-2 hover:bg-gray-200 ">
                            Account&nbsp;Settings</Link>
                        </li>
                        <li class="border-t-2">
                            <button @click="logout()" href="#"
                                class="block w-full px-4 py-2 text-left hover:bg-gray-200 ">Logout</button>
                        </li>
                    </ul>
                </div>
            </button>
        </section>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import { useNavigation } from "../Stores/NavigationStore";
import { SwalTailwind } from '../Mixins/Swal';
import ImgOrRandColor from './ImgOrRandColor.vue';
import { tap } from '../Helpers';

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

function logout() {
    SwalTailwind.fire({
        title: "Logout confirmation",
        text: "Are you sure you want to logout ?",
        showCancelButton: true,
        confirmButtonText: "Logout",
        showConfirmButton: true,
    }).then(result => {
        if (result.isConfirmed) {
            Inertia.delete(route("users.logout"));
        }
    })
}

function showSidebar() {
    NavigationStore.$patch({
        showSidebar: Date.now(),
    })
}

</script>
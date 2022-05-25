<template>
    <i :class="classList" class=""></i>
</template>

<script>
export default {
    props: {
        icon: {
            type: String,
            default: "",
            required: false
        },
        size: {
            type: String,
            default: "",
            required: false
        }
    },

    setup({ icon, size }) {
        let classList = String
        if (icon) {
            classList += ` ${icon} `;
        }

        if (size.includes('fa')) {
            classList += ` ${size} `;
        } else if (size) {
            classList += ` fa-${size} `;
        }

        return { classList };
    }
}

</script>
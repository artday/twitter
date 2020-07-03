<template>
    <a href="#" @click.prevent="handleClick"
       class="block py-3 px-4 text-gray-300 hover:bg-gray-800">
        <slot />
    </a>
</template>

<script>
    export default {
        methods: {
            handleClick (e) {
                this.$emit('click', e)
                this.$parent.close()
            }
        }
    }
</script>

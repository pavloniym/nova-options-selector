<template>
    <div class="flex flex-row options-selector__indicator__row" :style="rowStyles">
        <template v-for="(option, k) in options" :key="k">
            <div
                class="mr-1 mb-1 rounded-full options-selector__indicator"
                :class="getClass(option)"
                :title="option.title">
            </div>
        </template>
    </div>
</template>

<script>
    const props = {
        field: {
            type: Object,
            default: null,
        },
        resourceName: {
            type: String,
            default: null,
        },
    };

    export default {
        props,
        computed: {
            /**
             * Get available options
             *
             * @return {array}
             */
            options() {
                return (this?.field?.options || [])
                    .reduce((storage, option) => [...storage, ...(option?.entries || [])], [])
                    .filter(entry => entry);
            },

            /**
             * Get row styles
             *
             * @return {*}
             */
            rowStyles() {
                return {
                    '--maxWidth': this.field?.maxRowWidthOnIndex || null,
                };
            },
        },

        methods: {
            /**
             * Get class
             *
             * @param key
             * @return {*}
             */
            getClass({ key } = {}) {
                return {
                    'bg-red-500': this?.field?.value?.includes(key) === false,
                    'bg-green-500': this?.field?.value?.includes(key) === true,
                };
            },
        },
    };
</script>

<style scoped>
    .options-selector__indicator {
        width: 6px;
        height: 6px;
        min-width: 6px;
        min-height: 6px;
    }

    .options-selector__indicator__row {
        margin: 0 0 0 auto;
        flex-wrap: wrap;
        max-width: var(--maxWidth) !important;
    }
</style>

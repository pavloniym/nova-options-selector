<template>
    <div class="flex flex-col -mx-6 px-6 py-2 mb-4 md:py-0 space-y-2 md:space-y-0">

        <!-- Label -->
        <div v-if="!fieldOptions.hideLabel" class="md:py-3 w-full">
            <h4 class="font-bold md:font-normal">
                <span>{{ fieldOptions.label }}</span>
            </h4>
        </div>

        <!-- Grid -->
        <selector-grid v-bind="{ field }" isReadonly :modelValue="value"/>

    </div>
</template>

<script>

    // Components
    import SelectorGrid from './_components/grid/SelectorGrid';

    const props = {
        field: {
            type: Object,
            default: null,
        },
    };

    export default {
        props,
        components: {
            SelectorGrid,
        },
        computed: {

            /**
             * Get field value
             *
             * @return {array}
             */
            value() {
                return this.field?.value || [];
            },

            /**
             * Get field options
             *
             * @return {*}
             */
            fieldOptions() {
                return {
                    label: this.field?.name,
                    hideLabel: this.field?.hideLabel === true,
                };
            },
        },
    };
</script>

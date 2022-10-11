<template>
    <div class="flex flex-col px-6 md:px-8 mt-2 mb-4 md:mt-0 w-full md:py-5">

        <!-- Label -->
        <div v-if="!fieldOptions.hideLabel" class="md:py-3 w-full">
            <h4 class="font-bold md:font-normal">
                <span>{{ fieldOptions.label }}</span>
            </h4>
        </div>

        <!-- Grid -->
        <selector-grid v-model="value" v-bind="{ field }"/>

    </div>
</template>

<script>

    // Components
    import SelectorGrid from './_components/grid/SelectorGrid';

    // Utils
    import {FormField, HandlesValidationErrors} from 'laravel-nova';

    const props = {
        field: {
            type: Object,
            default: null,
        },
    };

    export default {
        props,
        mixins: [
            FormField,
            HandlesValidationErrors
        ],
        components: {
            SelectorGrid,
        },
        data() {
            return {
                value: [],
            };
        },
        computed: {
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

        methods: {


            /**
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || [];
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.field.attribute, JSON.stringify(this.value || []));
            },
        },
    };
</script>

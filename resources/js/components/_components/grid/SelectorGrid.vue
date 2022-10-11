<template>
    <div class="flex flex-col w-full">

        <!-- Search -->
        <div class="mb-3" v-if="fieldOptions.withSearch">
            <selector-search v-model="search" />
        </div>

        <!-- Groups -->
        <!-- Entries -->
        <div class="grid" :style="gridStyles">
            <template v-for="(option, k) in options" :key="k">
                <selector-group v-bind="option" @update:modelValue="$emit('update:modelValue', $event)" />
            </template>
        </div>

    </div>
</template>

<script>
    // Components
    import SelectorGroup from './_components/group/SelectorGroup';
    import SelectorSearch from './_components/search/SelectorSearch';

    const props = {
        field: {
            type: Object,
            default: null,
        },
        isReadonly: {
            type: Boolean,
            default: false,
        },
        modelValue: {
            type: Array,
            default: null,
        },
    };

    export default {
        props,
        components: {
            SelectorGroup,
            SelectorSearch,
        },
        data() {
            return {
                search: null,
            };
        },
        computed: {
            /**
             * Get options
             *
             * @return {array}
             */
            options() {
                return (this.field?.options || [])
                    .map(option => {
                        return {
                            group: {
                                title: option?.group?.title,
                                isClickable: option?.group?.isClickable !== false,
                            },
                            entries: (option?.entries || []).filter(entry => {
                                return (
                                    0 ||
                                    this.search === null ||
                                    entry?.title?.toLowerCase()?.indexOf(this.search?.toLowerCase()) > -1 ||
                                    entry?.description?.toLowerCase()?.indexOf(this.search?.toLowerCase()) > -1
                                );
                            }),
                            modelValue: this.modelValue,
                            isReadonly: this.isReadonly,
                        };
                    })
                    .filter(option => option?.entries?.length > 0);
            },

            /**
             * Get field options
             *
             * @return {*}
             */
            fieldOptions() {
                return {
                    label: this.field?.label,
                    withLabel: this.field?.hideLabel !== true,
                    withSearch: this.field?.searchable === true,
                };
            },

            /**
             * Get grid styles
             *
             * @return {*}
             */
            gridStyles() {
                return {
                    '--gap': this.field?.gridColumnsGap || '4rem',
                    '--columns': this.field?.gridColumns || 6,
                };
            },
        },
    };
</script>

<style scoped>
    .grid {
        gap: var(--gap);
        grid-template-columns: repeat(var(--columns), minmax(0, 1fr));
    }

    @media (max-width: 768px) {
        .grid {
            gap: 1rem;
            grid-template-columns: none !important;
        }
    }
</style>

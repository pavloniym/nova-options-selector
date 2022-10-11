<template>
    <div class="flex flex-col w-full">

        <!-- Search -->
        <div class="mb-3" v-if="fieldOptions.withSearch">
            <selector-search v-model="search"/>
        </div>

        <!-- Groups -->
        <!-- Entries -->
        <masonry-wall v-bind="gridOptions">
            <template #default="{ item }">
                <selector-group
                    v-bind="{...item, modelValue, isReadonly}"
                    @update:modelValue="$emit('update:modelValue', $event)">
                </selector-group>
            </template>
        </masonry-wall>

    </div>
</template>

<script>

    // Components
    import MasonryWall from '@yeger/vue-masonry-wall'

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
            MasonryWall,
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
                                    this.search === null ||
                                    entry?.title?.toLowerCase()?.indexOf(this.search?.toLowerCase()) > -1 ||
                                    entry?.description?.toLowerCase()?.indexOf(this.search?.toLowerCase()) > -1
                                );
                            }),
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
             * Get grid options
             *
             * @return {*}
             */
            gridOptions() {
                return {
                    gap: this.field?.gridColumnsGap || 8,
                    items: this.options,
                    columnWidth: this.field?.gridColumnsWidth || 300,
                }
            },

        },
    };
</script>

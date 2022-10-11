<template>
    <div class="block mb-8 pb-2">
        <!-- Group -->
        <div
            v-if="groupOptions.title"
            v-text="groupOptions.title"
            class="font-bold cursor-pointer"
            @click="toggleGroup"></div>

        <!-- Entries -->
        <div class="py-2">
            <!-- Entries -->
            <template v-for="(item, k) in items" :key="k">
                <div :style="{ paddingBottom: '4px' }">
                    <label class="inline-flex items-start">
                        <!-- Checkbox -->
                        <checkbox
                            class="mr-2"
                            :checked="(modelValue || []).includes(item.key)"
                            :disabled="isReadonly"
                            @input="toggleCheckbox(item.key)">
                        </checkbox>

                        <!-- Title -->
                        <!-- Description -->
                        <div class="ml-2">
                            <!-- Title -->
                            <div
                                v-if="item.title"
                                v-text="item.title"
                                class="text-sm leading-tight"
                                :style="{ lineHeight: '1.1' }"></div>

                            <!-- Description -->
                            <div
                                v-if="item.description"
                                v-text="item.description"
                                class="mb-2 leading-tight text-slate-800"
                                :style="{ fontSize: '.7rem', marginTop: '4px' }"></div>
                        </div>
                    </label>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    const props = {
        title: {
            type: String,
            default: null,
        },
        group: {
            type: Object,
            default: null,
        },
        entries: {
            type: Array,
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
        computed: {
            /**
             * Get group options
             *
             * @return {*}
             */
            groupOptions() {
                return {
                    title: this.group?.title || null,
                };
            },

            /**
             * Get items
             *
             * @return {array}
             */
            items() {
                return (this.entries || [])
                    .map(entry => {
                        return {
                            key: entry?.key || null,
                            title: entry?.title || null,
                            description: entry?.description || null,
                        };
                    })
                    .filter(item => item.key !== null);
            },
        },
        methods: {
            /**
             * Toggle group
             *
             * @return {void}
             */
            toggleGroup() {
                if (this.isReadonly === false) {
                    const values = [...this.modelValue];
                    const totalLength = (this.items || []).length;
                    const isCheckedLength = (this.items || []).filter(item => values.includes(item.key)).length;

                    // Check not checked if group has at least one checked item
                    if (isCheckedLength > 0 && isCheckedLength !== totalLength) {
                        this.items
                            .filter(item => values.includes(item.key) === false)
                            .forEach(item => values.push(item.key));
                    } else if (isCheckedLength === 0) {
                        this.items.forEach(item => values.push(item.key));
                    } else {
                        this.items
                            .filter(item => values.includes(item.key) === true)
                            .forEach(item => values.splice(values.indexOf(item.key), 1));
                    }

                    this.$emit('update:modelValue', values);
                }
            },

            /**
             * Toggle checkbox
             *
             * @param key
             * @return {void}
             */
            toggleCheckbox(key) {
                if (this.isReadonly === false) {
                    let values = [...this.modelValue];

                    this.$emit(
                        'update:modelValue',
                        values.includes(key) ? values.filter(item => item !== key) : [...values, key]
                    );
                }
            },
        },
    };
</script>

<style scoped>
    .checkbox:checked:disabled {
        background-color: currentColor;
    }
</style>

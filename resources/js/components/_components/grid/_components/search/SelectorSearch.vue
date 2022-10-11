<template>
    <div class="relative w-full md:w-1/3 md:flex-shrink-0">
        <RoundInput
            dusk="search"
            type="search"
            class="pl-4 appearance-none w-full form-control form-input form-input-bordered rounded-md"
            data-testid="search-input"
            spellcheck="false"
            :value="modelValue"
            :aria-label="__('Search')"
            :placeholder="__('Search')"
            :style="{ borderRadius: '.25rem !important' }"
            @input="handleChange">
        </RoundInput>
    </div>
</template>

<script>
    export default {
        emits: ['input'],
        props: {
            modelValue: {
                type: String,
                default: null,
            },
        },
        methods: {
            /**
             * Update the field's internal value
             *
             * @return {void}
             */
            handleChange(event) {
                this.$emit('update:modelValue', event?.target?.value || '');
            },
        },
    };
</script>

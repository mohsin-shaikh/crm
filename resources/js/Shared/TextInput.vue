<template>
    <div>
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input
            :id="id"
            ref="input"
            v-bind="$attrs"
            class="form-input"
            :class="{ error: error }"
            :type="type"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script>
import { uniqueId } from "lodash";

export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            default() {
                return `text-input-${uniqueId()}`;
            },
        },
        type: {
            type: String,
            default: "text",
        },
        modelValue: String,
        label: String,
        error: String,
    },
    methods: {
        focus() {
            this.$refs.input.focus();
        },
        select() {
            this.$refs.input.select();
        },
        setSelectionRange(start, end) {
            this.$refs.input.setSelectionRange(start, end);
        },
    },
};
</script>

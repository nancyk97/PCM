<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    comments: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <ul>
        <li v-for="(comment, index) in comments.slice(0, 5)" :key="comment.id" class="mb-2">
            <p>{{ comment.body }}</p>
            <p class="text-sm text-gray-500">Commented by User ID: {{ comment.user_id }}</p>
        </li>
        <li v-if="comments.length > 5" class="text-sm text-gray-500">
            ...and {{ comments.length - 5 }} more comments
        </li>
    </ul>
</template>
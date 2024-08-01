<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import CommentList from './CommentList.vue';

const posts = ref([]);
const expandedPosts = ref({});

const fetchPosts = async () => {
    try {
        const response = await axios.get('/api/posts');
        posts.value = response.data;
    } catch (error) {
        console.error('Error fetching posts:', error);
    }
};

const toggleComments = async (postId) => {
    if (expandedPosts.value[postId]) {
        expandedPosts.value[postId].visible = !expandedPosts.value[postId]?.visible;
    } else {
        try {
            const response = await axios.get(`/api/posts/${postId}/comments`);
            expandedPosts.value[postId] = {
                comments: response.data,
                visible: true,
            };
        } catch (error) {
            console.error('Error fetching comments:', error);
        }
    }
};

onMounted(fetchPosts);
</script>

<template>
    <Head title="Posts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div v-if="posts.length === 0" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <p>No posts available.</p>
                </div>
                <div v-else class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <ul>
                        <li v-for="post in posts" :key="post.id" class="mb-4">
                            <h3 class="text-lg font-semibold">{{ post.title }}</h3>
                            <p>{{ post.content }}</p>
                            <p class="text-sm text-gray-500">Posted by User ID: {{ post.user_id }}</p>
                            <button @click="toggleComments(post.id)" class="mt-2 text-blue-500">
                                {{ expandedPosts[post.id]?.visible ? 'Hide Comments' : 'Show Comments' }}
                            </button>
                            <CommentList v-if="expandedPosts[post.id]?.visible" :comments="expandedPosts[post.id].comments" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

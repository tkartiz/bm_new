<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';

defineProps({
    works: Array,
    application: Object,
})
</script>

<template>
    <Head title="制作物・一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">制作物・一覧</h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto px-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <FlashMessage />
                            <div class="w-full mx-auto overflow-auto">
                                制作物・一覧
                                {{ application.id }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

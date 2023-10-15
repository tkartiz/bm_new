<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';

defineProps({
    workspecs: Array
})
</script>

<template>
    <Head title="制作物仕様・一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">制作物仕様・一覧</h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto px-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <FlashMessage />
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                制作物番号</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                サイズ</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                出力形式</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                品目</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                内容</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                添付ファイル</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                数量</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                単位</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="workspec in workspecs" :key="workspec.id">
                                            <td class="px-2 py-3">
                                                <Link class="text-blue-400" :href="route('workspecs.show', { workspec: workspec.id })">
                                                    {{ workspec.id }}
                                                </Link>
                                            </td>
                                            <td class="px-2 py-3">{{ workspec.size }}</td>
                                            <td class="px-2 py-3">{{ workspec.format }}</td>
                                            <td class="px-2 py-3">{{ workspec.article }}</td>
                                            <td class="px-2 py-3">{{ workspec.content }}</td>
                                            <td class="px-2 py-3">{{ workspec.file }}</td>
                                            <td class="px-2 py-3">{{ workspec.quantity }}</td>
                                            <td class="px-2 py-3">{{ workspec.unit }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

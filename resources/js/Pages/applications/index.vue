<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    applications: Array
})
</script>

<template>
    <Head title="制作依頼・一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">制作依頼・一覧</h2>
        </template>

        <div class="py-12">
            <div class="w-full mx-auto px-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                No.</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                申請者名</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                品名</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作点数</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                緊急度</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                修正履歴</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                申請日</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                希望納期</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                合計金額（税抜）</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                合計金額（税込）</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="application in applications" :key="application.id">
                                            <td class="px-2 py-3">{{ application.id }}</td>
                                            <td class="px-2 py-3">{{ application.client_id }}</td>
                                            <td class="px-2 py-3">{{ application.subject }}</td>
                                            <td class="px-2 py-3">{{ application.works_quantity }}</td>
                                        <td class="px-2 py-3">{{ application.severity }}</td>
                                        <td class="px-2 py-3">{{ application.revision }}</td>
                                        <td class="px-2 py-3">{{ application.applicated_at }}</td>
                                        <td class="px-2 py-3">{{ application.desired_dlvd_at }}</td>
                                        <td class="px-2 py-3">{{ application.ttl_price_exc }}</td>
                                        <td class="px-2 py-3">{{ application.ttl_price_incl }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <Link as="button" :href="route('applications.create')" class="w-full bg-indigo-700 font-semibold text-white py-2 px-4 rounded">新規申請</Link> -->
                </section>
            </div>
        </div>
    </div>
</AuthenticatedLayout></template>

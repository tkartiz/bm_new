<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';

defineProps({
    applications: Array
})
</script>

<template>
    <Head title="申請書一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">申請書一覧</h2>
        </template>

        <div class="py-6">
            <div class="w-full mx-auto px-3">
                <div class="w-1/12 ms-auto">
                    <Link as="button" :href="route('applications.create')" class="w-full mx-auto py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-xl">
                    申請書の新規登録</Link>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <FlashMessage />
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                詳細</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                申請書番号</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                品名</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作点数</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                緊急度</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                修正履歴</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                申請日</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                希望納期</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                合計金額（税抜）</th>
                                            <th class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                合計金額（税込）</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="application in applications" :key="application.id">
                                            <td v-if="application.applicated_at === null" class="px-2 py-3">
                                                <Link class="w-full text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-xl" as="button" :href="route('applications.show', { application: application.id })">
                                                    詳細
                                                </Link>
                                            </td>
                                            <td v-else class="px-2 py-3 bg-gray-100">
                                                <Link class="w-full text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-xl" as="button" :href="route('applications.show', { application: application.id })">
                                                    問合せ
                                                </Link>
                                            </td>

                                            <td v-if="application.applicated_at === null" class="px-2 py-3">{{ application.id }}</td>
                                            <td v-else class="px-2 py-3 bg-gray-100"><p>{{ application.id }}</p></td>

                                            <td v-if="application.applicated_at === null" class="px-2 py-3 text-start">{{ application.subject }}</td>
                                            <td v-else class="px-2 py-3 text-start bg-gray-100">{{ application.subject }}</td>

                                            <td v-if="application.applicated_at === null" class="px-2 py-3">{{ application.works_quantity }}</td>
                                            <td v-else class="px-2 py-3 bg-gray-100">{{ application.works_quantity }}</td>

                                            <td v-if="application.applicated_at === null" class="px-2 py-3">{{ application.severity }}</td>
                                            <td v-else class="px-2 py-3 bg-gray-100">{{ application.severity }}</td>

                                            <td v-if="application.applicated_at === null" class="px-2 py-3">{{ application.revision }}</td>
                                            <td v-else class="px-2 py-3 bg-gray-100">{{ application.revision }}</td>

                                            <td v-if="application.applicated_at === null" class="px-2 py-3">{{ application.applicated_at }}</td>
                                            <td v-else class="px-2 py-3 bg-gray-100">{{ application.applicated_at }}</td>

                                            <td v-if="application.applicated_at === null" class="px-2 py-3">{{ application.desired_dlvd_at }}</td>
                                            <td v-else class="px-2 py-3 bg-gray-100">{{ application.desired_dlvd_at }}</td>

                                            <td v-if="application.applicated_at === null" class="px-2 py-3">{{ application.ttl_price_exc }}</td>
                                            <td v-else class="px-2 py-3 bg-gray-100">{{ application.ttl_price_exc }}</td>

                                            <td v-if="application.applicated_at === null" class="px-2 py-3">{{ application.ttl_price_incl }}</td>
                                            <td v-else class="px-2 py-3 bg-gray-100">{{ application.ttl_price_incl }}</td>
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

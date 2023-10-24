<script setup>
import AuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';

defineProps({
    works: Array,
    workspecs: Array,
    application: Array,
    os_appd: Array,
    creators: Array,
    user: Object,
})
</script>

<template>
    <Head title="制作物・一覧" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">制作物・一覧</h2>
        </template>
        <div class="py-3">
            <div class="container mx-auto">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font relative">
                        <FlashMessage />
                        <div class="px-5 py-2 bg-white mb-5">
                            <div class="p-2 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                詳細</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                番号</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作物番号</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作者名</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                外注有無</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                外注承認ID</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作開始日</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                制作完了日</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                金額（税抜）</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                金額（税込）</th>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                連絡事項</th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="work in works" :key="work.id">
                                        <tr>
                                            <td class="px-2 py-3">
                                                <Link v-if="user.roll === 'admin'"
                                                    class="w-full text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-xl"
                                                    as="button" :href="route('admin.works.show', { work: work.id })">
                                                詳細
                                                </Link>
                                                <Link v-if="user.roll === 'creator'"
                                                    class="w-full text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-xl"
                                                    as="button" :href="route('creator.works.show', { work: work.id })">
                                                詳細
                                                </Link>
                                            </td>
                                            <td class="px-2 py-3">{{ work.id }}</td>
                                            <td class="px-2 py-3">{{ work.work_spec_id }}</td>
                                            <td class="px-2 py-3">
                                                <p v-if="user.roll === 'admin'" v-for="creator in creators" :key="creator.id">
                                                    <span v-if="creator.id == work.creator_id">{{ creator.name }}</span>
                                                    <span v-else></span>
                                                </p>
                                                <p v-else><span v-if="creators.id == work.creator_id">{{ creators.name }}</span></p>
                                            </td>
                                            <td class="px-2 py-3">
                                                <p v-if="work.outsourcing == 1">あり</p>
                                                <p v-if="work.outsourcing == 0">なし</p>
                                                <p v-else></p>
                                            </td>
                                            <td class="px-2 py-3">{{ work.os_appd_id }}</td>
                                            <td class="px-2 py-3">{{ work.started_at }}</td>
                                            <td class="px-2 py-3">{{ work.completed_at }}</td>
                                            <td class="px-2 py-3">{{ work.price_exc }}</td>
                                            <td class="px-2 py-3">{{ work.price_incl }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
</AuthenticatedLayout></template>

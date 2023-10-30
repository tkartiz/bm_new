<script setup>
import AuthenticatedLayout from '@/Layouts/CreatorAuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';

defineProps({
    user: Object,
    application: Object,
    workspec: Object,
})

const deleteWorkspec = id => {
    Inertia.delete(route('creator.workspecs.destroy', { workspec: id }), {
        onBefore: () => confirm('本当に削除しますか？')
    });
}
</script>

<template>
    <Head title="制作物仕様内容" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">制作物仕様内容</h2>
        </template>
        <div class="py-12">
            <div class="w-full mx-auto px-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="px-5 py-2 bg-white mb-5">
                                <!-- 依頼者情報 -->
                                <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                    <p class="w-1/3">申請番号：{{ application.id }} </p>
                                    <p class="w-1/3">依頼者：{{ user.name }}</p>
                                    <p class="w-1/3">所属：{{ user.affiliation }}</p>
                                </div>
                            </div>
                            <div class="px-5 py-2 bg-white mb-5">
                                <!-- 申請書情報 -->
                                <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                    <p class="w-2/6">品名：{{ application.subject }}</p>
                                    <p class="w-1/6">申請日：{{ application.applicated_at }}</p>
                                    <p class="w-1/6">希望納期：{{ application.desired_dlvd_at }}</p>
                                    <p class="w-1/6">依頼点数：{{ application.works_quantity }}</p>
                                    <p class="w-1/6">緊急度：{{ application.severity }}</p>
                                </div>
                                <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                    <p class="w-4/6"></p>
                                    <p class="w-1/6">見積金額（税抜）:￥{{ application.price_exc }}</p>
                                    <p class="w-1/6">見積金額（税込）:￥{{ application.price_incl }}</p>
                                </div>
                            </div>

                            <FlashMessage />
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
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
                                                class="px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                単位</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-2 py-3">{{ workspec.id }}</td>
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
                            <div class="w-full mx-auto my-10">
                                <Link as="button" :href="route('creator.workspecs.edit', {workspec: workspec.id})" class="w-1/3 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                                    編集する
                                </Link>
                                <button @click="deleteWorkspec(workspec.id)"
                                class="w-1/3 py-2 text-white bg-red-500 border-0 focus:outline-none hover:bg-red-600">
                                削除する</button>
                                <Link as="button" :href="route('creator.workspecs.index', {application: application.id})" class="w-1/3 py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                    戻る
                                </Link>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

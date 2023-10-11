<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    errors: Object,
    user: Array
})

const form = reactive({
    client_id: null,
    subject: null,
    works_quantity: null,
    severity: null,
    revision: null,
    applicated_at: null,
    desired_dlvd_at: null,
})

const storeApplication = () => {
    Inertia.post('/applications', form)
}
</script>

<template>
    <Head title="新規申請" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">新規申請</h2>
        </template>

        <div class="py-3">
            <div class="container mx-auto">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-3 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="storeApplication(user.id)">
                                <!-- 依頼者情報 -->
                                <div class="px-5 py-2 bg-white mb-5">
                                    <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                        <p class="w-1/3">申請番号：{{ application.id }}</p>
                                        <p class="w-1/3">依頼者：{{ user.name }}</p>
                                        <p class="w-1/3">所属：{{ user.affiliation }}</p>
                                    </div>
                                </div>

                                <!-- 申請内容 -->
                                    <div class="p-2 w-8/12"></div>
                                    <div class="p-2 w-2/12 text-center">
                                        <p class="leading-7 lh-sm text-sm text-gray-600">見積金額（税抜）<br>￥**,***</p>
                                    </div>
                                    <div class="p-2 w-2/12 text-center">
                                        <p class="leading-7 lh-sm text-sm text-gray-600">見積金額（税込）<br>￥**,***</p>
                                    </div>

                                    <div class="p-2 w-full -mb-4">内訳：</div>
                                    <div class="p-2 w-full flex text-center -mb-5">
                                        <div class="p-2 w-1/12">制作No.</div>
                                        <div class="p-2 w-2/12">サイズ</div>
                                        <div class="p-2 w-2/12">出力形式</div>
                                        <div class="p-2 w-4/12">上段：品目／下段：内容</div>
                                        <div class="p-2 w-1/12">数量</div>
                                        <div class="p-2 w-1/12">金額<br>（税抜）</div>
                                        <div class="p-2 w-1/12">金額<br>（税込）</div>
                                    </div>

                                    <!-- 申請内容・内訳 -->
                                    <div class="p-2 w-full text-center">
                                        <div class="mb-5">
                                            <div class="w-full flex">
                                                <div class="p-1 w-1/12">
                                                    <input type="integer" id="works1_id" name="works1_id" value="1"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                </div>
                                                <div class="p-1 w-2/12">
                                                    <div class="relative">
                                                        <input type="text" id="works1_size" name="works1_size"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>
                                                <div class="p-1 w-2/12">
                                                    <div class="relative">
                                                        <input type="text" id="works1_format" name="works1_format"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>
                                                <div class="p-1 w-4/12">
                                                    <div class="relative">
                                                        <input type="text" id="works1_article" name="works1_article"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>
                                                <div class="p-1 w-1/12">
                                                    <div class="relative">
                                                        <input type="integer" id="works1_quantity" name="works1_quantity"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>
                                                <div class="p-1 w-1/12">
                                                    <div class="relative">
                                                        <input type="integer" id="works1_ttl_price_exc"
                                                            name="works1_ttl_price_exc"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>
                                                <div class="p-1 w-1/12">
                                                    <div class="relative">
                                                        <input type="integer" id="works1_ttl_price_incl"
                                                            name="works1_ttl_price_incl"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full flex">
                                                <div class="p-1 w-5/12"></div>
                                                <div class="p-1 w-4/12">
                                                    <textarea id="works1_content" name="works1_content"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-24 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea><br>
                                                    <div class="flex w-full">
                                                        <button
                                                            class="w-1/5 bg-red-500 hover:bg-red-700 text-white rounded-l-xl">削除</button>
                                                        <input type="file" id="works1_file1" name="works1_file1"
                                                            class="w-4/5">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-7/12 mx-auto my-10">
                                    <button type="submit"
                                        class="w-full mx-auto py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-xl">制作物仕様を作成する</button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
</AuthenticatedLayout></template>
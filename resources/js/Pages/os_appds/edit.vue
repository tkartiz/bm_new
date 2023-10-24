<script setup>
import AuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";

const props = defineProps({
    errors: Object,
    os_appd: Object,
    work: Object,
    workspec: Object,
    application: Object,
    client: Object,
    creator: Object,
    user: Object,
})

const form = reactive({
    id: props.os_appd.id,
    comment: props.os_appd.comment,
    spec: props.os_appd.spec,
    order_recipient: props.os_appd.order_recipient,
    price_exc: props.os_appd.price_exc,
    price_incl: props.os_appd.price_incl,
    price_list: props.os_appd.price_list,
    comp_num: props.os_appd.comp_num,
})

const updateWork = (id) => {
    form.work_id = document.getElementById("work_id").value;
    let userRoll = document.getElementById("user_roll").value;
    if (userRoll === 'admin') {
        Inertia.put(route('admin.os_appds.update', { os_appd: id }), form);
    } else if (userRoll === 'creator') {
        Inertia.put(route('creator.os_appds.update', { os_appd: id }), form);
    };
}

</script>

<template>
    <Head title="外注承認書編集" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">外注承認書編集</h2>
        </template>
        <div class="py-3">
            <div class="container mx-auto">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-3 text-gray-900">
                        <section class="text-gray-600 body-font relative">

                            <div class="px-5 py-2 bg-white mb-5">
                                <!-- 依頼者情報 -->
                                <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                    <p class="w-1/3">申請番号：{{ application.id }} </p>
                                    <p class="w-1/3">依頼者：{{ client.name }}</p>
                                    <p class="w-1/3">所属：{{ client.affiliation }}</p>
                                </div>
                            </div>
                            <div class="px-5 py-2 bg-white mb-5">
                                <!-- 申請書情報 -->
                                <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                    <p class="w-2/6">品名：{{ application.subject }}</p>
                                    <p class="w-2/6">希望納期：{{ application.desired_dlvd_at }}</p>
                                    <p class="w-1/6">依頼点数：{{ application.works_quantity }}</p>
                                    <p class="w-1/6">緊急度：{{ application.severity }}</p>
                                </div>
                                <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                    <p class="w-2/6"></p>
                                    <p class="w-2/6">見積金額（税抜）:￥{{ application.price_incl }}</p>
                                    <p class="w-2/6">見積金額（税込）:￥{{ application.price_exc }}</p>
                                </div>
                            </div>

                            <!-- <div class="px-5 py-2 bg-white mb-0">
                                <div class="p-2 w-full mx-auto overflow-auto">
                                    <p class="font-medium">仕様</p>
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
                                                <td class="px-2 py-3 w-1/12">{{ workspec.id }}</td>
                                                <td class="px-2 py-3 w-1/12">{{ workspec.size }}</td>
                                                <td class="px-2 py-3 w-1/12">{{ workspec.format }}</td>
                                                <td class="px-2 py-3 w-2/12">{{ workspec.article }}</td>
                                                <td class="px-2 py-3">{{ workspec.content }}</td>
                                                <td class="px-2 py-3 w-2/12">{{ workspec.file }}</td>
                                                <td class="px-2 py-3 w-1/12">{{ workspec.quantity }}</td>
                                                <td class="px-2 py-3 w-1/12">{{ workspec.unit }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="px-5 py-2 bg-white mb-5">
                                <div class="p-2 w-full mx-auto overflow-auto">
                                    <p class="font-medium">情報</p>
                                    <table class="table-auto w-full text-center whitespace-no-wrap">
                                        <thead>
                                            <tr>
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
                                        <tbody>
                                            <tr>
                                                <td class="px-2 py-3 w-2/12">
                                                    <p>{{ creator.name }}</p>
                                                </td>
                                                <td class="px-2 py-3 w-1/12">
                                                    <p v-if="work.outsourcing === 0">なし</p>
                                                    <p v-if="work.outsourcing === 1">あり</p>
                                                </td>
                                                <td class="px-2 py-3 w-1/12">{{ work.os_appd_id }}</td>
                                                <td class="px-2 py-3 w-1/12">{{ work.started_at }}</td>
                                                <td class="px-2 py-3 w-1/12">{{ work.completed_at }}</td>
                                                <td class="px-2 py-3 w-1/12">{{ work.price_incl }}</td>
                                                <td class="px-2 py-3 w-1/12">{{ work.price_exc }}</td>
                                                <td class="px-2 py-3">{{ work.message }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> -->

                            <div class="px-5 py-2 bg-white mb-5">
                                <BreezeValidationErrors :errors="errors" />
                                <form @submit.prevent="updateWork(form.id)" class="w-full">
                                    <input id="work_id" :value="work.id" type="hidden">
                                    <input id="user_roll" :value="user.roll" type="hidden">
                                    <div class="p-2 w-full mx-auto overflow-auto">
                                        <div class="flex w-full">
                                            <label for="comment" class="w-2/12">コメント</label>
                                            <textarea id="comment" v-model="form.comment"
                                                            class="w-10/12 h-16 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 transition-colors duration-200 ease-in-out"></textarea>
                                        </div>
                                        <div class="flex w-full">
                                            <p class="w-2/12 py-2">サイズ</p>
                                            <p class="p-2">{{ workspec.size }}</p>
                                        </div>
                                        <div class="flex w-full">
                                            <label for="spec" class="w-2/12">仕様詳細</label>
                                            <textarea id="spec" v-model="form.spec"
                                                            class="w-6/12 h-24 py-1 px-3 resize-none leading-6 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 transition-colors duration-200 ease-in-out">
                                                        </textarea>
                                        </div>
                                        <div class="flex w-full">
                                            <p class="w-2/12 py-2">数量</p>
                                            <p class="p-2">{{ workspec.quantity }}</p>
                                            <p class="p-2">{{ workspec.unit }}</p>
                                        </div>
                                        <div class="flex w-full">
                                            <p class="w-2/12 py-2">発注先</p>
                                            <p class="p-2">{{ os_appd.order_recipient }}</p>
                                        </div>
                                        <div class="flex w-full">
                                            <div class="flex w-1/3 me-3">
                                                <label for="price_exc" class="w-1/2 py-2">金額（税抜）</label>
                                                <p id="price_exc" class="w-1/2 p-2">￥{{ os_appd.price_exc }}</p>
                                            </div>
                                            <div  class="flex w-1/3">
                                                <label for="price_incl" class="w-1/2 py-2">金額（税込）</label>
                                                <p id="price_incl" class="w-1/2 p-2">￥{{ os_appd.price_incl }}</p>
                                            </div>
                                        </div>
                                        <div class="flex w-full mb-3">
                                            <label for="price_list" class="w-2/12">価格明細</label>
                                            <textarea id="price_list" v-model="form.price_list"
                                                            class="w-10/12 h-8 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 transition-colors duration-200 ease-in-out"></textarea>
                                        </div>
                                        <div class="flex w-full mb-3">
                                            <label for="remarks" class="w-2/12">備考</label>
                                            <textarea id="remarks" v-model="form.remarks"
                                                            class="w-10/12 h-24 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 transition-colors duration-200 ease-in-out"></textarea>
                                        </div>
                                        <div class="w-full flex">
                                            <label for="comp_num" class="w-2/12 py-2">競合社数</label>
                                            <input type="integer" v-model="form.comp_num" class="w-1/12 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 transition-colors duration-200 ease-in-out" >
                                        </div>
                                    </div>
                                    <div class="w-full mx-auto my-10">
                                        <button type="submit"
                                            class="w-1/2 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">更新する</button>
                                        <Link v-if="user.roll === 'admin'" as="button"
                                            :href="route('admin.os_appds.show', { os_appd: os_appd.id })"
                                            class="w-1/2 py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                        戻る</Link>
                                        <Link v-if="user.roll === 'creator'" as="button"
                                            :href="route('creator.os_appds.show', { os_appd: os_appd.id })"
                                            class="w-1/2 py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                        戻る</Link>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
</AuthenticatedLayout></template>
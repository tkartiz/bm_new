<script setup>
import AuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";

const props = defineProps({
    errors: Object,
    work: Object,
    workspec: Object,
    application: Object,
    client: Object,
    creators: Array,
    user: Object,
})

const form = reactive({
    id: props.work.id,
    creator_id: props.work.creator_id,
    outsourcing: props.work.outsourcing,
    started_at: props.work.started_at,
    completed_at: props.work.completed_at,
    message: props.work.message,
})

const updateWork = (id) => {
    form.work_id = document.getElementById("work_id").value;
    let userRoll = document.getElementById("user_roll").value;
    if(userRoll === 'admin'){
        Inertia.put(route('admin.works.update', { work: id }), form);
    } else if(userRoll === 'creator') {
        Inertia.put(route('creator.works.update', { work: id }), form);
    };
}

</script>

<template>
    <Head title="制作物編集" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">制作物編集</h2>
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

                            <div class="px-5 py-2 bg-white mb-0">
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
                                <BreezeValidationErrors :errors="errors" />
                                <form @submit.prevent="updateWork(form.id)" class="w-full">
                                    <input id="work_id" :value="work.id" type="hidden">
                                    <input id="user_roll" :value="user.roll" type="hidden">
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
                                                        <select v-model="form.creator_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                            <option v-if="user.roll === 'admin'" v-for="creator in creators" :key="creator.id" :value="creator.id">{{ creator.name }}</option>
                                                            <option v-if="user.roll === 'creator'" :value="creators.id">{{ creators.name }}</option>
                                                        </select>
                                                    </td>
                                                    <td class="px-2 py-3 w-1/12">
                                                        <select v-model="form.outsourcing" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                            <option value="0">なし</option>
                                                            <option value="1">あり</option>
                                                        </select>
                                                        <p></p>
                                                    </td>
                                                    <td class="px-2 py-3 w-1/12">{{ work.os_appd_id }}</td>
                                                    <td class="px-2 py-3 w-1/12" ><input type="date" v-model="form.started_at" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></td>
                                                    <td class="px-2 py-3 w-1/12"><input type="date" v-model="form.completed_at" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></td>
                                                    <td class="px-2 py-3 w-1/12">{{ work.price_incl }}</td>
                                                    <td class="px-2 py-3 w-1/12">{{ work.price_exc }}</td>
                                                    <td class="px-2 py-3">
                                                        <textarea v-model="form.message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-24 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">

                                                        </textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="w-full mx-auto my-10">
                                        <button type="submit"
                                            class="w-1/2 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">更新する</button>
                                        <Link v-if="user.roll === 'admin'" as="button" :href="route('admin.works.show', { work: work.id })"
                                            class="w-1/2 py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                        戻る</Link>
                                        <Link v-if="user.roll === 'creator'" as="button" :href="route('creator.works.show', { work: work.id })"
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
    </AuthenticatedLayout>
</template>
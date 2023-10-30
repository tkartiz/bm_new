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
    os_appd: Object,
    outsourcings: Array,
    client: Object,
    creator: Object,
    user: Object,
    admins: Array,
})

const form = reactive({
    id: props.os_appd.id,
    comment: props.os_appd.comment,
    spec: props.os_appd.spec,
    order_recipient: props.os_appd.order_recipient,
    price_exc: props.os_appd.price_exc,
    price_incl: props.os_appd.price_incl,
    price_list: props.os_appd.price_list,
    remarks: props.os_appd.remarks,
    comp_num: props.os_appd.comp_num,
    appd1_id: props.os_appd.appd1_id,
    appd2_id: props.os_appd.appd2_id,
})

const updateWork = (id) => {
    form.work_id = document.getElementById("work_id").value;
    form.comp_num_exist = document.getElementById("comp_num_exist").value;
    Inertia.put(route('admin.os_appds.update', { os_appd: id }), form);
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
                            <div class="flex p-5 bg-white mb-5">
                                <div class="w-1/3 text-sm text-gray-600">
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">申請番号<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">{{ application.id }} </dd>
                                    </dl>
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">依頼者<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">{{ client.name }}</dd>
                                    </dl>
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">所属<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">{{ client.affiliation }}</dd>
                                    </dl>
                                </div>
                                <div class="w-1/3 text-sm text-gray-600">
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">品名<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">{{ application.subject }}</dd>
                                    </dl>
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">サイズ<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">{{ workspec.size }}</dd>
                                    </dl>
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">出力形式<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">{{ workspec.format }}</dd>
                                    </dl>
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">数量<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">{{ workspec.quantity }}{{ workspec.unit }}</dd>
                                    </dl>
                                </div>
                                <div class="w-1/3 flex-wrap text-sm text-gray-600">
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">希望納期<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">{{ application.desired_dlvd_at }}</dd>
                                    </dl>
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">依頼総点数<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">{{ application.works_quantity }}</dd>
                                    </dl>
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">緊急度<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">{{ application.severity }}</dd>
                                    </dl>
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">見積金額（税抜）<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">￥{{ application.price_incl }}</dd>
                                    </dl>
                                    <dl class="flex">
                                        <dt class="w-32 py-1 flex">見積金額（税込）<p class="ms-auto">：</p>
                                        </dt>
                                        <dd class="ps-3 py-1">￥{{ application.price_exc }}</dd>
                                    </dl>
                                </div>
                            </div>

                            <div class="p-5 bg-white">
                                <BreezeValidationErrors :errors="errors" />
                                <form @submit.prevent="updateWork(form.id)">
                                    <input id="work_id" :value="work.id" type="hidden">
                                    <input id="user_roll" :value="user.roll" type="hidden">
                                    <input id="comp_num_exist" :value="outsourcings.length" type="hidden">
                                    <div class="flex">
                                        <div class="w-3/4 pe-10 me-auto overflow-auto">
                                            <dl class="flex w-full mb-10">
                                                <dt class="w-32 py-1 flex">コメント<p class="ms-auto">：</p>
                                                </dt>
                                                <dd class="w-full ps-3 py-1">
                                                    <textarea v-model="form.comment"
                                                        class="w-full h-16 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-sm outline-none text-gray-700 transition-colors duration-200 ease-in-out"></textarea>
                                                </dd>
                                            </dl>
                                            <div class="w-full mb-10">
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">品名<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="ps-3 py-1">{{ application.subject }}</dd>
                                                </dl>
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">サイズ<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="ps-3 py-1">{{ workspec.size }}</dd>
                                                </dl>
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">出力形式<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="ps-3 py-1">{{ workspec.format }}</dd>
                                                </dl>
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">数量<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="ps-3 py-1">{{ workspec.quantity }}{{ workspec.unit }}</dd>
                                                </dl>
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">仕様詳細<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="w-full ps-3 py-1">
                                                        <textarea v-model="form.spec"
                                                            class="w-full h-24 py-1 px-3 resize-none leading-6 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-sm outline-none text-gray-700 transition-colors duration-200 ease-in-out">
                                                        </textarea>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <div class="w-full mb-10">
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">発注先<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="w-full ps-3 py-1">
                                                        <div v-for="outsourcing in outsourcings" :key="outsourcing.id">
                                                            <p v-if="outsourcing.id == os_appd.order_recipient">{{
                                                                outsourcing.comp_name }}</p>
                                                            <p v-else></p>
                                                        </div>
                                                    </dd>
                                                </dl>
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">金額（税抜）<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="w-full ps-3 py-1">￥{{ os_appd.price_exc }}</dd>
                                                </dl>
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">金額（税込）<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="w-full ps-3 py-1">￥{{ os_appd.price_incl }}</dd>
                                                </dl>
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">価格明細<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="w-full ps-3 py-1">
                                                        <textarea v-model="form.price_list"
                                                            class="w-full h-16 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-sm outline-none text-gray-700 transition-colors duration-200 ease-in-out"></textarea>
                                                    </dd>
                                                </dl>
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">備考<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="w-full ps-3 py-1">
                                                        <textarea v-model="form.remarks"
                                                            class="w-full h-24 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-sm outline-none text-gray-700 transition-colors duration-200 ease-in-out"></textarea>
                                                    </dd>
                                                </dl>
                                                <dl class="flex">
                                                    <dt class="w-32 py-1 flex">競合数<p class="ms-auto">：</p>
                                                    </dt>
                                                    <dd class="w-full ps-3 py-1">
                                                        <input type="integer" v-model="form.comp_num"
                                                            class="w-16 py-1 px-3 leading-8 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-sm outline-none text-gray-700 transition-colors duration-200 ease-in-out">
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="w-1/4 ms-auto">
                                            <table class="w-full border-separate border border-slate-400 text-center">
                                                <tr>
                                                    <th colspan="3" class="border border-slate-300">承認欄</th>
                                                </tr>
                                                <tr>
                                                    <th class="w-1/3 border border-slate-300">承認者</th>
                                                    <th class="w-1/3 border border-slate-300">承認者</th>
                                                    <th class="w-1/3 before:border border-slate-300">担当者</th>
                                                </tr>
                                                <tr>
                                                    <td class="h-20 border border-slate-300">
                                                        <select type="integer" v-model="form.appd2_id"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                            <option value=""></option>
                                                            <option v-for="admin in admins" :key="admin.id"
                                                                :value="admin.id">{{ admin.name }}</option>
                                                        </select>
                                                    </td>
                                                    <td class="h-20 border border-slate-300">
                                                        <select type="integer" v-model="form.appd1_id"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                            <option value=""></option>
                                                            <option v-for="admin in admins" :key="admin.id"
                                                                :value="admin.id">{{ admin.name }}</option>
                                                        </select>
                                                    </td>
                                                    <td class="h-20 border border-slate-300">{{ user.name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border border-slate-300 text-sm">承認可(日付)/否</td>
                                                    <td class="border border-slate-300 text-sm">承認可(日付)/否</td>
                                                    <td class="border border-slate-300 text-sm">申請日付</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="w-full mx-auto overflow-auto">
                                        <div class="w-full">
                                            <table v-if="outsourcings !== null" class="w-full flex">
                                                <tbody v-for="outsourcing in outsourcings" :key="outsourcing.id"
                                                    class="w-1/3 p-5">
                                                    <tr class="w-full flex">
                                                        <th class="w-40 py-1 flex bg-gray-100">発注先<p class="ms-auto">：</p>
                                                        </th>
                                                        <td
                                                            class="w-full py-1 block text-center items-center pl-4 dark:border-gray-700 bg-gray-100">
                                                            <input type="radio" v-model="form.order_recipient"
                                                                :value="outsourcing.id"
                                                                class="w-4 h-4 me-24 text-blue-600 bg-gray-300 border-gray-500 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        </td>
                                                    </tr>
                                                    <tr class="w-full flex">
                                                        <th class="w-40 py-1 flex">競合先<p class="ms-auto">：</p>
                                                        </th>
                                                        <td v-if="outsourcing.comp_name !== null" class="w-full px-5 py-1">
                                                            {{ outsourcing.comp_name }}</td>
                                                        <td v-else class="w-full px-5 py-1">&nbsp;</td>
                                                    </tr>
                                                    <tr class="w-full flex">
                                                        <th class="w-40 py-1 flex bg-gray-100">
                                                            金額（税抜）<p class="ms-auto">：</p>
                                                        </th>
                                                        <td v-if="outsourcing.comp_price_exc !== null"
                                                            class="w-full block px-5 py-1 bg-gray-100">
                                                            ￥{{ outsourcing.comp_price_exc }}</td>
                                                        <td v-else class="w-full block px-5 py-1">&nbsp;</td>
                                                    </tr>
                                                    <tr class="w-full flex">
                                                        <th class="w-40 py-1 flex">
                                                            金額（税込）<p class="ms-auto">：</p>
                                                        </th>
                                                        <td v-if="outsourcing.comp_price_incl !== null"
                                                            class="w-full block px-5 py-1">￥{{ outsourcing.comp_price_incl
                                                            }}
                                                        </td>
                                                        <td v-else class="w-full px-5 py-1">&nbsp;</td>
                                                    </tr>
                                                    <tr class="w-full flex">
                                                        <th class="w-40 py-1 flex bg-gray-100">備考<p class="ms-auto">：</p>
                                                        </th>
                                                        <td v-if="outsourcing.remarks !== null"
                                                            class="w-full block px-5 py-1 bg-gray-100">
                                                            {{ outsourcing.remarks }}</td>
                                                        <td v-else class="w-full block px-5 py-1 bg-gray-100">&nbsp;</td>
                                                    </tr>
                                                    <tr class="w-full flex">
                                                        <th class="w-40 py-1 flex">見積もり<p class="ms-auto">：</p>
                                                        </th>
                                                        <td class="w-full block p-3 py-1">
                                                            <p v-if="outsourcing.comp_file1 !== null">{{
                                                                outsourcing.comp_file1 }}</p>
                                                            <p v-else>&emsp;</p>

                                                            <p v-if="outsourcing.comp_file2 !== null">{{
                                                                outsourcing.comp_file2 }}</p>
                                                            <p v-else>&emsp;</p>

                                                            <p v-if="outsourcing.comp_file3 !== null">{{
                                                                outsourcing.comp_file3 }}</p>
                                                            <p v-else>&emsp;</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="w-full block p-3 py-1 text-center">
                                                        <Link as="button"
                                                            :href="route('admin.outsourcings.edit', { outsourcing: outsourcing.id })"
                                                            class="w-2/3 py-2 text-white bg-blue-500 border-0 focus:outline-none hover:bg-blue-600 rounded-xl">
                                                        編集する</Link>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="w-full mx-auto my-10">
                                        <div class="w-full me-auto mb-3"
                                            v-if="os_appd.appd1_approval === null && os_appd.appd2_approval === null">
                                            <input type="checkbox" id="applicated_at" v-model="form.check"
                                                class="w-5 h-5 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />　申請します
                                        </div>
                                        <button v-if="form.check === true" type="submit"
                                            class="w-1/2 py-2 text-white bg-orange-500 border-0 focus:outline-none hover:bg-orange-600 rounded-l-xl">申請する</button>
                                        <button v-else type="submit"
                                            class="w-1/2 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">更新する</button>

                                        <Link as="button"
                                            :href="route('admin.os_appds.show', { os_appd: os_appd.id })"
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
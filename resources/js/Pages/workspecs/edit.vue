<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";

const props = defineProps({
    errors: Object,
    application: Object,
    user: Object,
    workspec: Object,
})

const form = reactive({
    id: props.workspec.id,
    size: props.workspec.size,
    format: props.workspec.format,
    article: props.workspec.article,
    content: props.workspec.content,
    file: props.workspec.file,
    quantity: props.workspec.quantity,
    unit: props.workspec.unit,
})

const updateWorkspec = (id) => {
    form.application_id = document.getElementById("application_id").value;
    form.file = document.getElementById("work_file").value;

    Inertia.put(route('/workspecs', {workspec: id}), form);
}


</script>

<template>
    <Head title="制作物仕様入力" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">制作物仕様入力</h2>
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
                                    <p class="w-1/6">見積金額（税抜）:￥{{ application.price_incl }}</p>
                                    <p class="w-1/6">見積金額（税込）:￥{{ application.price_exc }}</p>
                                </div>
                            </div>

                            <div class="p-3 flex flex-wrap bg-white">
                                <!-- 申請内容・内訳 -->
                                <div class="p-2 w-full -mb-4">内訳：</div>
                                <BreezeValidationErrors :errors="errors" />
                                <form @submit.prevent="updateWorkspec(application.id)">
                                    <input type="integer" id="application_id" name="application_id" v-bind:value="application.id" class="hidden"/>
                                    <div class="p-2 w-full text-center">
                                        <div class="mb-5">
                                            <div class="w-full flex">
                                                <div class="p-1 w-10">
                                                    <p class="w-full mt-8">{{ n }}</p>
                                                </div>
                                                <div class="p-1 w-2/12">
                                                    <div class="relative">
                                                        <label for="work_size">サイズ</label>
                                                        <select id="work_size" v-model="form.size"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                            <option disabled value="">選択してください</option>
                                                            <option value="A1">A1</option>
                                                            <option value="A2">A2</option>
                                                            <option value="A3">A3</option>
                                                            <option value="A4">A4</option>
                                                            <option value="A5以下">A5以下</option>
                                                            <option value="名刺">名刺</option>
                                                            <option value="バナー">バナー</option>
                                                            <option value="1cA3">1cA3</option>
                                                            <option value="1CA5以下">1CA5以下</option>
                                                            <option value="1c名刺">1c名刺</option>
                                                            <option value="シール">シール</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="p-1 w-2/12">
                                                    <div class="relative">
                                                        <label for="work_format">出力形式</label>
                                                        <select id="work_format" v-model="form.format"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                            <option disabled value="">選択してください</option>
                                                            <option value="紙だけ">紙だけ</option>
                                                            <option value="ラミ">ラミ</option>
                                                            <option value="パネル">パネル</option>
                                                            <option value="ラミパネ">ラミパネ</option>
                                                            <option value="データ提出">データ提出</option>
                                                            <option value="入稿">入稿</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="p-1 w-3/12">
                                                    <div class="relative">
                                                        <label for="work_article">品目</label>
                                                        <select id="work_article" v-model="form.article"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                            <option disabled value="">下記リストにあれば、選択してください</option>
                                                            <option value="出力のみ">出力のみ</option>
                                                            <option value="文字校【軽】500">文字校【軽】500</option>
                                                            <option value="文字校【重】1500">文字校【重】1500</option>
                                                            <option value="注意・誘導【片面】3000">注意・誘導【片面】3000</option>
                                                            <option value="注意・誘導【両面】5000">注意・誘導【両面】5000</option>
                                                            <option value="シンプルなPOP【片面】15000">シンプルなPOP【片面】15000</option>
                                                            <option value="シンプルなPOP【両面】25000">シンプルなPOP【両面】25000</option>
                                                            <option value="複雑なPOP・チラシ【片面】30000">複雑なPOP・チラシ【片面】30000</option>
                                                            <option value="複雑なPOP・チラシ【両面】50000">複雑なPOP・チラシ【両面】50000</option>
                                                            <option value="パンフレット・メニュー【片面】50000">パンフレット・メニュー【片面】50000</option>
                                                            <option value="パンフレット・メニュー【両面】80000">パンフレット・メニュー【両面】80000</option>
                                                            <option value="撮影1～5カット15000">撮影1～5カット15000</option>
                                                            <option value="撮影6～15カット30000">撮影6～15カット30000</option>
                                                            <option value="ヒアリング10000">ヒアリング10000</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="p-1 w-5/12">
                                                    <label for="work_content">内容（品目にない場合に記載）</label>
                                                    <textarea id="work_content" v-model="form.content"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-24 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea><br>
                                                    <div class="flex w-full">
                                                        <button
                                                            class="w-1/5 bg-red-500 hover:bg-red-700 text-white rounded-l-xl">削除</button>
                                                        <input type="file" id="work_file" name="work_file"
                                                            class="w-4/5">
                                                    </div>
                                                </div>
                                                <div class="p-1 w-1/12">
                                                    <div class="relative">
                                                        <label for="work_quantity">数量</label>
                                                        <input type="integer" id="work_quantity" v-model="form.quantity"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>
                                                <div class="p-1 w-1/12">
                                                    <div class="relative">
                                                        <label for="work_unit">単位</label>
                                                        <input type="integer" id="work_unit" v-model="form.unit"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full mx-auto my-10">
                                            <button type="submit"
                                                class="w-1/2 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">更新する</button>
                                            <Link as="button" :href="route('workspecs.index', { application: application.id })" class="w-1/2 py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">戻る</Link>
                                        </div>
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
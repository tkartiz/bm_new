<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { VueElement } from 'vue';

defineProps({
    errors: Object,
    user: Object,
    application: Object,
})

const form = reactive({
    
})

const storeWorkspec = () => {
    Inertia.post('/workspecs', form)
}
</script>

<template>
    <Head title="制作情報入力" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">制作情報入力</h2>
        </template>

        <div class="py-3">
            <div class="container mx-auto">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-3 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <!-- 依頼者情報 -->
                            <div class="px-5 py-2 bg-white mb-5">
                                <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                    <p class="w-1/3">申請番号：{{ application.id }}</p>
                                    <p class="w-1/3">依頼者：{{ user.name }}</p>
                                    <p class="w-1/3">所属：{{ user.affiliation }}</p>
                                </div>
                            </div>

                            <!-- 申請内容 -->
                            <div class="p-3 flex flex-wrap bg-white">
                                <div class="p-2 w-2/6">
                                    <div class="relative">
                                        <label for="subject" class="leading-7 text-sm text-gray-600">品名</label>
                                        <div id="subject"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ application.subject }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 w-1/6"></div>
                                <div class="p-2 w-1/6">
                                    <div class="relative">
                                        <label for="desired_dlvd_at" class="leading-7 text-sm text-gray-600">希望納期</label>
                                        <div id="desired_dlvd_at"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ application.desired_dlvd_at }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 w-1/6">
                                    <div class="relative">
                                        <label for="works_quantity" class="leading-7 text-sm text-gray-600">依頼点数</label>
                                        <div id="works_quantity"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ application.works_quantity }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 w-1/6">
                                    <div class="relative">
                                        <label for="severity" class="leading-7 text-sm text-gray-600">緊急度</label>
                                        <div id="severity"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ application.severity }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 flex flex-wrap bg-white">
                                <div class="p-2 w-2/12 text-center">
                                    <p class="leading-7 lh-sm text-sm text-gray-600">見積金額（税抜）<br>￥**,***</p>
                                </div>
                                <div class="p-2 w-2/12 text-center">
                                    <p class="leading-7 lh-sm text-sm text-gray-600">見積金額（税込）<br>￥**,***</p>
                                </div>

                                <!-- 申請内容・内訳 -->
                                <div class="p-2 w-full -mb-4">内訳：</div>
                                <form @submit.prevent="storeWorkspec(user.id)">
                                    <div v-for="n in application.works_quantity" :key="n">
                                        <div class="p-2 w-full text-center">
                                            <div class="mb-5">
                                                <div class="w-full flex">
                                                    <div class="p-1 w-10">
                                                        <p class="w-full mt-8">{{ n }}</p>
                                                    </div>
                                                    <div class="p-1 w-2/12">
                                                        <div class="relative">
                                                            <label :for="'works'+ n +'_size'">サイズ</label>
                                                            <select :id="'works'+ n +'_size'" :v-model="'works'+ n +'_size'"
                                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                                <option value="">選択してください</option>
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
                                                            <label :for="'works'+ n +'_format'">出力形式</label>
                                                            <select :id="'works'+ n +'_format'" :v-model="'works'+ n +'_format'"
                                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                                <option value="">選択してください</option>
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
                                                            <label :for="'works'+ n +'_article'">品目</label>
                                                            <select :id="'works'+ n +'_article'" :v-model="'works'+ n +'_article'"
                                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                                <option value="">下記リストにあれば、選択してください</option>
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
                                                        <label :for="'works'+ n +'_content'">内容（品目にない場合に記載）</label>
                                                        <textarea :id="'works'+ n +'_content'" :name="'works'+ n +'_content'"
                                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-24 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea><br>
                                                        <div class="flex w-full">
                                                            <button
                                                                class="w-1/5 bg-red-500 hover:bg-red-700 text-white rounded-l-xl">削除</button>
                                                            <input type="file" :id="'works'+ n +'_file'" :name="'works'+ n +'_file'"
                                                                class="w-4/5">
                                                        </div>
                                                    </div>
                                                    <div class="p-1 w-1/12">
                                                        <div class="relative">
                                                            <label :for="'works'+ n +'_quantity'">数量</label>
                                                            <input type="integer" :id="'works'+ n +'_quantity'" :name="'works'+ n +'_quantity'"
                                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-7/12 mx-auto my-10">
                                        <button type="submit"
                                            class="w-3/5 mx-auto py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">制作物仕様を登録する</button>
                                        <Link as="button" :href="route('applications.show', { application: application.id })" class="w-2/5 mx-auto py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">戻る</Link>
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
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
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

const storeWork = () => {
    Inertia.post('/works', form)
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
                                <form @submit.prevent="storeWork(application.id)">

                                    <div class="w-7/12 mx-auto my-10">
                                        <button type="submit"
                                            class="w-full mx-auto py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-xl">制作情報を作成する</button>
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
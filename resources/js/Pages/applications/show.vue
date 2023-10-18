<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    application: Object,
    user: Object
})

const deleteApplication = id => {
    Inertia.delete(route('applications.destroy', { application: id }), {
        onBefore: () => confirm('本当に削除しますか？')
    });
}

const appliedApplication = id => {
    // sv-SEロケールはYYYY-MM-DD形式の日付文字列を戻すので使用する
    var today = new Date().toLocaleDateString("sv-SE");
    Inertia.get(route('applications.edit', {
        application: id,
        applied_at: today,
    }));
}
</script>

<template>
    <Head title="申請書内容" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">申請書内容</h2>
        </template>

        <div class="py-3">
            <div class="container mx-auto">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font relative">
                        <!-- 申請内容 -->
                        <div class="px-5 py-2 mb-5 bg-white">
                            <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                <p class="w-1/3">申請書番号：{{ application.id }}</p>
                                <p class="w-1/3">依頼者：{{ user.name }}</p>
                                <p class="w-1/3">所属：{{ user.affiliation }} </p>
                            </div>
                        </div>

                        <div class="p-3 mb-5 flex flex-wrap bg-white">
                            <div class="p-2 w-2/6">
                                <div class="relative">
                                    <label for="subject" class="leading-7 text-sm text-gray-600">品名</label>
                                    <div id="subject"
                                        class="w-full text-base outline-none text-gray-700 py-1 px-3 leading-8">
                                        {{ application.subject }}
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 w-1/6"></div>
                            <div class="p-2 w-1/6">
                                <div class="relative">
                                    <label for="desired_dlvd_at" class="leading-7 text-sm text-gray-600">希望納期</label>
                                    <div id="desired_dlvd_at"
                                        class="w-full text-base outline-none text-gray-700 py-1 px-3 leading-8">
                                        {{ application.desired_dlvd_at }}
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 w-1/6">
                                <div class="relative">
                                    <label for="works_quantity" class="leading-7 text-sm text-gray-600">依頼点数</label>
                                    <div id="works_quantity"
                                        class="w-full text-base outline-none text-gray-700 py-1 px-3 leading-8">
                                        {{ application.works_quantity }}
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 w-1/6">
                                <div class="relative">
                                    <label for="severity" class="leading-7 text-sm text-gray-600">緊急度</label>
                                    <div id="severity"
                                        class="w-full text-base outline-none text-gray-700 py-1 px-3 leading-8">
                                        {{ application.severity }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mx-auto">
                            <!-- <button @click="appliedApplication(application.id)"
                                class="w-1/5 py-2 text-white bg-green-500 border-0 focus:outline-none hover:bg-green-600 rounded-l-xl">
                                申請する</button> -->
                            <Link as="button" :href="route('applications.edit', { application: application.id })"
                                class="w-1/4 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                            編集する</Link>
                            <button @click="deleteApplication(application.id)"
                                class="w-1/4 py-2 text-white bg-red-500 border-0 focus:outline-none hover:bg-red-600">
                                削除する</button>
                            <Link as="button" :href="route('workspecs.index', { application: application.id })"
                                class="w-1/4 py-2 text-white bg-amber-500 border-0 focus:outline-none hover:bg-amber-600">
                            制作物一覧</Link>
                            <Link as="button" :href="route('applications.index')"
                                class="w-1/4 py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                            戻る</Link>
                        </div>
                    </section>
                </div>
            </div>
    </div>
</AuthenticatedLayout></template>
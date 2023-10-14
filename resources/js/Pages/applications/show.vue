<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    application: Object,
    user: Object
})

const deleteApplication = id => {
    Inertia.delete(route('applications.destroy', { application: id}), {
        onBefore: () => confirm('本当に削除しますか？')
    });
}
</script>

<template>
    <Head title="申請内容" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">申請内容</h2>
        </template>

        <div class="py-3">
            <div class="container mx-auto">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-3 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <!-- 申請内容 -->
                            <div class="px-5 py-2 bg-white mb-5">
                                <div class="p-2 w-full flex flex-wrap text-sm text-gray-600">
                                    <p class="w-1/3">申請番号：{{ application.id }}</p>
                                    <p class="w-1/3">依頼者：{{ user.name }}</p>
                                    <p class="w-1/3">所属：{{ user.affiliation }} </p>
                                </div>
                            </div>

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
                            <div class="w-full mx-auto my-10">
                                <Link as="button" :href="route('applications.edit', { application: application.id })" class="w-2/5 mx-auto py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                                編集する</Link>
                                <button @click="deleteApplication(application.id)" class="w-1/5 mx-auto py-2 text-white bg-red-500 border-0 focus:outline-none hover:bg-red-600">
                                削除する</button>
                                <Link as="button" :href="route('works.create', { application: application.id })" class="w-1/5 mx-auto py-2 text-white bg-amber-500 border-0 focus:outline-none hover:bg-amber-600">
                                制作物の入力</Link>
                                <Link as="button" :href="route('applications.index')" class="w-1/5 mx-auto py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                戻る</Link>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/CreatorAuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";

const props = defineProps({
    errors: Object,
    outsourcing: Object,
    user: Object,
})

const form = reactive({
    id: props.outsourcing.id,
    os_appd_id: props.outsourcing.os_appd_id,
    comp_name: props.outsourcing.comp_name,
    comp_price_exc: props.outsourcing.comp_price_exc,
    comp_price_incl: props.outsourcing.comp_price_incl,
    remarks: props.outsourcing.remarks,
    comp_file1: props.outsourcing.comp_file1,
    comp_file2: props.outsourcing.comp_file2,
    comp_file3: props.outsourcing.comp_file3,
})

const updateOutsourcing = (id) => {
    form.os_appd_id = document.getElementById("os_appd_id").value;
    Inertia.put(route('creator.outsourcings.update', { outsourcing: id }), form);
}

</script>

<template>
    <Head title="外注見積もり書編集" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">外注見積もり書編集</h2>
        </template>
        <div class="py-3">
            <div class="container mx-auto">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-3 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <BreezeValidationErrors :errors="errors" />
                            <form @submit.prevent="updateOutsourcing(form.id)">
                                <input id="os_appd_id" :value="form.os_appd_id" type="hidden">
                                <input id="user_roll" :value="user.roll" type="hidden">
                                <div class="p-3 bg-white">
                                    <div class="p-2 w-full flex">
                                        <label for="subject" class="w-40 leading-7 text-sm text-gray-600">競合先名</label>
                                        <input type="text" id="subject" v-model="form.comp_name"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    </div>
                                    <div class="p-2 w-full flex">
                                        <label for="comp_price_exc" class="w-40 leading-7 text-sm text-gray-600">金額（税抜）</label>
                                        <input type="text" id="comp_price_exc" v-model="form.comp_price_exc"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    </div>
                                    <div class="p-2 w-full flex">
                                        <label for="comp_price_incl" class="w-40 leading-7 text-sm text-gray-600">金額（税込）</label>
                                        <input type="text" id="comp_price_incl" v-model="form.comp_price_incl"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    </div>
                                    <div class="p-2 w-full flex">
                                        <label for="remarks" class="w-40 leading-7 text-sm text-gray-600">備考</label>
                                        <textarea id="remarks" v-model="form.remarks"
                                            class="w-full h-24 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                                    </div>
                                    <div class="p-2 w-full flex">
                                        <label for="comp_file1" class="w-40 leading-7 text-sm text-gray-600">見積もり１</label>
                                        <input id="comp_file1" type="file" @input="form.comp_file1 = $event.target.files[0]" class="w-4/5">
                                    </div>
                                    <div class="p-2 w-full flex">
                                        <label for="comp_file2" class="w-40 leading-7 text-sm text-gray-600">見積もり２</label>
                                        <input id="comp_file2" type="file" @input="form.comp_file2 = $event.target.files[0]" class="w-4/5">
                                    </div>
                                    <div class="p-2 w-full flex">
                                        <label for="comp_file3" class="w-40 leading-7 text-sm text-gray-600">見積もり３</label>
                                        <input id="comp_file3" type="file" @input="form.comp_file3 = $event.target.files[0]" class="w-4/5">
                                    </div>
                                </div>
                                <div class="w-full mx-auto my-10">
                                    <button type="submit"
                                        class="w-1/2 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl">
                                        更新する
                                    </button>
                                    <Link as="button" :href="route('creator.os_appds.edit', { os_appd: outsourcing.os_appd_id })"
                                        class="w-1/2 py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl">
                                    戻る</Link>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
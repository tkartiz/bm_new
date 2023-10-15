<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link} from "@inertiajs/vue3";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";

defineProps({
    errors: Object,
    user: Array,
});

const form = reactive({
    user_id: null,
    subject: null,
    works_quantity: null,
    severity: '',
    revision: null,
    applicated_at: null,
    desired_dlvd_at: null,
});

// sv-SEロケールはYYYY-MM-DD形式の日付文字列を戻すので使用する
var today = new Date().toLocaleDateString("sv-SE");

const storeApplication = () => {
    form.user_id = document.getElementById("user_id").value;
    form.revision = 0;
    Inertia.post("/applications", form);
};
</script>

<template>
    <Head title="新規申請" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                新規申請
            </h2>
        </template>

        <div class="py-3">
            <div class="container mx-auto">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-3 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <!-- 依頼者情報 -->
                            <div class="px-5 py-2 bg-white mb-5">
                                <div
                                    class="p-2 w-full flex flex-wrap text-sm text-gray-600"
                                >
                                    <p class="w-1/3">申請番号：</p>
                                    <p class="w-1/3">依頼者：{{ user.name }}</p>
                                    <p class="w-1/3">
                                        所属：{{ user.affiliation }}
                                    </p>
                                </div>
                            </div>

                            <!-- 申請内容 -->
                            <BreezeValidationErrors :errors="errors" />
                            <form @submit.prevent="storeApplication(user.id)">
                                <input
                                    type="integer"
                                    id="user_id"
                                    name="user_id"
                                    v-bind:value="user.id"
                                    class="hidden"
                                />
                                <div class="p-3 flex bg-white">
                                    <div class="p-2 w-2/6">
                                        <div class="relative">
                                            <label
                                                for="subject"
                                                class="leading-7 text-sm text-gray-600"
                                                >品名</label
                                            >
                                            <input
                                                type="text"
                                                id="subject"
                                                v-model="form.subject"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                            />
                                        </div>
                                    </div>
                                    <div class="p-2 w-1/6"></div>
                                    <div class="p-2 w-1/6">
                                        <div class="relative">
                                            <label
                                                for="desired_dlvd_at"
                                                class="leading-7 text-sm text-gray-600"
                                                >希望納期</label
                                            >
                                            <input
                                                type="date"
                                                id="desired_dlvd_at"
                                                v-model="form.desired_dlvd_at"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                            />
                                        </div>
                                    </div>
                                    <div class="p-2 w-1/6">
                                        <div class="relative">
                                            <label
                                                for="works_quantity"
                                                class="leading-7 text-sm text-gray-600"
                                                >依頼点数</label
                                            >
                                            <input
                                                type="integer"
                                                id="works_quantity"
                                                v-model="form.works_quantity"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                            />
                                        </div>
                                    </div>
                                    <div class="p-2 w-1/6">
                                        <div class="relative">
                                            <label
                                                for="severity"
                                                class="leading-7 text-sm text-gray-600"
                                                >緊急度</label
                                            >
                                            <select
                                                id="severity"
                                                v-model="form.severity"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                            >
                                                <option disabled value="">選択してください</option>
                                                <option value="通常">通常</option>
                                                <option value="急ぎ">急ぎ</option>
                                                <option value="超急ぎ">超急ぎ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-7/12 mx-auto my-10">
                                    <button
                                        type="submit"
                                        class="w-3/5 mx-auto py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded-l-xl"
                                    >
                                        申請書を作成する
                                    </button>
                                    <Link
                                        as="button"
                                        :href="route('applications.index')"
                                        class="w-2/5 mx-auto py-2 text-white bg-pink-500 border-0 focus:outline-none hover:bg-pink-600 rounded-r-xl"
                                    >
                                        戻る</Link
                                    >
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

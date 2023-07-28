<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout id="authenticatedLayout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Welcome back <span class="capitalize">{{ $page.props.auth.user.name.split(' ')[0] }}</span>!
            </h2>
            <div class="relative w-96">
                <TextInput
                    :search="true"
                    type="text"
                    v-model="searchInput"
                    @input="searchCompound"
                    class="block w-full"
                    placeholder="Search by compound or drug name"
                />
                <div v-if="search_results?.dictionary_terms?.compound?.length" class="top-full w-full mt-1 bg-gray-900 text-gray-800 border border-gray-700 dark:text-gray-400 max-h-64 overflow-y-auto absolute rounded-md overflow-y-auto">
                    <ul>
                        <li v-for="result in search_results?.dictionary_terms?.compound">
                            <button class="w-full text-left px-4 py-2 hover:text-white hover:bg-slate-800 active:bg-slate-700">
                                {{ result }}
                            </button>
                        </li>
                    </ul>
                    <div class="text-right px-4 py-2 text-sm text-gray-400">
                        {{ search_results.total }} results
                    </div>
                </div>
            </div>
        </template>

        <div class="flex flex-col gap-8 py-12">
            <div class="grid grid-cols-2 gap-8 w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 h-80 w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h6 class="font-semibold text-2xl text-gray-900 dark:text-gray-100 mb-4">Input Your Target</h6>
                    <form class="flex items-center gap-4">
                        <div class="grow">
                            <TextInput
                                id="smile"
                                type="text"
                                placeholder="Search a compound by SMILE"
                                class="block w-full"
                                v-model="textInput"
                                required
                            />
                        </div>
                        <div>
                            <PrimaryButton @click.prevent="convertTextToSMILESImage">Go</PrimaryButton>
                        </div>
                    </form>
                    <img
                        class="mx-auto mt-8 h-36 rounded-lg"
                        :src="smilesImage"
                        :alt="smilesImage + ' SMILE chemical image'"
                        v-if="smilesImage"
                    />
                </div>
                <div class="h-80 w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h6 class="font-semibold text-2xl p-6 text-gray-900 dark:text-gray-100">Recent Searches</h6>
                    <ul class="px-8">
                        <li class="group flex items-center gap-4 py-1" v-for="compound in recent_compounds.reverse()">
                            <img class="w-10 h-10 rounded-md" :src="compound.img_url" :alt="compound.smile + ' img url'">
                            <Link
                                :href="route('compound.show', compound)"
                                class="whitespace-nowrap underline-offset-4 hover:underline hover:text-gray-800 dark:hover:text-white text-gray-800 dark:text-gray-400 w-64 truncate overflow-hidden"
                            >
                                {{ compound.smile }}
                            </Link>
                            <span class="whitespace-nowrap text-gray-400">{{ DateTime.fromISO(compound.created_at).toFormat('D') }}</span>
                            <DangerButton class="hidden group-hover:block ml-auto" @click="deleteSmile(compound.smile)">Delete</DangerButton>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8 w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="h-80 w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h6 class="font-semibold text-2xl p-6 text-gray-900 dark:text-gray-100">Procedure History</h6>
                </div>
                <div class="h-80 w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h6 class="font-semibold text-2xl p-6 text-gray-900 dark:text-gray-100">Learning Resources</h6>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head, router} from '@inertiajs/vue3';
import {inject, ref} from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
// import TextInput from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/TextInput.vue";
import PrimaryButton from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {Link} from "@inertiajs/vue3";
import {DateTime} from 'luxon';
import _ from 'lodash';
import axios from "axios";


const props = defineProps(['search_results', 'recent_compounds'])

const textInput = ref('');
const searchInput = ref('');
const smilesImage = ref('');
const route = inject('route');
const api = inject('api');

function convertTextToSMILESImage() {
    router.post(route('store', textInput.value));
    smilesImage.value = `https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/smiles/${textInput.value}/PNG`
}

function deleteSmile(smile){
    router.delete(route('destroy', smile));
}

const searchCompound = async () => {
    let response = await axios.get('/search/show/'+searchInput.value);
    console.log('response.data', response.data);
};

</script>

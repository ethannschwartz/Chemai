<template>
    <AuthenticatedLayout>
        <section class="flex h-screen relative overflow-y-auto p-8 sm:p-16 md:p-32 flex items-start gap-8 max-w-7xl mx-auto">
            <div class="h-fit sticky top-0 shrink-0">
                <img
                    :src="compound.img_url"
                    :alt="'compound image of ' + compound.smile"
                    class="w-24 sm:w-36 md:w-48 lg:w-64 h-auto rounded-md"
                />
            </div>
            <div>
                <header class="mb-4">
                    <h1 class="font-semibold text-white text-3xl">Example Compound</h1>
                    <h2 class="text-gray-800 dark:text-gray-400">{{ compound.smile }}</h2>
                </header>
                <article class="text-gray-400">
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad aperiam architecto autem consequatur distinctio enim est et ex expedita inventore ipsum iusto laboriosam necessitatibus nobis, quasi quo rem sed sit tenetur totam unde vel vitae voluptas voluptatem. Adipisci fuga harum iste, saepe sint unde velit vero voluptate! Ab adipisci architecto at dolorem eos explicabo facere fugit hic id iusto labore laudantium maiores modi nemo nisi nobis numquam, obcaecati praesentium quas quia reiciendis sapiente sed sint veniam vero voluptate voluptatum. Alias aliquam aliquid cupiditate distinctio dolor dolorem dolores dolorum ea eos esse est eum ex impedit ipsum minima nulla, praesentium rerum tempora ut voluptas? Ad culpa cum cupiditate dignissimos ducimus expedita, hic ipsam, libero necessitatibus nulla perspiciatis quibusdam recusandae unde. Aliquid asperiores at beatae debitis ducimus, earum error eum facere incidunt iure labore maxime minima mollitia placeat quisquam, quo similique voluptatibus.</p>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad aperiam architecto autem consequatur distinctio enim est et ex expedita inventore ipsum iusto laboriosam necessitatibus nobis, quasi quo rem sed sit tenetur totam unde vel vitae voluptas voluptatem. Adipisci fuga harum iste, saepe sint unde velit vero voluptate! Ab adipisci architecto at dolorem eos explicabo facere fugit hic id iusto labore laudantium maiores modi nemo nisi nobis numquam, obcaecati praesentium quas quia reiciendis sapiente sed sint veniam vero voluptate voluptatum. Alias aliquam aliquid cupiditate distinctio dolor dolorem dolores dolorum ea eos esse est eum ex impedit ipsum minima nulla, praesentium rerum tempora ut voluptas? Ad culpa cum cupiditate dignissimos ducimus expedita, hic ipsam, libero necessitatibus nulla perspiciatis quibusdam recusandae unde. Aliquid asperiores at beatae debitis ducimus, earum error eum facere incidunt iure labore maxime minima mollitia placeat quisquam, quo similique voluptatibus.</p>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad aperiam architecto autem consequatur distinctio enim est et ex expedita inventore ipsum iusto laboriosam necessitatibus nobis, quasi quo rem sed sit tenetur totam unde vel vitae voluptas voluptatem. Adipisci fuga harum iste, saepe sint unde velit vero voluptate! Ab adipisci architecto at dolorem eos explicabo facere fugit hic id iusto labore laudantium maiores modi nemo nisi nobis numquam, obcaecati praesentium quas quia reiciendis sapiente sed sint veniam vero voluptate voluptatum. Alias aliquam aliquid cupiditate distinctio dolor dolorem dolores dolorum ea eos esse est eum ex impedit ipsum minima nulla, praesentium rerum tempora ut voluptas? Ad culpa cum cupiditate dignissimos ducimus expedita, hic ipsam, libero necessitatibus nulla perspiciatis quibusdam recusandae unde. Aliquid asperiores at beatae debitis ducimus, earum error eum facere incidunt iure labore maxime minima mollitia placeat quisquam, quo similique voluptatibus.</p>
                </article>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import {defineProps} from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps(['compound']);
</script>

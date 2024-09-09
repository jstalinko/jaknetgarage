<template>
    <div>
        <JustHead :Global="props.globals" :title="'Daftar Lomba Videografi'" />
        <Navbar
            :Categories="props.categories"
            :Settings="props.globals.settings"
        />
        <br /><br />
        <div
            class="mt-10 container max-w-7xl mx-auto min-h-screen bg-gray-100 rounded-lg px-8 py-5"
        >
            <h1 class="text-4xl text-center poppins-bold underline mt-10">
                Formulir Pendaftaran
            </h1>

            <div class="mt-10 max-w-3xl mx-auto">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                    Daftar Lomba Videografi
                </h2>
                <!-- Alert Success -->
                <div class="mb-6" v-if="showAlert">
                    <div
                        class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg"
                        role="alert"
                    >
                        <p class="font-bold">Pendaftaran berhasil!</p>
                        <p>
                            Terima kasih telah mendaftar di perlombaan Video Competition GTMotoMinds.
                        </p>
                    </div>
                </div>
                <form @submit.prevent="submitForm">
                    <div class="mb-6">
                        <label
                            for="nama"
                            class="block text-gray-700 font-semibold mb-2"
                            >Nama Lengkap</label
                        >
                        <input
                            type="text"
                            id="nama"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Masukan nama lengkap"
                            v-model="formData.nama"
                        />
                    </div>

                    <div class="mb-6">
                        <label
                            for="whatsapp"
                            class="block text-gray-700 font-semibold mb-2"
                            >No WhatsApp</label
                        >
                        <input
                            type="text"
                            id="whatsapp"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Masukan no WhatsApp"
                            v-model="formData.whatsapp"
                        />
                    </div>
                    <div class="mb-6">
                        <label
                            for="judul"
                            class="block text-gray-700 font-semibold mb-2"
                            >Instagram</label
                        >
                        <input
                            type="text"
                            id="judul"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Masukan instagram"
                            v-model="formData.instagram"
                        />
                    </div>

                    <div class="mb-6">
                        <label
                            for="pesan"
                            class="block text-gray-700 font-semibold mb-2"
                            >Alamat</label
                        >
                        <textarea
                            id="pesan"
                            rows="5"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Masukan alamat"
                            v-model="formData.alamat"
                        ></textarea>
                    </div>

                    <div class="text-center">
                        <button
                            type="submit"
                            class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                        >
                            Daftar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from "./Components/Navbar.vue";
import JustHead from "./Components/JustHead.vue";
import { ref } from "vue";

defineProps({ props: Object });

const showAlert = ref(false);
const formData = ref({
    nama: "",
    instagram: "",
    whatsapp: "",
    alamat: "",
});

async function submitForm() {
    // Simulasi pengiriman form

    const resp = await fetch("/api/register-event", {
        method: "POST",
        body: JSON.stringify(formData.value),
    }).then((res) => res.json());
    if(resp.success)
    {
    showAlert.value = true;
    setTimeout(() => window.location.reload() , 3000);
    }
    formData.value = {
        nama: "",
        instagram: "",
        whatsapp: "",
        alamat: "",
    };
}
</script>

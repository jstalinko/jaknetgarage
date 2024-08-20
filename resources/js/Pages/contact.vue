<template>
    <div>
        <JustHead :Global="props.globals" :title="'Hubungi Kami'" />
        <Navbar :Categories="props.categories" :Settings="props.globals.settings" />

        <div class="mt-10 container max-w-7xl mx-auto min-h-screen bg-gray-100 rounded-lg px-8 py-5">
            <h1 class="text-4xl text-center poppins-bold underline mt-10">Hubungi Kami</h1>

            <div class="mt-10 max-w-3xl mx-auto">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Formulir Pesan</h2>
                <!-- Alert Success -->
                <div class="mb-6" v-if="showAlert">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert">
                        <p class="font-bold">Pesan Terkirim!</p>
                        <p>Terima kasih telah menghubungi kami. Kami akan segera merespons pesan Anda.</p>
                    </div>
                </div>
                <form @submit.prevent="submitForm">
                    <div class="mb-6">
                        <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                        <input type="text" id="nama"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Masukkan nama lengkap" v-model="formData.nama" />
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" id="email"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Masukkan email" v-model="formData.email" />
                    </div>

                    <div class="mb-6">
                        <label for="whatsapp" class="block text-gray-700 font-semibold mb-2">No WhatsApp</label>
                        <input type="text" id="whatsapp"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Masukkan no WhatsApp" v-model="formData.whatsapp" />
                    </div>
                    <div class="mb-6">
                        <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul</label>
                        <input type="text" id="judul"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Masukkan Judul" v-model="formData.judul" />
                    </div>

                    <div class="mb-6">
                        <label for="pesan" class="block text-gray-700 font-semibold mb-2">Pesan</label>
                        <textarea id="pesan" rows="5"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Tulis pesan Anda" v-model="formData.pesan"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-red-500">Kirim</button>
                    </div>
                </form>

                <div class="mt-10 text-center">
                    <p class="text-gray-700 font-medium">Anda juga bisa menghubungi kami melalui sosial media kami</p>
                    <div class="flex flex-row justify-center mt-5 gap-5 mb-3">
                        <a target="_blank" v-for="(sos, index) in props.globals.settings.sosmed" :href="sos"
                            :key="index">
                            <span v-if="sos.includes('facebook')" class="bg-blue-500 text-white p-2 rounded">
                                <i class="mdi mdi-facebook"></i> Facebook
                            </span>
                            <span v-if="sos.includes('wa')" class="bg-green-500 text-white p-2 rounded">
                                <i class="mdi mdi-whatsapp"></i> Whatsapp
                            </span>
                            <span v-if="sos.includes('instagram')" class="bg-red-500 text-white p-2 rounded">
                                <i class="mdi mdi-instagram"></i> Instagram
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from './Components/Navbar.vue';
import JustHead from './Components/JustHead.vue';
import { ref } from 'vue';

defineProps({ props: Object });

const showAlert = ref(false);
const formData = ref({
    nama: '',
    email: '',
    whatsapp: '',
    pesan: '',
    judul: ''
});

async function submitForm() {
    // Simulasi pengiriman form
    showAlert.value = true;

    const resp = await fetch('/api/contact' , {
        method:'POST',
        body: JSON.stringify(formData.value)
    }).then(res => res.json());
    console.log(resp);
    // Reset form setelah pengiriman
    formData.value = {
        nama: '',
        email: '',
        whatsapp: '',
        pesan: '',
    };

}
</script>
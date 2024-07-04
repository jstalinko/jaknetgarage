<template>
  <section id="contact" class="py-12">
    <h2 class="text-3xl font-bold text-center mb-8">Kontak Kami</h2>
    <form @submit.prevent="submitForm" class="max-w-md mx-auto">
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium">Nama</label>
        <input type="text" id="name" v-model="form.name" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
      </div>
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium">Email</label>
        <input type="email" id="email" v-model="form.email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
      </div>
      <div class="mb-4">
        <label for="message" class="block text-sm font-medium">Pesan</label>
        <textarea id="message" v-model="form.message" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md"></textarea>
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim</button>
    </form>
  </section>
</template>

<script>
export default {
  name: 'ContactSection',
  data() {
    return {
      form: {
        name: '',
        email: '',
        message: ''
      }
    };
  },
  methods: {
    submitForm() {
      alert('Pesan terkirim! Kami akan segera menghubungi Anda.');
      this.form = { name: '', email: '', message: '' };
    }
  }
};
</script>

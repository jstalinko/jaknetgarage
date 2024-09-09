<template>
  <div class="flex flex-col h-screen">
    <!-- Header -->
    <header class="bg-red-500 text-white p-4 flex justify-between items-center">
      <!-- Date, Time, and App Name on the right -->
      <div class="px-2 py-2">
        <h1 class="text-xl font-bold">GTMOTOMINDS CASHIER</h1>
        <div class="text-sm">
          {{ currentDateTime }} ({{ currentTimezone }})
        </div>
      </div>
    </header>

    <!-- Main Content: Transaction List and Payment Details -->
    <div class="flex flex-grow flex-col md:flex-row">
      <!-- Left Section: Transaction List and Product Input -->
      <div class="w-full md:w-2/3 bg-gray-100 p-6">
        <h2 class="text-xl font-semibold mb-4">Transaction</h2>

        <!-- Product Code Input -->
        <div class="mb-4">
          <input
            v-model="productCode"
            @keydown.enter="addProduct"
            type="text"
            placeholder="Kode Produk / Nama Produk"
            class="w-full px-4 py-2 border rounded"
          />
        </div>

        <!-- Transaction List Table -->
        <div class="overflow-x-auto mb-4">
          <table class="min-w-full bg-white rounded shadow">
            <thead>
              <tr class="bg-gray-200 text-left">
                <th class="py-2 px-4">Product</th>
                <th class="py-2 px-4">Price</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in transactionList" :key="item.id" class="border-t">
                <td class="py-2 px-4">{{ item.name }}</td>
                <td class="py-2 px-4">{{ item.price | currency }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Discount Input -->
        <div class="mb-4">
          <label for="discount" class="block text-sm font-medium text-gray-700">Discount</label>
          <div class="flex space-x-2">
            <input
              v-model.number="discount"
              type="number"
              id="discount"
              placeholder="Enter discount amount"
              class="w-full px-4 py-2 border rounded"
            />
            <select v-model="discountType" class="px-4 py-2 border rounded">
              <option value="nominal">Nominal</option>
              <option value="percent">Percent</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Right Section: Total, Payment, Subtotal -->
      <div class="w-full md:w-1/3 bg-white p-6">
        <h2 class="text-xl font-semibold mb-4">Payment Details</h2>

        <div class="space-y-4">
          <div class="flex justify-between">
            <span>Subtotal</span>
            <span>{{ subtotal | currency }}</span>
          </div>

          <div class="flex justify-between">
            <span>Discount ({{ discountType }})</span>
            <span>{{ calculatedDiscount | currency }}</span>
          </div>

          <div class="flex justify-between text-lg font-semibold">
            <span>Total</span>
            <span>{{ total | currency }}</span>
          </div>
        </div>

        <!-- Payment Method Options -->
        <div class="mt-8">
          <h3 class="text-lg font-semibold mb-2">Payment Method</h3>
          <div class="space-y-2">
            <label class="flex items-center">
              <input type="radio" v-model="paymentMethod" value="QRIS" class="mr-2" />
              QRIS
            </label>
            <label class="flex items-center">
              <input type="radio" v-model="paymentMethod" value="Cash" class="mr-2" />
              Cash
            </label>
            <label class="flex items-center">
              <input type="radio" v-model="paymentMethod" value="Transfer" class="mr-2" />
              Transfer
            </label>
          </div>
        </div>

        <!-- Payment Button -->
        <div class="mt-8">
          <button @click="processPayment" class="w-full px-4 py-2 bg-green-500 text-white rounded shadow">
            Proceed to Payment
          </button>
        </div>
      </div>
    </div>

    <!-- Footer: Cashier Name -->
    <footer class="bg-gray-200 text-center md:text-right p-4">
      <span class="text-gray-600">Cashier: {{ cashierName }}</span>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

// Transaction list and logic
const transactionList = ref([
  { id: 1, name: 'Product 1', price: 10000 },
  { id: 2, name: 'Product 2', price: 15000 },
]);

const productCode = ref('');
const subtotal = computed(() => transactionList.value.reduce((acc, item) => acc + item.price, 0));
const discount = ref(0); // Editable discount amount
const discountType = ref('nominal'); // 'percent' or 'nominal'

// Payment method
const paymentMethod = ref('QRIS'); // Default to QRIS

// Calculate the discount amount based on the selected type
const calculatedDiscount = computed(() => {
  if (discountType.value === 'percent') {
    return (subtotal.value * discount.value) / 100; // Percent discount
  } else {
    return discount.value; // Nominal discount
  }
});

// Calculate the total after applying the discount
const total = computed(() => subtotal.value - calculatedDiscount.value);

const addProduct = () => {
  if (productCode.value) {
    transactionList.value.push({
      id: transactionList.value.length + 1,
      name: `Product ${transactionList.value.length + 1}`,
      price: Math.floor(Math.random() * 10000 + 5000),
    });
    productCode.value = '';
  }
};

const processPayment = () => {
  alert(`Payment method: ${paymentMethod.value}\nPayment processed!`);
};

// Date and time logic
const currentDateTime = ref('');
const currentTimezone = ref('');

const updateDateTime = () => {
  const now = new Date();
  currentDateTime.value = now.toLocaleString('en-GB', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: false, // Use 24-hour format
  });
  currentTimezone.value = Intl.DateTimeFormat().resolvedOptions().timeZone;
};

onMounted(() => {
  updateDateTime();
  setInterval(updateDateTime, 1000); // Update time every second
});

// Cashier name
const cashierName = ref('username'); // Cashier name
</script>

<style scoped>
/* Add your custom styles here */
</style>

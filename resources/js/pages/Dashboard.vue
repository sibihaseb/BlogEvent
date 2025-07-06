<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 p-4 rounded-xl">
      <div class="grid gap-4 md:grid-cols-4">
        <!-- Cards -->
        <div class="flex items-center p-6 bg-white shadow-lg rounded-xl">
          <div
            class="inline-flex items-center justify-center h-16 w-16 bg-secondary rounded-full mr-6"
          >
            <Users :size="28" color="black" />
          </div>
          <div>
            <span class="block text-2xl font-bold">{{ props.users }}</span>
            <span class="block text-gray-500">Users</span>
          </div>
        </div>

        <div class="flex items-center p-6 bg-white shadow-lg rounded-xl">
          <div
            class="inline-flex items-center justify-center h-16 w-16 bg-sky-500 rounded-full mr-6"
          >
            <CalendarDays :size="28" />
          </div>
          <div>
            <span class="block text-2xl font-bold">{{ props.events }}</span>
            <span class="block text-gray-500">Events</span>
          </div>
        </div>

        <div class="flex items-center p-6 bg-white shadow-lg rounded-xl">
          <div
            class="inline-flex items-center justify-center h-16 w-16 bg-orange-300 rounded-full mr-6"
          >
            <Rss :size="28" color="black" />
          </div>
          <div>
            <span class="block text-2xl font-bold">{{ props.blogs }}</span>
            <span class="block text-gray-500">Blogs</span>
          </div>
        </div>

        <div class="flex items-center p-6 bg-white shadow-lg rounded-xl">
          <div
            class="inline-flex items-center justify-center h-16 w-16 bg-yellow-500 rounded-full mr-6"
          >
            <Building2 :size="28" />
          </div>
          <div>
            <span class="block text-2xl font-bold">{{ props.ministries }}</span>
            <span class="block text-gray-500">Ministries</span>
          </div>
        </div>

        <div class="flex items-center p-6 bg-white shadow-lg rounded-xl">
          <div
            class="inline-flex items-center justify-center h-16 w-16 bg-lime-500 rounded-full mr-6"
          >
            <Users :size="28" />
          </div>
          <div>
            <span class="block text-2xl font-bold">{{ props.churchmembers }}</span>
            <span class="block text-gray-500">Church Members</span>
          </div>
        </div>

        <div class="flex items-center p-6 bg-white shadow-lg rounded-xl">
          <div
            class="inline-flex items-center justify-center h-16 w-16 bg-cyan-300 rounded-full mr-6"
          >
            <HandHelping :size="28" />
          </div>
          <div>
            <span class="block text-2xl font-bold">{{ props.prayers }}</span>
            <span class="block text-gray-500">Prayer Requests</span>
          </div>
        </div>

        <div class="flex items-center p-6 bg-white shadow-lg rounded-xl">
          <div
            class="inline-flex items-center justify-center h-16 w-16 bg-emerald-200 rounded-full mr-6"
          >
            <Mail :size="28" />
          </div>
          <div>
            <span class="block text-2xl font-bold">{{ props.contactquery }}</span>
            <span class="block text-gray-500">Contact Queries</span>
          </div>
        </div>

        <div class="flex items-center p-6 bg-white shadow-lg rounded-xl">
          <div
            class="inline-flex items-center justify-center h-16 w-16 bg-teal-100 rounded-full mr-6"
          >
            <Users :size="28" />
          </div>
          <div>
            <span class="block text-2xl font-bold">{{ props.subscribers }}</span>
            <span class="block text-gray-500">Subscribers</span>
          </div>
        </div>
      </div>

      <!-- Full Width Section -->
      <div class="relative min-h-[100vh] flex-1 rounded-xl md:min-h-min mt-8">
        <h1 class="text-2xl font-bold text-center">Overall Analytics</h1>
        <ClientOnly>
          <VueApexCharts
            type="bar"
            height="350"
            :options="chartOptions"
            :series="series"
            class="bg-white rounded-xl shadow-lg p-4"
          />
        </ClientOnly>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
// import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { Users, CalendarDays, Rss, Building2, HandHelping, Mail } from 'lucide-vue-next';
import VueApexCharts from 'vue3-apexcharts';

const props = defineProps<{
  users: number;
  events: number;
  blogs: number;
  ministries: number;
  churchmembers: number;
  prayers: number;
  contactquery: number;
  subscribers: number;
}>();

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Dashboard',
    href: '/dashboard',
  },
];

// Chart Options
const chartOptions = {
  chart: {
    type: 'bar',
    height: 350,
    toolbar: { show: false },
  },
  plotOptions: {
    bar: {
      distributed: true,
      borderRadius: 6,
      horizontal: false,
      columnWidth: '25%',
    },
  },
  dataLabels: {
    enabled: false,
  },
  xaxis: {
    categories: [
      'Users',
      'Events',
      'Blogs',
      'Ministries',
      'Church Members',
      'Prayers',
      'Contact Queries',
      'Subscribers',
    ],
  },
  colors: [
    '#0ea5e9',
    '#f97316',
    '#22c55e',
    '#eab308',
    '#06b6d4',
    '#a78bfa',
    '#f87171',
    '#10b981',
  ],
};

// Chart Series
const series = [
  {
    name: 'Count',
    data: [
      props.users,
      props.events,
      props.blogs,
      props.ministries,
      props.churchmembers,
      props.prayers,
      props.contactquery,
      props.subscribers,
    ],
  },
];
</script>

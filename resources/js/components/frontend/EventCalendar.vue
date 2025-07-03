<template>
  <section id="calendar" class="py-16">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-primary mb-2">Church Calendar</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          Stay updated with all our upcoming events and activities
        </p>
      </div>
      <div class="bg-gray-50 p-6 rounded-lg mb-6">
        <FullCalendar :options="calendarOptions" />
      </div>
      <div class="bg-gray-50 p-6 rounded-lg">
        <h3 class="text-xl font-semibold mb-4">Recurring Events</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <div class="flex items-center space-x-3">
            <div class="w-4 h-4 bg-gray-500 rounded-full"></div>
            <span>Sabbath Service (Every Saturday)</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-4 h-4 bg-gray-500 rounded-full"></div>
            <span>Prayer Meeting (Every Wednesday)</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-4 h-4 bg-gray-500 rounded-full"></div>
            <span>Youth Night (Every Friday)</span>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-4 h-4 bg-gray-500 rounded-full"></div>
            <span>Community Service (Monthly)</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import rrulePlugin from "@fullcalendar/rrule";

// Define ChurchEvent interface based on provided data
interface ChurchEvent {
  id: number;
  picture: string;
  name: string;
  short_description: string;
  description: string;
  start_time: string;
  end_time: string;
  location: string;
  type: string;
  created_at: string;
  updated_at: string;
}

// Define props
const props = defineProps<{
  churchevents: ChurchEvent[];
}>();

// Cache colors by event type for consistency
const colorCache = new Map<string, string>();

// Generate random hex color
const generateRandomHexColor = (type: string): string => {
  if (!colorCache.has(type)) {
    const color =
      "#" +
      Math.floor(Math.random() * 16777215)
        .toString(16)
        .padStart(6, "0");
    colorCache.set(type, color);
  }
  return colorCache.get(type)!;
};

// Map churchevents to FullCalendar event format with recurrence
const calendarEvents = ref(
  props.churchevents.map((event) => {
    const color = generateRandomHexColor(event.type);
    const baseEvent = {
      id: event.id.toString(),
      title: event.name,
      backgroundColor: color,
      borderColor: color,
      extendedProps: {
        description: event.short_description,
        fullDescription: event.description,
        location: event.location,
        picture: event.picture,
        type: event.type,
      },
    };

    // Define recurrence until July 31, 2026
    const untilDate = "2026-07-31T23:59:59";

    // Add recurrence or multi-day event based on type
    switch (event.type) {
      case "weekly":
        return {
          ...baseEvent,
          rrule: {
            freq: "weekly",
            byweekday: event.name.toLowerCase().includes("sabbath") ? ["sa"] : ["we"],
            dtstart: event.start_time,
            until: untilDate,
          },
          duration: "02:00", // 2-hour duration for weekly events
        };
      case "youth":
        return {
          ...baseEvent,
          rrule: {
            freq: "weekly",
            byweekday: ["fr"],
            dtstart: event.start_time,
            until: untilDate,
          },
          duration: "03:00", // 3-hour duration for Youth Night
        };
      case "monthly":
      case "recurring":
        return {
          ...baseEvent,
          rrule: {
            freq: "monthly",
            bymonthday: new Date(event.start_time).getDate(),
            dtstart: event.start_time,
            until: untilDate,
          },
          duration: "03:00", // 3-hour duration for monthly/recurring events
        };
      case "one_day":
      default:
        // Adjust end_time to be inclusive (add 1 day)
        const endDate = new Date(event.end_time);
        endDate.setDate(endDate.getDate() + 1); // Make end date inclusive
        return {
          ...baseEvent,
          start: event.start_time,
          end: endDate.toISOString(),
          allDay: true, // Render as all-day event to span full days
        };
    }
  })
);

// FullCalendar options
const calendarOptions = ref({
  plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin, rrulePlugin],
  initialView: "dayGridMonth",
  events: calendarEvents.value,
  eventClick: (info: any) => {
    // Redirect to event details page using Inertia
    if (info.event.id) {
      router.get(`/church-event/${info.event.id}`);
    }
  },
  eventMouseEnter: (info: any) => {
    // Add tooltip with short_description
    const el = info.el;
    const description = info.event.extendedProps.description;
    if (description) {
      el.setAttribute("title", description); // Native HTML tooltip
    }
  },
  eventMouseLeave: (info: any) => {
    // Remove tooltip when mouse leaves
    info.el.removeAttribute("title");
  },
  headerToolbar: {
    left: "prev,next today",
    center: "title",
    right: "dayGridMonth,timeGridWeek,timeGridDay",
  },
  height: "auto",
  validRange: {
    start: "2025-07-01",
    end: "2026-08-01", // Ensure events render up to July 2026
  },
});
</script>

<style scoped></style>

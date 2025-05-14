<template>
  <Head title="Welcome"> </Head>
  <FrontendLayout>
    <HeroSection />
    <HaitianHeritage />
    <QuickAccessGrid />
    <UpcomingEvents />
    <EventCalendar />
    <Ministry />
    <AboutUs />
    <Blog />
    <Contact />
  </FrontendLayout>
</template>

<script setup lang="ts">
import { onMounted } from "vue";
import { Head } from "@inertiajs/vue3";
import FrontendLayout from "@/layouts/FrontendLayout.vue";
import HeroSection from "@/components/frontend/HeroSection.vue";
import HaitianHeritage from "@/components/frontend/HaitianHeritage.vue";
import QuickAccessGrid from "@/components/frontend/QuickAccessGrid.vue";
import UpcomingEvents from "@/components/frontend/UpcomingEvents.vue";
import EventCalendar from "@/components/frontend/EventCalendar.vue";
import Ministry from "@/components/frontend/Ministry.vue";
import AboutUs from "@/components/frontend/AboutUs.vue";
import Blog from "@/components/frontend/Blog.vue";
import Contact from "@/components/frontend/Contact.vue";

onMounted(() => {
  // Toggle mobile menu
  const menuButton = document.querySelector(".lg\\:hidden");
  if (menuButton) {
    menuButton.addEventListener("click", () => {
      // Mobile menu functionality would go here
      console.log("Mobile menu toggled");
    });
  }

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = (e.currentTarget as HTMLAnchorElement).getAttribute("href");
      if (targetId === "#") return;
      const targetElement = document.querySelector(targetId!);
      if (targetElement) {
        window.scrollTo({
          top: targetElement.getBoundingClientRect().top + window.pageYOffset - 80,
          behavior: "smooth",
        });
      }
    });
  });
});
</script>

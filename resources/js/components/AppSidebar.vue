<script setup lang="ts">
// import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, LayoutGrid, Users, Mail, CalendarDays, Rss, Building2, HandHelping, Globe, Bell } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
  {
    title: 'Dashboard',
    href: '/dashboard',
    icon: LayoutGrid,
  },
  {
    title: 'User Management',
    href: '/users',
    icon: Users,
  },
  {
    title: 'Event Management',
    href: '/churchevents',
    icon: CalendarDays,
  },
  {
    title: 'Blogs',
    href: route('blogs.index'),
    icon: Rss,
  },
  {
    title: 'Ministries',
    href: route('ministries.index'),
    icon: Building2,
  },
  {
    title: 'Church members',
    href: '/staffs',
    icon: Users,
  },
  {
    title: 'Prayer requests',
    href: '/prayers',
    icon: HandHelping,
  },
  {
    title: 'Contact Us',
    href: '/contactus',
    icon: Mail,
  },
  {
    title: 'Frequently Questions',
    href: route('frequently-questions.index'),
    icon: BookOpen,
  },
  {
    title: 'About Us Page',
    href: route('website.aboutus'),
    icon: Globe,
  },
  {
    title: 'Contact Us Page',
    href: route('website.contactus'),
    icon: Globe,
  },
  {
    title: 'Home Page',
    href: route('website.home'),
    icon: Globe,
  },
  {
    title: 'Ministry Page',
    href: route('website.ministries'),
    icon: Globe,
  },
  {
    title: 'Event Page',
    href: route('website.event'),
    icon: Globe,
  },
  {
    title: 'Blog Page',
    href: route('website.blog'),
    icon: Globe,
  },
  {
    title: 'Prayer Request Page',
    href: route('website.prayer'),
    icon: Globe,
  },
  {
    title: 'Notifications',
    href: route('notify.settings'),
    icon: Bell,
  },
  {
    title: 'Subscriber',
    href: route('subscriber.index'),
    icon: Users,
  },
];

// const footerNavItems: NavItem[] = [
//   {
//     title: 'Github Repo',
//     href: 'https://github.com/laravel/vue-starter-kit',
//     icon: Folder,
//   },
//   {
//     title: 'Documentation',
//     href: 'https://laravel.com/docs/starter-kits#vue',
//     icon: BookOpen,
//   },
// ];
</script>

<template>
  <Sidebar collapsible="icon" variant="inset">
    <SidebarHeader>
      <SidebarMenu>
        <SidebarMenuItem>
          <SidebarMenuButton size="lg" as-child>
            <Link :href="route('dashboard')">
              <AppLogo />
            </Link>
          </SidebarMenuButton>
        </SidebarMenuItem>
      </SidebarMenu>
    </SidebarHeader>

    <SidebarContent>
      <NavMain :items="mainNavItems" />
    </SidebarContent>

    <SidebarFooter>
      <!-- <NavFooter :items="footerNavItems" /> -->
      <NavUser />
    </SidebarFooter>
  </Sidebar>
  <slot />
</template>

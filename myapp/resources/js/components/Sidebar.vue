<template>
  <div class="sidebar">
    <!-- Header / Logo -->
    <div class="sidebar-header">

      <img class="book" src="C:\Users\Ahsan\Desktop\Vue-Laravel-SMS\myapp\resources\css\book.png" alt="Book" />
      
      <h2>SMS</h2>
    </div>

    <!-- Navigation Links -->
    <ul class="sidebar-menu">
      <li v-for="tab in tabs" :key="tab.name" :class="{ active: activeTab === tab.name }"
        @click="setActiveTab(tab.name)">
        <router-link :to="tab.path" class="block w-full">
          {{ tab.label }}
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Sidebar",
  data() {
    return {
      tabs: [
        { label: "Students", path: "/students", name: "Students" },
        { label: "Teachers", path: "/teachers", name: "Teachers" },
        { label: "Courses", path: "/courses", name: "Courses" },
        { label: "Batches", path: "/batches", name: "Batches" },
        { label: "Enrollments", path: "/enrollments", name: "Enrollments" },
        { label: "Payments", path: "/payments", name: "Payments" },
      ],
      activeTab: null,
    };
  },
  mounted() {
    // Set active tab based on current route
    const currentPath = this.$route.path;
    const currentTab = this.tabs.find(tab => tab.path === currentPath);
    if (currentTab) this.activeTab = currentTab.name;
  },
  watch: {
    // Watch route changes to update active tab automatically
    $route(to) {
      const currentTab = this.tabs.find(tab => tab.path === to.path);
      this.activeTab = currentTab ? currentTab.name : null;
    }
  },
  methods: {
    setActiveTab(name) {
      this.activeTab = name;
    }
  }
};
</script>

<style scoped>
/* Sidebar container */
</style>

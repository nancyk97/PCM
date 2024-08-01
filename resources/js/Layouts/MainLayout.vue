<template>
    <div id="main-layout" class="container-fluid">
      <header class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Header content goes here -->
        <nav class="navbar-nav mr-auto">
          <!-- Navigation links go here -->
        </nav>
      </header>
  
      <main class="py-4">
        <!-- Use slots to inject page-specific content -->
        <slot></slot>
      </main>
  
      <footer class="text-center py-4">
        <!-- Footer content goes here -->
      </footer>
    </div>
  </template>
  
  <script>
  export default {
    name: 'MainLayout',
    // Component logic goes here
  };
  </script>
<!-- src/components/Layout.svelte -->
<script>
    import Header from './Header.svelte';
    import Footer from './Footer.svelte';
  </script>
  
  <div class="min-h-screen flex flex-col">
    <!-- Header -->
    <Header />
  
    <!-- Main content slot -->
    <main class="flex-1 bg-gray-50 p-6">
      <slot />
    </main>
  
    <!-- Footer -->
    <Footer />
  </div>
  
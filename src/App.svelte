<script>
  import Layout from './components/Layout.svelte';

  let graduate = false;
  let employer = false;
  let chosen = false;

  function handleGraduate() {
    chosen = true;
    graduate = true;
    employer = false;
  }

  function handleEmployer() {
    chosen = true;
    employer = true;
    graduate = false;
  }

  $: console.log(graduate, employer);
</script>

<Layout>
  {#if !chosen}
    <div class="container mx-auto p-6">
      <div id="page" class="flex  justify-center items-center space-x-4">
          <button on:click={handleGraduate} class="w-50 h-50 bg-blue-300 rounded-md flex justify-center items-center hover:scale-105 transition-transform duration-500">
            Graduate
          </button>
          <button on:click={handleEmployer} class="w-50 h-50 bg-yellow-300 rounded-md flex justify-center items-center hover:scale-105 transition-transform duration-500">
            Employer
          </button>
      </div>
    </div>
  {/if}
  {#if graduate}
    <div id="grad" class="min-w-full rounded-lg bg-blue-50 border-4 border-solid border-blue-300"></div>
  {/if}
  {#if employer}
    <div id="employer" class="min-w-full rounded-lg bg-yellow-50 border-4 border-solid border-yellow-300"></div>
  {/if}
</Layout>

<style>
  #page {
    min-height: 70vh;
  }

  #grad, #employer {
    min-height: 83vh;
  }
</style>

<script>
    let count = 0;
  
    function increment() {
      count += 1;
    }
  </script>
  
  <button class="px-4 py-2 bg-blue-500 text-white rounded" on:click={increment}>
    count is {count}
  </button>
  
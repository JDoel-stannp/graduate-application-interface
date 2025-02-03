<script>
    export let login = false;
    export let registerClicked = false;

</script>

<div class="w-100 h-60 bg-yellow-50 border-2 border-solid border-gray-300 rounded-md m-10 flex flex-col justify-center items-center">
    <input type="text" placeholder="Username" class="w-50 h-10 m-1 p-2 bg-white border-2 border-solid border-gray-300 rounded-md">
    <input type="text" placeholder="Password" class="w-50 h-10 m-1 p-2 bg-white border-2 border-solid border-gray-300 rounded-md">
    <button on:click={() => login = true} class="w-50 h-10 m-2 p-2 bg-blue-300 rounded-md flex justify-center items-center hover:scale-105 transition-transform duration-500">
      Login
    </button>
    <button class="underline text-blue-500" on:click={() => registerClicked = true}>
      No account? Register here.
    </button>
  </div>
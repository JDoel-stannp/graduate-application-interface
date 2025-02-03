<script>
  import Layout from './components/Layout.svelte';

let graduate = false;
let employer = false;
let chosen = false;
let login = true;
let registerClicked = true;
let password = "";
let confirmPassword = "";

let passwordValid = false;
let passwordMatch = false;

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

function handleRegister() {
  // Password validation
  passwordValid = password.length >= 12 && /[!?&]/.test(password);
  passwordMatch = password === confirmPassword;

  if(passwordValid && passwordMatch) {
    console.log("Registration Successful!");
    // Continue with registration logic (e.g., API call)
  }
}

$: console.log(graduate, employer, passwordValid, passwordMatch);
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
    <div id="grad" class="min-w-full rounded-lg bg-blue-50 border-4 border-solid border-blue-300 flex">
      {#if login} 
        <p></p>

      {:else}
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
      {/if}
      {#if registerClicked}
      <div class="w-100 h-60 bg-purple-50 border-2 border-solid border-gray-300 rounded-md m-10 flex flex-col justify-center items-center">
        <input type="text" placeholder="Username" class="w-50 h-10 m-1 p-2 bg-white border-2 border-solid border-gray-300 rounded-md">
        
        <!-- Password Input with Tooltip -->
        <div class="relative">
          <input
            type="password"
            placeholder="Password"
            bind:value={password}
            class="w-50 h-10 m-1 p-2 bg-white border-2 border-solid border-gray-300 rounded-md"
          />
          <div
            class="absolute left-0 w-full p-2 mt-2 text-sm text-white bg-gray-800 rounded-lg shadow-lg opacity-0 transition-opacity duration-200 group-hover:opacity-100"
          >
            <p class={passwordValid ? "text-green-400" : "text-red-400"}>
              ✔️ At least 12 characters
            </p>
            <p class={passwordValid && /[!?&]/.test(password) ? "text-green-400" : "text-red-400"}>
              ✔️ Includes !, ?, or &
            </p>
          </div>
        </div>

        <input
          type="password"
          placeholder="Confirm Password"
          bind:value={confirmPassword}
          class="w-50 h-10 m-1 p-2 bg-white border-2 border-solid border-gray-300 rounded-md"
        />
        <!-- Registration Button -->
        <button
        on:click={handleRegister}
        class="w-50 h-10 m-2 p-2 bg-yellow-300 rounded-md flex justify-center items-center hover:scale-105 transition-transform duration-500"
        disabled={!passwordValid || !passwordMatch}
      >
        Register
      </button>
    </div>
      {/if}
    </div>
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

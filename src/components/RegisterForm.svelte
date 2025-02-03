<script>

let password = "";
let confirmPassword = "";

let passwordValid = false;
let passwordMatch = false;

function handleRegister() {
  // Password validation
  passwordValid = password.length >= 12 && /[!?&]/.test(password);
  passwordMatch = password === confirmPassword;

  if(passwordValid && passwordMatch) {
    console.log("Registration Successful!");
    // Continue with registration logic (e.g., API call)
  }
}

</script>

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
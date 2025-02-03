<script>
  import Layout from './components/Layout.svelte';

  let graduate = false;
  let employer = false;
  let chosen = false;
  let showPopup = false;
  let selectedJob = "";
  let uploadedFile = null;
  let graduates = [];
  let selectedGraduate = null;
  let updatedFirstName = "";
  let updatedLastName = "";
  let updatedPostcode = "";

  const jobOptions = ["Software Engineer/Developer", "Data Analyst", "Project Manager", "IT Support", "HR Specialist", "Marketing Manager","Operations Manager", "Operations Lead", "Supply Chain Lead", "Customer Service", "Legal Counsel", "Graphic Designer"];

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

  function confirmEventAttendance() {
    showPopup = true;
  }

  function handleResponse(response) {
  if (response) {
    alert("You have confirmed your attendance!");
  }
  showPopup = false;
  graduate = true;
  employer = false; 
}


  function handleFileUpload(event) {``
    uploadedFile = event.target.files[0];
  }

  function confirmSubmission() {
    if (selectedJob && uploadedFile) {
      showPopup = true;
    } else {
      alert("Please select a job and upload your application before submitting.");
    }
  }

  function handleApplicationResponse(response) {
    if (response) {
      alert(`Application submitted for: ${selectedJob}`);
      // API call or additional logic can go here
    }
    showPopup = false;
  }

// Fetch graduates from PHP API
async function fetchGraduates() {
  const res = await fetch("http://localhost/graduates_api.php");
  graduates = await res.json();
}

// Select a graduate to edit
function selectGraduate(grad) {
  selectedGraduate = { ...grad };
  updatedFirstName = grad.first_name;
  updatedLastName = grad.last_name;
  updatedPostcode = grad.postcode;
}

// Update graduate details in database
async function updateGraduate() {
  if (!selectedGraduate) return;

  const res = await fetch("http://localhost/graduates_api.php", {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      id: selectedGraduate.id,
      first_name: updatedFirstName,
      last_name: updatedLastName,
      postcode: updatedPostcode,
    }),
  });

  const data = await res.json();
  if (data.success) {
    alert("Details updated successfully!");
    fetchGraduates();
    selectedGraduate = null; // Close edit mode
  }
}

// Delete a graduate
async function deleteGraduate(id) {
  if (!confirm("Are you sure you want to delete this graduate?")) return;

  const res = await fetch("http://localhost/graduates_api.php", {
    method: "DELETE",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id }),
  });

  const data = await res.json();
  if (data.success) {
    alert("Graduate deleted!");
    fetchGraduates();
  }
}

// Load data on mount
fetchGraduates();

</script>

<Layout>
  {#if !chosen}
    <div id="page" class="container mx-auto p-6 flex justify-center items-center h-screen">
      <div class="flex space-x-4">
        <button on:click={handleGraduate} class="w-50 h-50 px-6 py-3 bg-blue-400 text-white rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
          Graduate
        </button>
        <button on:click={handleEmployer} class="w-50 h-50 px-6 py-3 bg-yellow-400 text-white rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
          Employer
        </button>
      </div>
    </div>
  {/if}

  {#if graduate}
    <div id="grad" class="w-full p-6 bg-blue-50 border-4 border-blue-300 rounded-lg text-end space-y-4">
      <button on:click={confirmEventAttendance} class="px-6 py-3 bg-yellow-400 text-white rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
        I attended an event
      </button>

      <!-- Job Application Section -->
      <div class="p-6 bg-white rounded-lg shadow-md mt-6">
        <h2 class="text-lg font-semibold mb-2">Apply for a Job</h2>

        <!-- Job Selection Dropdown -->
        <select bind:value={selectedJob} class="p-2 border rounded-lg w-full">
          <option value="" disabled selected>Select a job</option>
          {#each jobOptions as job}
            <option value={job}>{job}</option>
          {/each}
        </select>

        <!-- File Upload -->
        <input type="file" accept=".pdf,.doc,.docx" on:change={handleFileUpload} class="p-2 border rounded-lg w-full mt-4" />

        <!-- Submit Application Button -->
        <button on:click={confirmSubmission} class="px-6 py-3 bg-green-500 text-white rounded-lg shadow-md hover:scale-105 transition-transform duration-300 mt-4 w-full">
          Submit Application
        </button>
      </div>
    
      <div class="p-6 bg-white rounded-lg shadow-md mt-6">
        <h2 class="text-lg font-semibold mb-2 text-start">Graduate Details</h2>
      
        <table class="w-full border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-200">
              <th class="border p-2">First Name</th>
              <th class="border p-2">Last Name</th>
              <th class="border p-2">Postcode</th>
              <th class="border p-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            {#each graduates as grad}
              <tr class="border">
                <td class="border p-2">{grad.first_name}</td>
                <td class="border p-2">{grad.last_name}</td>
                <td class="border p-2">{grad.postcode}</td>
                <td class="border p-2">
                  <button on:click={() => selectGraduate(grad)} class="px-2 py-1 bg-blue-400 text-white rounded">Edit</button>
                  <button on:click={() => deleteGraduate(grad.id)} class="px-2 py-1 bg-red-500 text-white rounded ml-2">Delete</button>
                </td>
              </tr>
            {/each}
          </tbody>
        </table>
      </div>
    </div>
    {#if selectedGraduate}
      <div class="p-6 bg-gray-50 rounded-lg shadow-md mt-6">
        <h3 class="text-lg font-semibold mb-2">Edit Graduate</h3>
        <label>First Name:</label>
        <input bind:value={updatedFirstName} class="p-2 border rounded-lg w-full mt-2" />
        
        <label>Last Name:</label>
        <input bind:value={updatedLastName} class="p-2 border rounded-lg w-full mt-2" />
        
        <label>Postcode:</label>
        <input bind:value={updatedPostcode} class="p-2 border rounded-lg w-full mt-2" />
        
        <button on:click={updateGraduate} class="px-6 py-3 bg-green-500 text-white rounded-lg mt-4">
          Save Changes
        </button>
      </div>
    {/if}
    
  {:else if employer}
    <div id="employer" class="w-full p-6 bg-yellow-50 border-4 border-yellow-300 rounded-lg text-center"></div>
  {/if}

  <!-- Event Confirmation Popup -->
  {#if showPopup}
    <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
      <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        {#if selectedJob && uploadedFile}
          <p class="mb-4 text-lg font-semibold">Are you sure you want to apply for "{selectedJob}"?</p>
          <div class="flex justify-center space-x-4">
            <button on:click={() => handleApplicationResponse(true)} class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
              Yes
            </button>
            <button on:click={() => handleApplicationResponse(false)} class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
              No
            </button>
          </div>
        {:else}
          <p class="mb-4 text-lg font-semibold">Are you sure you attended the event?</p>
          <div class="flex justify-center space-x-4">
            <button on:click={() => handleResponse(true)} class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
              Yes
            </button>
            <button on:click={() => handleResponse(false)} class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
              No
            </button>
          </div>
        {/if}
      </div>
    </div>
  {/if}
</Layout>

<style>
  #page {
    height: 83vh;
  }

  #grad, #employer {
    height: 83vh;
  }
</style>

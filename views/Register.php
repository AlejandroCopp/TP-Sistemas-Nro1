<?php
function Register(){

?>

<main class="w-full max-w-md mx-auto p-6">

  <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-2xs dark:bg-neutral-800 dark:border-neutral-700">

    <div class="p-4 sm:p-7">

      <div class="text-center">

        <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign up</h1>

        <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">

          Already have an account?

          <a class="text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500" href="/login">

            Sign in here

          </a>

        </p>

      </div>



        <!-- Form -->

        <form id="register-form">

          <div id="message-div" class="hidden text-center p-2 my-2 text-sm text-white rounded-lg" role="alert"></div>

          <div class="grid gap-y-4">

            <!-- Form Group -->

            <div>

              <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>

              <div class="relative">

                <input type="email" id="email" name="email" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>

              </div>

            </div>

            <!-- End Form Group -->

            

            <!-- Form Group -->

            <div>

              <label for="name" class="block text-sm mb-2 dark:text-white">Name</label>

              <div class="relative">

                <input type="text" id="name" name="name" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>

              </div>

            </div>

            <!-- End Form Group -->

            

            <!-- Form Group -->

            <div>

              <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>

              <div class="relative">

                <input type="password" id="password" name="password" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>

              </div>

            </div>

            <!-- End Form Group -->



            <!-- Form Group -->

            <div>

              <label for="confirm-password" class="block text-sm mb-2 dark:text-white">Confirm Password</label>

              <div class="relative">

                <input type="password" id="confirm-password" name="confirm-password" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>

              </div>

            </div>

            <!-- End Form Group -->



            <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Sign up</button>

          </div>

        </form>

        <!-- End Form -->

      </div>

    </div>

  </div>

</main>



<script>

  document.getElementById('register-form').addEventListener('submit', async function(event) {

    event.preventDefault();



    const form = event.target;

    const formData = new FormData(form);

    const messageDiv = document.getElementById('message-div');

    const password = formData.get('password');

    const confirmPassword = formData.get('confirm-password');



    messageDiv.className = 'hidden text-center p-2 my-2 text-sm text-white rounded-lg'; // Reset classes

    messageDiv.textContent = '';



    if (password !== confirmPassword) {

      messageDiv.textContent = 'Passwords do not match.';

      messageDiv.classList.remove('hidden');

      messageDiv.classList.add('bg-red-500');

      return;

    }



    try {

      const response = await fetch('/api/auth/register', {

        method: 'POST',

        body: new URLSearchParams(formData)

      });



      const data = await response.json();



      if (!response.ok) {

        throw new Error(data.message || 'An error occurred.');

      }



      // On successful registration, show message and redirect

      messageDiv.textContent = data.message + ' Redirecting to app...';

      messageDiv.classList.remove('hidden');

      messageDiv.classList.add('bg-green-500');



      setTimeout(() => {

        window.location.href = '/';

      }, 2000);



    } catch (error) {

      messageDiv.textContent = error.message;

      messageDiv.classList.remove('hidden');

      messageDiv.classList.add('bg-red-500');

    }

  });

</script>

<?php }?>

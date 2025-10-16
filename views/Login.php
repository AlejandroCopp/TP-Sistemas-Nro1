<?php
  function Login(){
    ?>
    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-2xs dark:bg-neutral-900 dark:border-neutral-700">
      <div class="p-4 sm:p-7">
        <div class="text-center">
          <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign in</h1>
          <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
            Don't have an account yet?
            <a class="text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500" href="/register">
              Sign up here
            </a>
          </p>
        </div>

        <div class="mt-5">
          <div class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-neutral-500 dark:before:border-neutral-600 dark:after:border-neutral-600">Or</div>

          <!-- Form -->
          <form id="login-form">
            <div id="error-message" class="hidden text-center p-2 my-2 text-sm text-white bg-red-500 rounded-lg" role="alert"></div>
            <div class="grid gap-y-4">
              <!-- Form Group -->
              <div>
                <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>
                <div class="relative">
                  <input type="email" id="email" name="email" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                </div>
              </div>
              <!-- End Form Group -->

              <!-- Form Group -->
              <div>
                <div class="flex flex-wrap justify-between items-center gap-2">
                  <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
                  <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500" href="#">Forgot password?</a>
                </div>
                <div class="relative">
                  <input type="password" id="password" name="password" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                </div>
              </div>
              <!-- End Form Group -->

              <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Sign in</button>
            </div>
          </form>
          <!-- End Form -->
        </div>
      </div>
    </div>

    <script>
      document.getElementById('login-form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const errorMessageDiv = document.getElementById('error-message');

        errorMessageDiv.classList.add('hidden');
        errorMessageDiv.textContent = '';

        try {
          const response = await fetch('/api/auth/login', {
            method: 'POST',
            body: new URLSearchParams(formData)
          });

          const data = await response.text();

          if (!response.ok) {
            throw new Error(data.message || 'An error occurred.');
          }

          // On successful login, store user data and redirect
          localStorage.setItem('user', JSON.stringify(data.user));
          window.location.href = '/';

        } catch (error) {
          errorMessageDiv.textContent = error.message;
          errorMessageDiv.classList.remove('hidden');
        }
      });
    </script>
    <?php
  }
?>


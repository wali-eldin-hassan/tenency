<div>
  <div class="sm:hidden">
    <label for="tabs" class="sr-only">Select a tab</label>
    <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
    <select id="tabs" name="tabs" class="block w-full border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500">
      <option>My Account</option>

      <option>Company</option>

      <option selected>Team Members</option>

      <option>Billing</option>
    </select>
  </div>
  <div class="hidden sm:block">
    <nav class="flex space-x-4" aria-label="Tabs">
      <!-- Current: "bg-indigo-100 text-indigo-700", Default: "text-gray-500 hover:text-gray-700" -->
      <a href="/store" class="{{ (request()->is('store')) ? 'text-indigo-700 bg-indigo-100' : 'text-gray-500  hover:text-gray-700 hover:bg-gray-100' }} px-4 py-2 rounded-lg text-sm font-medium ">All Products</a>

      @foreach ($categories as $category)
        <a href="{{ $category->path() }}" class="{{ (request()->is('store/' . $category->slug)) ? 'text-indigo-700 bg-indigo-100' : 'text-gray-500  hover:text-gray-700 hover:bg-gray-100' }} px-4 py-2 rounded-lg text-sm font-medium ">
          {{ $category->name }}
        </a>
      @endforeach
    </nav>
  </div>
</div>

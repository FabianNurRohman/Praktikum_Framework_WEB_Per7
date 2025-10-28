<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="container mx-auto mt-5">
            <h2 class="mb-5 text-2xl font-bold">Create New Product</h2>

            {{-- Alert sukses --}}
            @if (session('success'))
              <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700 shadow-md">
                <span class="font-semibold">{{ session('success') }}</span>
              </div>
            @endif

            {{-- Error Validation --}}
            @if ($errors->any())
              <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700 shadow-md">
                <ul class="list-disc pl-5 space-y-1">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('product-store') }}" method="POST" class="space-y-4">
              @csrf
              
              <div class="form-group">
                <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" id="product_name" name="product_name"
                  value="{{ old('product_name') }}"
                  class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
              </div>

              <div class="form-group">
                <label for="unit" class="block text-sm font-medium text-gray-700">Unit</label>
                <select id="unit" name="unit"
                  class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                  <option value="" disabled {{ old('unit') ? '' : 'selected' }}>Select a unit</option>
                  <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                  <option value="ltr" {{ old('unit') == 'ltr' ? 'selected' : '' }}>Liter (ltr)</option>
                  <option value="pcs" {{ old('unit') == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                  <option value="box" {{ old('unit') == 'box' ? 'selected' : '' }}>Box</option>
                </select>
              </div>

              <div class="form-group">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <input type="text" id="type" name="type" value="{{ old('type') }}"
                  class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
              </div>

              <div class="form-group">
                <label for="information" class="block text-sm font-medium text-gray-700">Information</label>
                <textarea id="information" name="information" rows="3"
                  class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('information') }}</textarea>
              </div>

              <div class="form-group">
                <label for="qty" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" id="qty" name="qty" value="{{ old('qty') }}"
                  class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
              </div>

              <div class="form-group">
                <label for="producer" class="block text-sm font-medium text-gray-700">Producer</label>
                <input type="text" id="producer" name="producer" value="{{ old('producer') }}"
                  class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
              </div>

              <div class="flex items-center space-x-3">
                <button type="submit"
                  class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Submit
                </button>

                <a href="{{ route('product-index') }}"
                  class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md shadow-sm hover:bg-gray-300 focus:outline-none">
                  Kembali
                </a>
              </div>
            </form>
          </div>

          @vite('resources/js/app.js')
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

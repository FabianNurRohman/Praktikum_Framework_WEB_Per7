<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard / Update Product') }}
    </h2>
  </x-slot>

  <div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
        <div class="p-8 text-gray-900">

          <h2 class="mb-6 text-2xl font-bold text-center text-indigo-700">✏️ Update Product</h2>

          <!-- Pesan sukses -->
          @if (session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-4">
              <div class="flex">
                <div class="flex-shrink-0 text-green-600">
                  ✅
                </div>
                <div class="ml-3">
                  <p class="text-sm text-green-800">{{ session('success') }}</p>
                </div>
              </div>
            </div>
          @endif

          <!-- Pesan error validasi -->
          @if ($errors->any())
            <div class="mb-5 text-sm text-red-600">
              <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Form Update -->
          <form action="{{ route('product-update', $product->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div>
              <label for="product_name" class="block font-medium text-gray-700">Product Name</label>
              <input type="text" id="product_name" name="product_name"
                value="{{ old('product_name', $product->product_name) }}"
                class="w-full p-2 mt-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Unit -->
            <div>
              <label for="unit" class="block font-medium text-gray-700">Unit</label>
              <select id="unit" name="unit"
                class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="" disabled>Select a unit</option>
                <option value="kg" {{ old('unit', $product->unit) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                <option value="ltr" {{ old('unit', $product->unit) == 'ltr' ? 'selected' : '' }}>Liter (ltr)</option>
                <option value="pcs" {{ old('unit', $product->unit) == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                <option value="box" {{ old('unit', $product->unit) == 'box' ? 'selected' : '' }}>Box</option>
              </select>
            </div>

            <!-- Type -->
            <div>
              <label for="type" class="block font-medium text-gray-700">Type</label>
              <input type="text" id="type" name="type"
                value="{{ old('type', $product->type) }}"
                class="w-full p-2 mt-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Information -->
            <div>
              <label for="information" class="block font-medium text-gray-700">Information</label>
              <textarea id="information" name="information" rows="3"
                class="w-full p-2 mt-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('information', $product->information) }}</textarea>
            </div>

            <!-- Quantity -->
            <div>
              <label for="qty" class="block font-medium text-gray-700">Quantity</label>
              <input type="number" id="qty" name="qty"
                value="{{ old('qty', $product->qty) }}"
                class="w-full p-2 mt-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Producer -->
            <div>
              <label for="producer" class="block font-medium text-gray-700">Producer</label>
              <input type="text" id="producer" name="producer"
                value="{{ old('producer', $product->producer) }}"
                class="w-full p-2 mt-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between pt-4">
              <a href="{{ route('product-index') }}"
                 class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600 focus:ring-2 focus:ring-gray-400">
                 ← Back
              </a>
              <button type="submit"
                class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400">
                💾 Update Product
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>

<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
    <p class="text-sm text-gray-500">Manajemen Data Produk</p>
  </x-slot>

  <div class="container p-6 mx-auto">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-gray-700">Daftar Produk</h3>
      <a href="{{ route('product-create') }}">
        <button
          class="px-4 py-2 text-white bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg shadow-md hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-400 transition-all duration-200">
          + Tambah Produk
        </button>
      </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full border border-gray-200">
        <thead>
          <tr class="bg-gray-100 text-left text-gray-700">
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Product Name</th>
            <th class="px-4 py-2 border">Unit</th>
            <th class="px-4 py-2 border">Type</th>
            <th class="px-4 py-2 border">Information</th>
            <th class="px-4 py-2 border">Qty</th>
            <th class="px-4 py-2 border">Producer</th>
            <th class="px-4 py-2 border text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr class="bg-white border-b hover:bg-gray-50 transition">
            <td class="px-4 py-2 border">{{ $item->id }}</td>
            <td class="px-4 py-2 border">{{ $item->product_name }}</td>
            <td class="px-4 py-2 border">{{ $item->unit }}</td>
            <td class="px-4 py-2 border">{{ $item->type }}</td>
            <td class="px-4 py-2 border">{{ $item->information }}</td>
            <td class="px-4 py-2 border">{{ $item->qty }}</td>
            <td class="px-4 py-2 border">{{ $item->producer }}</td>
            <td class="px-4 py-2 text-center border space-x-2">

              <!-- Tombol Edit -->
              <a href="{{ route('product-edit', $item->id) }}"
                class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 rounded-md shadow-md transition-all duration-200 focus:ring-2 focus:ring-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-white" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 4h2m-1 0v16m-6-6h12" />
                </svg>
                Edit
              </a>

              <!-- Tombol Hapus -->
              <button onclick="confirmDelete({{ $item->id }}, '{{ route('product-destroy', $item->id) }}')"
                class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 rounded-md shadow-md transition-all duration-200 focus:ring-2 focus:ring-red-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 text-white" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
                </svg>
                Hapus
              </button>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function confirmDelete(id, deleteUrl) {
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = deleteUrl;

        let csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        let methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        document.body.appendChild(form);
        form.submit();
      }
    }
  </script>
</x-app-layout>

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

    {{-- Alert Message --}}
    @if (session('success'))
      <div id="alert-success"
        class="relative mb-4 flex items-center justify-between rounded-lg border border-green-200 bg-green-50 p-4 text-green-700 shadow-md animate-fade-in">
        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
          <span>{{ session('success') }}</span>
        </div>
        <button onclick="closeAlert('alert-success')" class="ml-4 text-green-700 hover:text-green-900">✕</button>
      </div>
    @elseif (session('error'))
      <div id="alert-error"
        class="relative mb-4 flex items-center justify-between rounded-lg border border-red-200 bg-red-50 p-4 text-red-700 shadow-md animate-fade-in">
        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-red-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
          <span>{{ session('error') }}</span>
        </div>
        <button onclick="closeAlert('alert-error')" class="ml-4 text-red-700 hover:text-red-900">✕</button>
      </div>
    @endif

    {{-- Form Search + Sort --}}
    <form method="GET" action="{{ route('product-index') }}" class="mb-6 flex items-center space-x-2">
      <div class="relative w-1/3">
        <input type="text" name="search" value="{{ request('search') }}"
          placeholder="Cari produk..."
          class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 focus:outline-none transition duration-150 ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg"
          class="absolute left-3 top-2.5 w-5 h-5 text-gray-400 pointer-events-none"
          fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
        </svg>
      </div>

      <select name="sort"
        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-600 focus:border-green-600 focus:outline-none">
        <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default</option>
        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>A-Z (Nama Produk)</option>
        <option value="type" {{ request('sort') == 'type' ? 'selected' : '' }}>Tipe</option>
        <option value="producer" {{ request('sort') == 'producer' ? 'selected' : '' }}>Produsen</option>
      </select>

      <button type="submit"
        class="flex items-center px-5 py-2.5 text-white font-semibold rounded-lg shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-400"
        style="background-color:#16a34a; background-image:linear-gradient(to right, #16a34a, #059669);">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
        </svg>
        Cari
      </button>

      <a href="{{ route('product-index') }}"
        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg shadow hover:bg-gray-200 transition-all duration-200">
        Reset
      </a>
    </form>

    {{-- Table Data --}}
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
            <th class="px-4 py-2 border text-center w-40">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $item)
            <tr class="bg-white border-b hover:bg-gray-50 transition">
              <td class="px-4 py-2 border">{{ $item->id }}</td>
              <td class="px-4 py-2 border">
                <a href="{{ route('product-detail', $item->id) }}" class="text-blue-600 hover:underline">
                  {{ $item->product_name }}
                </a>
              </td>
              <td class="px-4 py-2 border">{{ $item->unit }}</td>
              <td class="px-4 py-2 border">{{ $item->type }}</td>
              <td class="px-4 py-2 border">{{ $item->information }}</td>
              <td class="px-4 py-2 border">{{ $item->qty }}</td>
              <td class="px-4 py-2 border">{{ $item->producer }}</td>
              <td class="px-4 py-2 text-center border">
                <div class="flex justify-center gap-2">
                  {{-- Tombol Edit --}}
                  <a href="{{ route('product-edit', $item->id) }}"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                    Edit
                  </a>

                  {{-- Tombol Hapus --}}
                  <button onclick="confirmDelete({{ $item->id }}, '{{ route('product-destroy', $item->id) }}')"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                    Hapus
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-gray-500 py-4">Produk tidak ditemukan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $products->appends(['search' => request('search'), 'sort' => request('sort')])->links() }}
    </div>
  </div>

  <script>
    function closeAlert(id) {
      const alertBox = document.getElementById(id);
      if (alertBox) {
        alertBox.classList.add('opacity-0', 'translate-y-2');
        setTimeout(() => alertBox.remove(), 300);
      }
    }

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

    // === Pop-up Alert (versi ukuran proporsional) ===
    document.addEventListener('DOMContentLoaded', function () {
      @if (session('success'))
        showPopup("{{ session('success') }}", true);
      @elseif (session('error'))
        showPopup("{{ session('error') }}", false);
      @endif
    });

    function showPopup(message, isSuccess = true) {
      const popup = document.createElement('div');
      popup.innerHTML = `
        <div id="popup-alert" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
          <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-11/12 sm:w-96 text-center animate-fade-in relative">
            <div class="flex flex-col items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg"
                class="w-16 h-16 mb-4 ${isSuccess ? 'text-green-500' : 'text-red-500'}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                ${isSuccess 
                  ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />'
                  : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />'}
              </svg>
              <p class="text-gray-800 font-semibold mb-5 text-lg leading-snug">${message}</p>
              <button onclick="closePopup()"
                class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg shadow hover:from-green-600 hover:to-emerald-700 transition-all duration-200">
                OK
              </button>
            </div>
          </div>
        </div>`;
      document.body.appendChild(popup);
    }

    function closePopup() {
      const popup = document.getElementById('popup-alert');
      if (popup) popup.remove();
    }
  </script>

  <style>
    @keyframes fade-in {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-in-out; }
  </style>
</x-app-layout>

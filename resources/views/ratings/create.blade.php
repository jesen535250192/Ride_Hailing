<x-app-layout>

<div class="max-w-2xl mx-auto mt-8 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-5">
        Berikan Rating Driver
    </h2>

    <form action="{{ route('ratings.store',$order) }}" method="POST">
        @csrf

        <div class="mb-5">
            <label class="font-semibold">
                Rating
            </label>

            <select
                name="rating"
                class="w-full border rounded mt-2 p-2"
                required>

                <option value="">Pilih Rating</option>

                <option value="5">⭐⭐⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="2">⭐⭐</option>
                <option value="1">⭐</option>

            </select>

            @error('rating')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">

            <label class="font-semibold">
                Saran
            </label>

            <textarea
                name="suggestion"
                rows="5"
                class="w-full border rounded mt-2 p-2"
                placeholder="Berikan masukan kepada driver..."></textarea>

        </div>

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

            Kirim Rating

        </button>

    </form>

</div>

</x-app-layout>
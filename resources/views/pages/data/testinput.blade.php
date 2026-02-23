@include ('layouts.app')
@include('pages.forms.modal.city')

<body class="min-h-screen flex items-center justify-center bg-[#EC9223]">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center text-[#DE5727] mb-6">
            Submit Form
        </h2>

        <form action="{{ route('data.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-[#DE5727] mb-1">
                    Nama Lengkap
                </label>
                <input type="text" name="name"
                    class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720] focus:border-transparent transition">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-[#DE5727] mb-1">
                    Email
                </label>
                <input type="email" name="email"
                    class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720] focus:border-transparent transition">
            </div>

            <!-- Nomor HP -->
            <div>
                <label class="block text-sm font-medium text-[#DE5727] mb-1">
                    Nomor Hp
                </label>
                <input type="tel" name="number" placeholder="+62"
                    class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720] focus:border-transparent transition">
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-sm font-medium text-[#DE5727] mb-1">
                    Alamat
                </label>
                <input type="text" name="address"
                    class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720] focus:border-transparent transition">
            </div>

            <!-- Package -->
            <div>
                <label class="block text-sm font-medium text-[#DE5727] mb-1">
                    Paket
                </label>
                <select name="package_id"
                    class="w-full px-4 py-2 border border-[#ED9720] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ED9720]">
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}">
                            {{ $package->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-[#DE5727] text-white font-semibold py-2.5 rounded-xl hover:bg-[#c94e1f] hover:scale-[1.02] transition-all duration-200 shadow-md">
                Submit
            </button>

        </form>
    </div>

</body>

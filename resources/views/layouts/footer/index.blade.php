
<footer class="bg-gray-100">
    <div class="max-w-7xl w-full mx-auto px-4 py-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

            <!-- Logo -->
            <a href="/" class="flex justify-center sm:justify-start">
                <img src="{{ asset('assets/Logo-Full-Color.png') }}" class="h-8 w-auto" alt="Intynet Logo" />
            </a>

            <!-- Menu -->
            <ul class="flex flex-wrap justify-center sm:justify-end gap-4 text-sm font-medium text-gray-600">
                <li>
                    <a href="#" class="hover:text-black transition">
                        About
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:text-black transition">
                        Privacy Policy
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:text-black transition">
                        Licensing
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:text-black transition">
                        Contact
                    </a>
                </li>
            </ul>

        </div>

        <!-- Copyright -->
        <div class="mt-6 border-t pt-6 text-center text-sm text-gray-500">
            © {{ date('Y') }}
            <span class="font-medium text-gray-700">Intynet</span>.
            All Rights Reserved.
        </div>

    </div>
</footer>

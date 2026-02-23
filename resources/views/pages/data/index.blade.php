@include('layouts.app')
<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md relative">

        <label class="block mb-2 text-sm font-medium text-gray-700">
            City
        </label>

        <input type="text" id="cityInput" placeholder="Type city..."
            class="w-full border border-gray-300 p-3 rounded-xl 
                   focus:outline-none focus:ring-2 focus:ring-blue-500 
                   focus:border-blue-500 transition">

        <ul id="suggestions"
            class="absolute left-0 right-0 bg-white border border-gray-200 
                   rounded-xl mt-2 hidden max-h-48 overflow-y-auto 
                   shadow-lg z-50">
        </ul>

    </div>

</div>
<script>
    const input = document.getElementById('cityInput');
    const suggestions = document.getElementById('suggestions');

    let timeout = null;

    input.addEventListener('input', function() {
        clearTimeout(timeout);

        timeout = setTimeout(async () => {
            const query = this.value;

            if (query.length < 1) {
                suggestions.classList.add('hidden');
                return;
            }

            const response = await fetch(`/data/cities/search?q=${query}`);
            const cities = await response.json();

            suggestions.innerHTML = '';

            if (cities.length === 0) {
                suggestions.classList.add('hidden');
                return;
            }

            cities.forEach(city => {
                const li = document.createElement('li');
                li.innerHTML = `
    <div>
        <div class="font-medium">${city.name}</div>
        <div class="text-sm text-gray-500">${city.area}</div>
    </div>
`;

                li.addEventListener('click', () => {
                    input.value = city.name;
                    suggestions.classList.add('hidden');
                });

                suggestions.appendChild(li);
            });

            suggestions.classList.remove('hidden');
        }, 300);
    });
</script>

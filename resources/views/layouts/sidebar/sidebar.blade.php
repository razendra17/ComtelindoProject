@hasrole('admin')

    <!-- drawer component -->
    <div id="drawer-navigation"
        class="w-[30vh] min-h-screen
        bg-[#ffffff] shadow-md
        transition-all duration-300" tabindex="-1"
        aria-labelledby="drawer-navigation-label">
        <div class="py-5 overflow-y-auto text-black/60 overflow-hidden">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard.index') }}"
                        class="flex items-center px-3 py-3 rounded-base
                    transition-all duration-200 ease-in-out
                    hover:bg-neutral-tertiary hover:text-[#eb8e23]
                    hover:translate-x-1">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-[#eb8e23]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                    class="flex w-full items-center px-3 py-3 rounded-base
                    transition-all duration-200 ease-in-out
                    hover:bg-neutral-tertiary hover:text-[#eb8e23]
                    hover:translate-x-1"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <i class="fa-regular fa-square-plus"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Add</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>

                            <a href="{{ route('city.index') }}"
                            class="flex items-center px-3 py-1 rounded-base
                            transition-all duration-200 ease-in-out
                            hover:bg-neutral-tertiary hover:text-[#eb8e23]
                            hover:translate-x-1">
                                <i class="fa-regular fa-map px-2"></i>Cities</a>
                        </li>
                        <li>
                            <a href="{{ route('package.index') }}"
                            class="flex items-center px-3 py-1 rounded-base
                            transition-all duration-200 ease-in-out
                            hover:bg-neutral-tertiary hover:text-[#eb8e23]
                            hover:translate-x-1">
                                <i class="fa-regular fa-folder px-2"></i></i>Package</a>
                        </li>
                        <li>
                            <a href="{{ route('data.index') }}"
                            class="flex items-center px-3 py-1 rounded-base
                            transition-all duration-200 ease-in-out
                            hover:bg-neutral-tertiary hover:text-[#eb8e23]
                            hover:translate-x-1">
                                <i class="fa-regular fa-hard-drive px-2"></i></i>Data</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('dataadmin.index') }}"
                    class="flex items-center px-3 py-3 rounded-base
                    transition-all duration-200 ease-in-out
                    hover:bg-neutral-tertiary hover:text-[#eb8e23]
                    hover:translate-x-1">
                        <i class="fa-regular fa-hard-drive group-hover:text-[#eb8e23]"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Data</span>
                    </a>
                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                        class="flex w-full items-center px-3 py-3 rounded-base
                        transition-all duration-200 ease-in-out
                        hover:bg-neutral-tertiary hover:text-[#eb2323]
                        hover:translate-x-1">
                            <div>
                                <i class="fa-regular fa-circle-user"></i>
                                <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                            </div>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
@endhasrole

@hasrole('admin')
    <!-- drawer init and show -->
    <div class="text-left">
        <button class="text-[#eb8e23]   focus:ring-2 focus:ring-orange shadow-xs rounded-base p-2.5 focus:outline-none"
            type="button" data-drawer-target="drawer-navigation" data-drawer-backdrop="false"
            data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
            <svg xmlns="https://www.svgrepo.com/svg/524617/hamburger-menu" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- drawer component -->
    <div id="drawer-navigation"
        class="absolute top-0 left-0 z-40
       w-64 h-full
       transition-transform duration-300
       -translate-x-full
       bg-white shadow-2xl"
        tabindex="-1" aria-labelledby="drawer-navigation-label">
        <div class="border-b border-default p-3 flex items-center justify-center">
            <span class="self-center text-lg whitespace-nowrap text-body">Admin Panel</span>
            <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
                class="text-body bg-transparent hover:text-heading hover:bg-neutral-tertiary rounded-base w-9 h-9 absolute top-2.5 end-2.5 flex items-center justify-center">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
        </div>
        <div class="py-5 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard.index') }}"
                        class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-[#eb8e23]">
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
                        class="flex items-center w-full justify-between px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-[#eb8e23] group"
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
                                class="pl-10 flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-[#eb8e23]">
                                <i class="fa-regular fa-map px-2"></i>Cities</a>
                        </li>
                        <li>
                              <a href="{{ route('package.index') }}"
                                class="pl-10 flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-[#eb8e23]">
                                <i class="fa-regular fa-folder px-2"></i></i>Package</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"
                        class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-[#eb8e23] group">
                        <i class="fa-regular fa-hard-drive group-hover:text-[#eb8e23]"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Data</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-[#eb8e23] group">
                        <i class="fa-regular fa-envelope"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-start px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-[#ff2020] group w-full">
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

<nav class="bg-color-primary-500 text-white fixed z-10 w-full shadow-sm font-Poppins">
    <div class="w-full p-4 max-w-screen-xl mx-auto flex z-[5] justify-between items-center ">
        @php
            $role = Auth::user()->role;
            if ($role == 'super_admin') {
                $role = 'dosen';
            }
        @endphp
        <h1>{{Auth::user()->$role->name}}</h1>
        <h1>{{Auth::user()->role}}</h1>
        <div class="inline-flex items-center gap-x-2">
            <img src="/avatar/ung.png" alt="" class="w-10">
        </div>
        <div class="relative cursor-pointer" onclick="openDropDown(this)">
            <img src="/avatar/placeholder.jpg" alt="" class="w-12 rounded-full border-2 border-white">
            <div
                class="absolute hidden top-full p-4 bg-white text-xs rounded-xl shadow-md flex-col gap-y-2 w-max dropdown_menu">
                <p class="w-full text-color-primary-600">
                    User
                </p>
                <div class="inline-flex items-center gap-x-2 text-slate-500 w-full">
                    <i class="fas fa-user-circle"></i> <!-- Mengubah ikon menjadi ikon profil -->
                    <p class="w-full">Profile</p>
                </div>
                <div class="inline-flex items-center gap-x-2 text-red-400">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> <!-- Mengubah ikon menjadi ikon keluar -->
                        Log Out
                    </a>
                </div>
            </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    </div>


    <div class="w-full bg-white p-2">
        <div class="max-w-screen-xl hidden mx-auto text-black list-none lg:flex items-center p-2 gap-x-8 text-sm">
            <li class="p-2">
                <div class="inline-flex items-center gap-x-2  text-slate-500">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="fas fa-home"></i>
                        Beranda
                    </a>
                </div>
            </li>
            <li class="p-2 relative cursor-pointer" onclick="openDropDown(this)">
                <div class="inline-flex items-center gap-x-2  text-slate-500">
                    <i class="fas fa-box"></i>
                    Master
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div
                    class="absolute hidden top-full p-4 bg-white text-xs rounded-xl shadow-md flex-col gap-y-2 w-max dropdown_menu">
                    <div class="inline-flex items-center gap-x-2 text-slate-500 w-full">
                        <a href="{{route('mahasiswa.index')}}">
                            <i class="fas fa-file"></i>
                            Mahasiswa
                        </a>
                    <a href="{{route('dosen.index')}}">
                            <i class="fas fa-file"></i>
                            Dosen
                        </a>
                    </div>

                </div>
                <li class="p-2">
                    <div class="inline-flex items-center gap-x-2  text-slate-500">
                        <a href="{{route('periode.index')}}">
                            <i class="fas fa-home"></i>
                            Periode
                        </a>
                    </div>
                </li>
            </li>
        </div>
        <button class=" px-4 py-2.5 lg:hidden block text-slate-500 rounded-lg" onclick="handleMenuClick()">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    {{-- mobile nav --}}
    <div class="absolute -translate-x-[100%] transition-transform z-[30] w-screen h-screen top-0 right-0 left-0 bottom-0 bg-white p-4 flex flex-col gap-y-2 text-sm overflow-y-auto"
        id="adminNav">
        <div class="p-2 flex items-center justify-between">
            <img src="/images/avatar/km_colored.png" alt="" class="w-16">
            <button class="px-3 py-1.5 rounded-lg hover:bg-slate-100 text-slate-500" onclick="handleMenuClick()">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <li class="p-4 flex items-center bg-color-primary-500 text-white rounded-lg">
            <a href="" class="flex items-center gap-x-2 ">
                <i class="fas fa-home"></i>
                single menu
            </a>
        </li>
        <li class="p-4 flex items-center bg-color-primary-500 text-white rounded-lg ">
            <div href=" " class="flex flex-col items-center w-full" onclick="openDropDown(this)">
                <div class="flex items-center justify-between w-full">
                    <div class="flex items-center gap-x-2">
                        <i class="fas fa-box"></i>
                        nested menu
                    </div>
                    <span><i class="fas fa-chevron-down"></i></span>
                </div>
                <div
                    class=" flex-col gap-y-2 p-4 bg-white text-color-primary-500 rounded-lg hidden w-full mt-4 dropdown_menu">
                    <a href="" class="flex items-center gap-x-2">
                        <i class="fas fa-file"></i>
                        menu
                    </a>
                </div>
            </div>
        </li>
    </div>
</nav>

<script>
    const openDropDown = (element) => {
        // Temukan kontainer dropdown yang merupakan anak langsung dari elemen yang diklik
        const dropdownMenu = element.querySelector('.dropdown_menu');

        // Periksa apakah dropdownMenu memiliki kelas 'hidden'
        if (dropdownMenu.classList.contains('hidden')) {
            // Jika memiliki kelas 'hidden', hapus kelas tersebut
            dropdownMenu.classList.remove('hidden');
            dropdownMenu.classList.add('flex');
        } else {
            // Jika tidak memiliki kelas 'hidden', tambahkan kelas tersebut
            dropdownMenu.classList.remove('flex');
            dropdownMenu.classList.add('hidden');
        }
    };

    function handleMenuClick () {
        const naruto = document.getElementById('adminNav')

        if (naruto.classList.contains('-translate-x-[100%]')){
            naruto.classList.remove('-translate-x-[100%]');
            naruto.classList.add('-translate-x-0');
        } else {
            naruto.classList.remove('-translate-x-0');
            naruto.classList.add('-translate-x-[100%]');
        }

        if (!isDropdownClicked) {
        const allDropdowns = document.querySelectorAll('.dropdown_menu');
        allDropdowns.forEach(function(dropdown) {
            dropdown.classList.remove('flex');
            dropdown.classList.add('hidden');
        });
    }
    }

    document.addEventListener('click', function(event) {
        const isOutsideDropdown = !event.target.closest('.relative');

        if (isOutsideDropdown) {
            const allDropdowns = document.querySelectorAll('.dropdown_menu');
            allDropdowns.forEach(function(dropdown) {
                dropdown.classList.remove('flex');
                dropdown.classList.add('hidden');
            });
        }
    });
</script>
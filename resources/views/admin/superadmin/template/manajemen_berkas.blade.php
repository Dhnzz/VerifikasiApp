@extends('layout.admin')

@section('main')
    <section class="max-w-screen-lg min-h-screen mx-auto flex items-center pt-44 pb-20 px-4 lg:px-12 gap-4">
        <div class="w-full p-10 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
            <div class="w-full flex flex-col items-center">
                <p class="font-semibold text-lg">{{ $data->name }} </p>
            </div>
            <div class="mt-4">
                <form action="{{ route('admin.itemberkas.store') }}" method="post" class="w-full">
                    @csrf
                    <div class="mb-4">
                        <div class="inline-flex justify-between items-end w-full mb-4">
                            <label for="berkas_kegiatan" class="block mb-2 font-semibold text-gray-900 dark:text-white">
                                Berkas Kegiatan
                            </label>
                            <x-button_sm color="primary" class="col-span-12 w-fit" onclick="addBerkas(event)">
                                <span><i class="fas fa-plus"></i></span>
                            </x-button_sm>
                        </div>
                        <div id="berkas-container" class="flex flex-col gap-y-4">
                            <!-- Dynamic berkas section will be added here -->
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($data->itemBerkas as $item)
                                <div class="p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4">
                                    <button class="flex justify-between" onclick="openDetails(this, event)">
                                        <p class="font-semibold">Berkas {{ $i++ }}</p>
                                        <span><i class="fas fa-chevron-down text-sm"></i></span>
                                    </button>
                                    <div class="detailContainer flex flex-col hidden">
                                        <div class="mb-4">
                                            <label for="nama_berkas"
                                                class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                                                Nama Berkas
                                            </label>
                                            <input type="text"
                                                name="{{ $data->itemBerkas->count() > 0 ? '' : 'name[]' }}"
                                                id="nama_berkas${berkasCount}" placeholder="Masukan Nama Berkas"
                                                class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs"
                                                disable value="{{ $item->name }}" oninput="toggleEditButton(this)" />
                                            <input type="hidden" name="template_berkas_id[]" id="nama_berkas${berkasCount}"
                                                value="{{ $data->id }}" />
                                        </div>
                                        <div>
                                            <x-button_sm color="primary" class="edit-button" type="submit"
                                                onclick="modalOpen(this)">
                                                Aksi
                                            </x-button_sm>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <x-button_md color="primary" class="w-full col-span-12" type="submit">
                        Kirim
                    </x-button_md>
                </form>
                <div id="modal"
                    class="fixed inset-0 z-20 h-screen w-screen flex justify-center items-center bg-black/25 hidden">
                    <div class="max-w-lg w-full p-6 bg-white rounded-xl">
                        <div class="w-full inline-flex items-center justify-between">
                            <p class="text-lg font-semibold">Berkas 1</p>
                            <button id="close-modal" class="px-3 py-1.5 rounded-lg hover:bg-slate-100 text-slate-500"
                                onclick="closeModal()">
                                <i class="fas fa-times text-lg"></i>
                            </button>
                        </div>
                        <hr class="mt-4 mb-4">
                        <div class="mb-4">
                            <form action="{{ route('admin.item-management.update') }}" method="post">
                                @csrf
                                @method('PUT')
                                <label for="nama_berkas_modal"
                                    class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                                    Nama Berkas
                                </label>
                                <input type="text" name="name" id="nama_berkas_modal"
                                    placeholder="Masukan Nama Berkas"
                                    class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
                                <input type="text" name="template_berkas_id" placeholder="Masukan Nama Berkas"
                                    id="template_berkas_id"
                                    class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
                                <div class="inline-flex items-center gap-x-2">
                                    <x-button_md color="primary" type="submit">
                                        Edit
                                    </x-button_md>
                                </div>
                            </form>
                            <form action="{{ route('admin.item-management.destroy') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="text" name="template_berkas_id" placeholder="Masukan Nama Berkas"
                                    id="template_berkas_id_delete"
                                    class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
                                <input type="text" name="template_id" value="{{$data->id}}" placeholder="Masukan Nama Berkas"
                                    id="template_id_delete"
                                    class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
                                <div class="inline-flex items-center gap-x-2">
                                    <x-button_md color="danger" type="submit">
                                        Hapus
                                    </x-button_md>
                                </div>
                            </form>
                        </div>
                        <hr class="mt-4 mb-4">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let berkasCount = 0;

        function addBerkas(event) {
            event.preventDefault();
            berkasCount++;

            const berkasContainer = document.getElementById('berkas-container');

            const berkasDiv = document.createElement('div');
            berkasDiv.className = 'berkas mb-4';
            berkasDiv.id = `berkas${berkasCount}`;
            berkasDiv.innerHTML = `
    <div class="p-6 bg-slate-100 rounded-xl flex flex-col gap-y-4">
        <button class="flex justify-between" onclick="openDetails(this, event)">
            <p class="font-semibold">Berkas Baru</p>
            <span><i class="fas fa-chevron-down text-sm"></i></span>
        </button>
        <div class="detailContainer flex flex-col hidden">
            <div class="mb-4">
                <label for="nama_berkas" class="block mb-2 text-xs xl:text-sm text-gray-900 dark:text-white">
                    Nama Berkas
                </label>
                <input type="text" name="name[]" id="nama_berkas${berkasCount}" placeholder="Masukan Nama Berkas"
                    class="block w-full xl:p-4 p-3 text-gray-900 border border-gray-300 rounded-md bg-gray-50 xl:text-sm text-xs" />
                <input type="hidden" name="template_berkas_id[]" id="nama_berkas${berkasCount}" value="{{ $data->id }}" />
            </div>
            <div>
                <x-button_sm color="danger" class="" onclick="removeBerkas(${berkasCount}, event)">
                    <i class="fas fa-trash text-sm"></i> Hapus Berkas
                </x-button_sm>
            </div>
        </div>
    </div>
    `;
            berkasContainer.appendChild(berkasDiv);
        }

        function openDetails(button, event) {
            event.preventDefault();
            const detailContainer = button.nextElementSibling;
            detailContainer.classList.toggle('hidden');
        }

        function removeBerkas(berkasId, event) {
            event.preventDefault();
            const berkasDiv = document.getElementById(`berkas${berkasId}`);
            berkasDiv.remove();
        }

        function toggleEditButton(input) {
            const editButton = input.closest('.detailContainer').querySelector('.edit-button');
            if (input.value) {
                editButton.classList.remove('hidden');
            } else {
                editButton.classList.add('hidden');
            }
        }
  function modalOpen(value) {
    console.log(value)
    const inputan = value.parentElement.previousElementSibling.children[1].value;
    console.log(inputan)
    const modal = document.getElementById('modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex')
    const inputStatis = document.getElementById('nama_berkas_statis');
    setModalInputValue(inputan);
  }

        function closeModal() {
            const modal = document.getElementById('modal')
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function setModalInputValue(value) {
            const inputModal = document.getElementById('nama_berkas_modal');
            inputModal.value = value;
        }

        function setModalIdValue(value) {
            const inputModal = document.getElementById('template_berkas_id');
            inputModal.value = value;
        }

        function setModalIdDeleteValue(value) {
            const inputModal = document.getElementById('template_berkas_id_delete');
            inputModal.value = value;
        }
</script>
@endsection
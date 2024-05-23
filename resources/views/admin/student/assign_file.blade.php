@extends('layout.admin')

@section('main')
<section class="max-w-screen-xl mx-auto min-h-screen flex items-center justify-center py-44 px-4 lg:px-12 gap-4">
  <div class="">
    
  </div>
</section>
<script>
    function openDetails(button, event) {
            event.preventDefault();
            const detailContainer = button.nextElementSibling;
            detailContainer.classList.toggle('hidden');
        }
</script>
@endsection
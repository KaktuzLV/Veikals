@if ($errors->any())
<div class="bg-red-200 text-red-900 rounded-lg shadow-md p-6 pr-10 w-full mb-4">
    <div class="flex items-center gap-4">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
</div>
@endif

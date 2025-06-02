<h1>{{ $foodRecord->food_name }}</h1>
<p>{{ $foodRecord->calories }} kcal</p>

@if ($foodRecord->image_path)
    <img src="{{ asset('storage/' . $foodRecord->image_path) }}" class="img-fluid rounded" style="max-width: 300px;">
@endif

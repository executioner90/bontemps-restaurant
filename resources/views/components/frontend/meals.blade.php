<div class="grid lg:grid-cols-4 gap-6">
    @foreach($meals as $meal)
        <x-frontend.meals.block :meal="$meal"></x-frontend.meals.block>
    @endforeach
</div>

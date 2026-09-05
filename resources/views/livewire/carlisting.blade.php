<div>
    <div class="row">
        <!-- (Sidebar Filters) -->
        <div class="col-lg-3 mb-5">
            <div class="bg-white p-4 rounded shadow-sm border">
                <h4 class="h5 font-weight-bold mb-3 pb-2 border-bottom text-dark">Categories</h4>
                
                <div class="category-list">
                    @forelse($categories as $category)
                        <div class="custom-control custom-checkbox mb-2">
                            <input 
                                type="checkbox" 
                                class="custom-control-input" 
                                id="cat-{{ $category->id }}"
                                value="{{ $category->id }}"
                                wire:model.live="selectedCategories"
                            >
                            <label class="custom-control-label text-secondary cursor-pointer" for="cat-{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">No categories found.</p>
                    @endforelse
                </div>

                <!-- Clear filters button displays only when a category is selected-->
                @if(!empty($selectedCategories))
                    <button 
                        wire:click="$set('selectedCategories', [])" 
                        class="btn btn-sm btn-outline-danger btn-block mt-3"
                    >
                        Reset Filters
                    </button>
                @endif
            </div>
        </div>

        <!-- (Car Cards Grid) -->
        <div class="col-lg-9">
            <div class="row align-items-stretch">
                @forelse ($cars as $car)
                    <div class="col-md-6 col-lg-4 mb-4 d-flex">
                        <div class="listing d-flex flex-column h-100 w-100 bg-white rounded border overflow-hidden shadow-sm">
                            <div class="listing-img" style="height: 200px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->title }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                            </div>
                            <div class="listing-contents d-flex flex-column flex-grow-1 justify-content-between p-3">
                                <div>
                                    <h3 class="h6 font-weight-bold text-dark mb-2">{{ $car->title }}</h3>
                                    <div class="rent-price mb-3">
                                        @if ($car->discount_price && $car->discount_price > 0 && $car->discount_price < $car->price)
                                            <strong class="text-primary">${{ number_format($car->discount_price, 2) }}</strong>
                                            <del class="text-muted mr-1" style="font-size: 0.85rem;">${{ number_format($car->price, 2) }}</del>
                                        @else
                                            <strong>${{ number_format($car->price, 2) }}</strong>
                                        @endif
                                        <span class="mx-1">/</span>day
                                    </div>
                                    <div class="d-flex justify-content-between mb-3 border-bottom pb-2 text-muted small">
                                        <div class="listing-feature">
                                            <span class="caption">Luggage:</span>
                                            <span class="number font-weight-bold">{{ $car->luggage }}</span>
                                        </div>
                                        <div class="listing-feature">
                                            <span class="caption">Doors:</span>
                                            <span class="number font-weight-bold">{{ $car->doors }}</span>
                                        </div>
                                        <div class="listing-feature">
                                            <span class="caption">Passenger:</span>
                                            <span class="number font-weight-bold">{{ $car->passengers }}</span>
                                        </div>
                                    </div>
                                    <p class="text-secondary small mb-3">{{ Str::limit($car->content, 60) }}</p>
                                </div>
                                <div class="pt-2">
                                    <a href="{{ route('singlepage', $car) }}" class="btn btn-primary btn-sm w-100 text-center">Rent Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 bg-white rounded border">
                        <p class="text-muted mb-0">No active cars available for the selected categories.</p>
                    </div>
                @endforelse
            </div>

            <!-- Livewire Pagination Links -->
            @if ($cars->hasPages())
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $cars->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

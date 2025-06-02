@extends('layouts.admin')

@section('title', 'Недвижимость')

@section('content')
    <section class="section-single">
        <h1 data-ru="Наша недвижимость" data-en="Our property">
            Наша недвижимость
        </h1>
        
        <!-- Filter buttons -->
        <div class="property-filters">
            @foreach($categories as $category)
                <button class="filter-btn" data-filter="{{ $category->id }}">{{ $category->name }}</button>
            @endforeach
        </div>
    </section>

    @foreach($categories as $category)
        <section class="privacy-card category-block" data-category="{{ $category->id }}">
            <div class="news-item">
                <h2 class="section-title">{{ $category->name }}</h2><br>
            </div>
            <!-- Display subcategories and their properties -->
            @if($category->child->isNotEmpty())
                @foreach($category->child as $subcategory)
                    <div class="news-item">
                        <h3 class="subcategory-title">{{ $subcategory->name }}</h3><br>
                    </div>
                    @if($subcategory->properties->isNotEmpty())
                        <div class="properties-list" style="margin-left: 20px;">
                            @foreach($subcategory->properties as $property)
                                <div class="properties-container">
                                    <!-- Карточка недвижимости -->
                                    <div class="property-card">
                                        <div class="property-image-container">
                                            <!-- Swiper для слайдшоу -->
                                            <div class="swiper-container property-slider">
                                                <div class="swiper-wrapper">
                                                    @foreach ($property->images as $image)
                                                        <div class="swiper-slide">
                                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $property->title }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="swiper-pagination"></div>
                                            </div>
                                        </div>
                                        <div class="property-info">
                                            <h3 class="property-title">{{ $property->title }}</h3>
                                            <div class="property-address">{{ $property->address }}</div>
                                            <div class="property-details">{{ $property->description }}</div>
                                            <div class="property-price">{{ number_format($property->price, 2) }} ₽</div>
                                            <a class="request-btn" href="{{ route('property.form', ['property_id' => $property->id]) }}">Оставить заявку</a>
                                        </div>
                                        <form action="{{ route('admin.property.destroy', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button signin-button" style="margin-bottom: 20px; margin-top: 20px;" onclick="return confirm('Вы уверены?')">Удалить</button>
                                        </form>
                                    </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            @endif
        </section>
    @endforeach

    <section class="privacy-card">
        <div class="news-item">
            <h2 class="section-title">Форма для добавления недвижимости</h2><br>
        </div>

        <div class="info-container">
            <div class="contact-form">
                <form method="POST" action="{{ route('admin.property.create') }}" class="auth-form">
                    @csrf
                    <input type="hidden" name="longitude" id="longitude" value="">
                    <input type="hidden" name="latitude" id="latitude" value="">

                    <label for="title">Заголовок</label>
                    <input type="text" name="title" id="title" placeholder="Введите заголовок" required>
                    
                    <label for="address">Адрес</label>
                    <input type="text" id="address" name="address" placeholder="Введите адрес">
                    <div id="suggestions" class="suggestions"></div>
                    
                    <label for="photos">Фотографии</label>
                    <input type="file" 
                        name="photos[]" 
                        id="photos" 
                        multiple 
                        accept="image/*" 
                        required>
                    
                    <label for="description">Описание</label>
                    <textarea name="description" id="description" placeholder="Введите описание квартиры"></textarea>
                    
                    <label for="price">Цена</label>
                    <input 
                        type="number" 
                        name="price" 
                        step="0.01" 
                        min="0" 
                        placeholder="0.00"
                        class="form-control"
                    >

                    <label for="category_select">Категория</label>
                    <select name="category_select" id="category_select">
                        @foreach ($categories as $category)
                            <optgroup label="{{ $category->name }}">
                                @foreach ($category->child as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>

                    <button type="submit">Добавить недвижимость</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let swiperInstances = [];

        // Функция для уничтожения всех существующих слайдеров
        function destroyAllSwipers() {
            swiperInstances.forEach(swiper => {
                if (swiper && swiper.destroy) {
                    swiper.destroy(true, true);
                }
            });
            swiperInstances = [];
        }

        // Функция для инициализации слайдеров в видимых категориях
        function initSlidersInVisibleCategories() {
            // Сначала уничтожаем все существующие слайдеры
            destroyAllSwipers();
            
            // Находим все слайдеры в видимых категориях
            const visibleSliders = document.querySelectorAll('.category-block[style*="block"] .property-slider, .category-block:not([style*="none"]) .property-slider');
            
            visibleSliders.forEach(slider => {
                const swiper = new Swiper(slider, {
                    loop: true,
                    autoplay: {
                        delay: 3000, // увеличил задержку для лучшего восприятия
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: slider.querySelector('.swiper-pagination'), // ищем пагинацию внутри конкретного слайдера
                        clickable: true, // разрешил клики для удобства
                    },
                    allowTouchMove: true, // разрешил свайпы для мобильных устройств
                    slidesPerView: 1,
                    spaceBetween: 0,
                });
                
                swiperInstances.push(swiper);
            });
        }

        // Фильтрация категорий
        const filterButtons = document.querySelectorAll('.filter-btn');
        const categoryBlocks = document.querySelectorAll('.category-block');

        // По умолчанию показываем первую категорию
        if (filterButtons.length > 0 && categoryBlocks.length > 0) {
            filterButtons[0].classList.add('active');
            categoryBlocks.forEach((block, index) => {
                block.style.display = (index === 0) ? 'block' : 'none';
            });
            
            // Инициализируем слайдеры после установки видимости
            setTimeout(() => {
                initSlidersInVisibleCategories();
            }, 50);
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Сброс всех активных кнопок
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                // Переключение видимости категорий
                categoryBlocks.forEach(block => {
                    block.style.display = (block.getAttribute('data-category') === filter) ? 'block' : 'none';
                });

                // Реинициализация слайдеров с задержкой для корректного отображения
                setTimeout(() => {
                    initSlidersInVisibleCategories();
                }, 100);
            });
        });
    });
</script>

<script src="https://api-maps.yandex.ru/2.1/?suggest_apikey=09b9e539-de9d-4b8b-9591-1f57ed3d0e06&lang=ru_RU" type="text/javascript"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ymaps.ready(init);

        function init() {
            const suggestView = new ymaps.SuggestView('address');
            
            suggestView.events.add('select', function (e) {
                const selectedItem = e.get('item');
                const selectedText = selectedItem.value;

                ymaps.geocode().then(function (res) {
                    const firstGeoObject = res.geoObjects.get(0);
                    const coords = firstGeoObject.geometry.getCoordinates();

                    document.getElementById('longitude').value = coords[0].toFixed(6);
                    document.getElementById('latitude').value = coords[1].toFixed(6);
                });
            });
        }
    });
</script>

<style>
    .property-filters {
        display: flex;
        gap: 10px;
        margin-top: 40px;
        justify-content: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        padding: 8px 16px;
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .filter-btn:hover {
        background-color: #e0e0e0;
    }
    
    .filter-btn.active {
        background-color: #007bff;
        color: white;
        border-color: #0069d9;
    }
</style>
@endsection
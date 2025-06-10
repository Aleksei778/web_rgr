@extends('layouts.admin')

@section('title', 'Недвижимость')

@section('content')
    <section class="section-single">
        <h1 data-ru="Наша недвижимость" data-en="Our property">
            {{ __('property.title') }}
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
                    <div class="subcategory-section">
                        <div class="news-item">
                            <h3 class="subcategory-title">{{ $subcategory->name }}</h3><br>
                        </div>
                        @if($subcategory->properties->isNotEmpty())
                            <div class="properties-grid">
                                @foreach($subcategory->properties as $property)
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
                                        <form action="{{ route('admin.property.destroy', $property) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button signin-button delete-btn" onclick="return confirm('Вы уверены?')">Удалить</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
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
                <form method="POST" action="{{ route('admin.property.store') }}" class="auth-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="longitude" id="longitude" value="">
                    <input type="hidden" name="latitude" id="latitude" value="">

                    <label for="title">Заголовок</label>
                    <input type="text" name="title" id="title" placeholder="Введите заголовок" required>
                    
                    <label for="address">Адрес</label>
                    <input type="text" id="address" name="address" placeholder="Введите адрес">
                    <div id="suggestions" class="suggestions"></div>
                    
                    <label for="photos">Фотографии (минимум 2)</label>
                    <div class="file-upload-container">
                        <input type="file" 
                            name="photos[]" 
                            id="photos" 
                            accept="image/*" 
                            multiple
                            required>
                        <div id="file-preview" class="file-preview"></div>
                        <div id="file-count" class="file-count">Файлы не выбраны</div>
                    </div>
                                    
                    <label for="description">Описание</label>
                    <textarea name="description" id="description" placeholder="Введite описание квартиры"></textarea>
                    
                    <label for="price">Цена</label>
                    <input 
                        type="number" 
                        id="price"
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
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: slider.querySelector('.swiper-pagination'),
                        clickable: true,
                    },
                    allowTouchMove: true,
                    slidesPerView: 1,
                    spaceBetween: 0,
                });
                
                swiperInstances.push(swiper);
            });
        }

        // Обработка множественной загрузки файлов
        const fileInput = document.getElementById('photos');
        const filePreview = document.getElementById('file-preview');
        const fileCount = document.getElementById('file-count');

        fileInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            
            // Очищаем предыдущий предварительный просмотр
            filePreview.innerHTML = '';
            
            if (files.length === 0) {
                fileCount.textContent = 'Файлы не выбраны';
                return;
            }
            
            fileCount.textContent = `Выбрано файлов: ${files.length}`;
            
            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'preview-item';
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}">
                            <span class="file-name">${file.name}</span>
                        `;
                        filePreview.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

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

<script src="https://api-maps.yandex.ru/2.1/?apikey=eaa2acca-c4a1-45de-a856-c8eb87ff74a4&lang=ru_RU&suggest_apikey=09b9e539-de9d-4b8b-9591-1f57ed3d0e06" type="text/javascript"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ymaps.ready(init);

        function init() {
            const suggestView = new ymaps.SuggestView('address');
            
            suggestView.events.add('select', function (e) {
                const selectedItem = e.get('item');
                const selectedText = selectedItem.value;

                ymaps.geocode(selectedText).then(function (res) {
                    const firstGeoObject = res.geoObjects.get(0);
                    const coords = firstGeoObject.geometry.getCoordinates();

                    console.log(coords);

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

    /* Сетка для размещения 3 карточек в ряд */
    .properties-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
        margin: 20px 0;
        max-width: 100%;
    }

    /* На больших экранах принудительно показываем максимум 3 колонки */
    @media (min-width: 1200px) {
        .properties-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* На средних экранах - 2 колонки */
    @media (max-width: 1199px) and (min-width: 768px) {
        .properties-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* На маленьких экранах - 1 колонка */
    @media (max-width: 767px) {
        .properties-grid {
            grid-template-columns: 1fr;
        }
    }

    .property-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .property-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .property-image-container {
        height: 200px;
        overflow: hidden;
    }

    .property-slider img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .property-info {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .property-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #333;
    }

    .property-address {
        color: #666;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .property-details {
        color: #777;
        margin-bottom: 10px;
        font-size: 14px;
        flex-grow: 1;
    }

    .property-price {
        font-size: 20px;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 15px;
    }

    .request-btn {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 4px;
        text-align: center;
        transition: background-color 0.3s;
        margin-bottom: 10px;
    }

    .request-btn:hover {
        background-color: #0056b3;
        text-decoration: none;
        color: white;
    }

    .delete-btn {
        margin-bottom: 20px !important;
        margin-top: 10px !important;
        width: 100%;
    }

    /* Стили для подкатегорий - каждая с новой строки */
    .subcategory-section {
        width: 100%;
        margin-bottom: 30px;
    }

    .subcategory-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
    }

    /* Стили для загрузки файлов */
    .file-upload-container {
        margin: 10px 0;
    }

    .file-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 10px;
        margin: 15px 0;
    }

    .preview-item {
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
        background: #f9f9f9;
    }

    .preview-item img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        margin-bottom: 5px;
    }

    .file-name {
        font-size: 12px;
        color: #666;
        word-break: break-word;
    }

    .file-count {
        font-size: 14px;
        color: #007bff;
        margin-top: 5px;
        font-weight: bold;
    }

    /* Улучшение отображения на мобильных устройствах */
    @media (max-width: 480px) {
        .property-card {
            margin-bottom: 15px;
        }
        
        .properties-grid {
            gap: 15px;
        }
        
        .file-preview {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection
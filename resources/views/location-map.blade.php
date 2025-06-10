@extends('layouts.app')

@section('title', 'Схема проезда')

@section('content')
    <section class='section-single'>
        <h1 data-ru="Схема проезда"
            data-en="Latest news from the real estate world">
            {{ __('dir.schema') }}
        </h1>
        <p>
            {{ __('dir.offices') }}:<br>
            {{ __('dir.first_office') }}<br>
            {{ __('dir.second_office') }}
        </p>
    </section>

    <div class="container">
        <div id="map" style="width: 100%; height: 900px;"></div>
    </div>
@endsection

@section('scripts')
<script src="https://api-maps.yandex.ru/2.1/?apikey=eaa2acca-c4a1-45de-a856-c8eb87ff74a4&lang=ru_RU" type="text/javascript"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map", {
                center: [55.7558, 37.6173],
                zoom: 12
            });

            var officePlacemark1 = new ymaps.Placemark(
                [55.7499, 37.5375],
                { hintContent: 'Офис компании', balloonContent: 'Москва, Пресненская наб., д. 12' },
                { preset: 'islands#greenDotIcon' }
            );
            var officePlacemark2 = new ymaps.Placemark(
                [55.7903, 37.5488],
                { hintContent: 'Офис компании', balloonContent: 'Москва, Ленинградский пр., д. 36' },
                { preset: 'islands#greenDotIcon' }
            );

            myMap.geoObjects.add(officePlacemark1);
            myMap.geoObjects.add(officePlacemark2);

            // Передаем адреса из PHP в JavaScript
            var addresses = @json($addresses);

            addresses.forEach(function(address) {
                console.log(address.title);
                var propertyPlacemark = new ymaps.Placemark(
                    [address.latitude, address.longitude], // Исправленный порядок координат
                    { hintContent: 'Недвижимость', balloonContent: address.title },
                    { preset: 'islands#redDotIcon' }
                );
                myMap.geoObjects.add(propertyPlacemark);
            });

            // Добавляем элементы управления
            myMap.controls.add('zoomControl');
            myMap.controls.add('typeSelector');
            myMap.controls.add('routeButtonControl');
        }
    });
</script>
@endsection

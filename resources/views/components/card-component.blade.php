{{-- Componente que se utiliza para "envolver" a otros. El primer div sirve para asignar una columna, y el segundo para dar la clase "card" al contenido. La variable $slot es donde iria el contenido a envolver cuando se utiliza el componente. --}}
<div class="col">
    <div class="card">
    {{$slot}}
    </div>
</div>
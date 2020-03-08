@component('mail::message')
# Sua lista de Favoritos

Olá, {{ $userName }}, segue abaixo sua lista de favoritos atualizada

<strong>Lista de Favoritos</strong>
@if(count($favorites) > 0)
    <ul>
        @foreach($favorites as $fav)
            <li>{{$fav->title}}</li>
        @endforeach
    </ul>
@else
    <h3>Nenhum item na sua lista de favoritos</h3>
@endif

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent

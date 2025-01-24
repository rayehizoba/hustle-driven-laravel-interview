<div class="h-full grid place-content-center">
    <ul class="grid grid-cols-3 border border-black dark:border-white">
        @foreach ($grid as $rowIndex => $row)
            @foreach ($row as $colIndex => $color)
                <li
                    class="border border-black dark:border-white w-52 aspect-square cursor-pointer"
                    style="background-color: {{ $color === 'B' ? '#93c5fd' : '#fca5a5' }};"
                    wire:click="toggleSquare({{ $rowIndex }}, {{ $colIndex }})"
                ></li>
            @endforeach
        @endforeach
    </ul>
</div>

<?php

namespace App\Livewire;

use Livewire\Component;

class ScreenThree extends Component
{
    public string $state = '';
    protected array $queryString = ['state'];

    public function mount(): void
    {
        if (empty($this->state)) {
            $this->state = $this->generateInitialState();
        }
    }

    public function render()
    {
        return view('livewire.screen-three', [
            'grid' => $this->parseState($this->state),
        ]);
    }

    public function toggleSquare(int $row, int $col): void
    {
        $grid = $this->parseState($this->state);

        $currentColor = $grid[$row][$col];
        $newColor = $currentColor === 'B' ? 'R' : 'B';

        // Toggle the clicked square
        $grid[$row][$col] = $newColor;

        // Change adjacent squares of the opposite color
        foreach ([[-1, 0], [1, 0], [0, -1], [0, 1]] as [$dr, $dc]) {
            $adjRow = $row + $dr;
            $adjCol = $col + $dc;

            if (
                isset($grid[$adjRow][$adjCol]) &&
                $grid[$adjRow][$adjCol] !== $newColor
            ) {
                $grid[$adjRow][$adjCol] = $newColor;
            }
        }

        // Update the state string
        $this->state = $this->stringifyState($grid);
    }

    private function generateInitialState(): string
    {
        // Generate a randomized 3x3 grid state as a string (e.g., "BRRBRBBRR")
        $colors = ['B', 'R'];
        $grid = array_map(fn() => $colors[array_rand($colors)], range(1, 9));

        return implode('', $grid);
    }

    private function parseState(string $state): array
    {
        // Convert a string state like "BRRBRBBRR" to a 3x3 grid array
        return array_chunk(str_split($state), 3);
    }

    private function stringifyState(array $grid): string
    {
        // Convert a 3x3 grid array back to a string state
        return implode('', array_merge(...$grid));
    }
}

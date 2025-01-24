<?php

namespace App\Livewire;

use Livewire\Component;

class ScreenTwo extends Component
{
    public string $search = '';
    public int $page = 1;
    public int $resultIndex = -1;

    protected array $queryString = ['search', 'page'];

    public ?string $photoUrl = null;
    public ?string $photoDescription = null;
    public array $results = [];
    public int $totalResults = 0;
    public int $totalPages = 0;

    public function mount(): void
    {
        $this->handleSearch();
    }

    public function render()
    {
        return view('livewire.screen-two');
    }

    /**
     * Perform a search and update results.
     */
    public function handleSearch(): void
    {
        if (empty($this->search)) {
            $this->resetPage();
            return;
        }

        $this->fetchPageResults();
        $this->loadNextPhoto();
    }

    /**
     * Fetch the current page's results.
     */
    private function fetchPageResults(): void
    {
        $pageResult = \Unsplash\Search::photos($this->search, $this->page);

        $this->results = $pageResult->getResults();
        $this->totalResults = $pageResult->getTotal();
        $this->totalPages = $pageResult->getTotalPages();
        $this->resultIndex = -1; // Reset the index for the new page.
    }

    /**
     * Reset the search and pagination data.
     */
    public function resetPage(): void
    {
        $this->search = '';
        $this->page = 1;
        $this->results = [];
        $this->photoUrl = null;
        $this->photoDescription = null;
        $this->resultIndex = -1;
    }

    /**
     * Load the previous photo or fetch the previous page if needed.
     */
    public function handlePrevious(): void
    {
        $this->resultIndex--;

        if ($this->resultIndex < 0) {
            if ($this->page > 1) {
                $this->page--;
                $this->fetchPageResults();
                $this->resultIndex = count($this->results) - 1;
            } else {
                $this->resultIndex = -1;
                $this->photoUrl = null;
                $this->photoDescription = 'No previous photos available.';
                return;
            }
        }

        $this->loadPhoto();
    }

    /**
     * Load the next photo or fetch the next page if needed.
     */
    public function handleNext(): void
    {
        $this->resultIndex++;

        if ($this->resultIndex >= count($this->results)) {
            if ($this->page < $this->totalPages) {
                $this->page++;
                $this->fetchPageResults();
                $this->resultIndex = 0;
            } else {
                $this->resultIndex = -1;
                $this->photoUrl = null;
                $this->photoDescription = 'No more photos available.';
                return;
            }
        }

        $this->loadPhoto();
    }

    /**
     * Load the photo at the current result index.
     */
    private function loadPhoto(): void
    {
        $photo = $this->results[$this->resultIndex] ?? null;

        if ($photo) {
            $this->photoUrl = $photo['urls']['full'] ?? null;
            $this->photoDescription = $photo['alt_description'] ?? 'No description available.';
        } else {
            $this->photoUrl = null;
            $this->photoDescription = 'No photo available.';
        }
    }

    /**
     * Load the next photo, or reset if no results are available.
     */
    private function loadNextPhoto(): void
    {
        if (!empty($this->results)) {
            $this->handleNext();
        } else {
            $this->photoUrl = null;
            $this->photoDescription = 'No photos found. Try a different search.';
        }
    }
}

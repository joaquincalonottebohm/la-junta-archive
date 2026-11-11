
/**
 * LA Junta Archive — Artist Search & Filters
 */

document.addEventListener('DOMContentLoaded', () => {

  const page = document.querySelector('.discover-artists-page');

  if (!page) return;

  const searchInput = page.querySelector('#artist-search');
  const countryFilter = page.querySelector('#artist-country');
  const disciplineFilter = page.querySelector('#artist-discipline');
  const clearButton = page.querySelector('#artist-clear-filters');

  const cards = Array.from(
    page.querySelectorAll('.discover-artists-page__grid-item')
  );

  const status = page.querySelector('#artist-filter-status');
  const noResults = page.querySelector('#artist-no-results');

  // Normalize text for case- and accent-insensitive search

  function normalize(value) {
    return String(value || '')
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .toLowerCase()
      .trim();
  }

  // Apply search and filters

  function filterArtists() {

    const search = normalize(searchInput.value);
    const country = normalize(countryFilter.value);
    const discipline = normalize(disciplineFilter.value);

    const hasFilters = Boolean(search || country || discipline);

    let visibleCount = 0;

    cards.forEach(card => {

      const artistName = normalize(card.dataset.artistName);
      const artistCountry = normalize(card.dataset.country);
      const artistDiscipline = normalize(card.dataset.discipline);

      const matchesSearch = artistName.includes(search);

      const matchesCountry =
        !country || artistCountry === country;

      const matchesDiscipline =
        !discipline || artistDiscipline === discipline;

      const isVisible =
        matchesSearch &&
        matchesCountry &&
        matchesDiscipline;

      card.hidden = !isVisible;

      if (isVisible) {
        visibleCount++;
      }

    });

    // Show feedback only when filtering

    if (hasFilters) {
      status.textContent =
        `${visibleCount} ${visibleCount === 1 ? 'artist' : 'artists'} found.`;
    } else {
      status.textContent = '';
    }

    noResults.hidden = visibleCount > 0 || cards.length === 0;
    clearButton.hidden = !hasFilters;

  }

  // Event listeners

  searchInput.addEventListener('input', filterArtists);

  countryFilter.addEventListener('change', filterArtists);

  disciplineFilter.addEventListener('change', filterArtists);

  // Clear all filters

  clearButton.addEventListener('click', () => {

    searchInput.value = '';
    countryFilter.value = '';
    disciplineFilter.value = '';

    filterArtists();

    searchInput.focus();

  });

  // Initialize

  filterArtists();

});

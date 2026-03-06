function debounce(fn, delay) {
  let t;
  return (...args) => {
    clearTimeout(t);
    t = setTimeout(() => fn(...args), delay);
  };
}

document.addEventListener("DOMContentLoaded", () => {
  // Rechercher AJAX
  const searchInput = document.querySelector("#searchInput");
  const results = document.querySelector("#results");
  if (searchInput && results) {
    const run = debounce(async () => {
      const q = searchInput.value.trim();
      const res = await fetch("ajax/search.php?q=" + encodeURIComponent(q));
      results.innerHTML = await res.text();
    }, 300);
    searchInput.addEventListener("input", run);
    run();
  }

  // Select all (export sélection)
  const checkAll = document.querySelector("#checkAll");
  if (checkAll) {
    checkAll.addEventListener("change", () => {
      document.querySelectorAll(".rowCheck").forEach(cb => cb.checked = checkAll.checked);
    });
  }
});
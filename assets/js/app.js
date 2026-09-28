document.addEventListener('DOMContentLoaded', () => {
  const search = document.querySelector('#courseSearch');
  const results = document.querySelector('#courseResults');

  if (search && results) {
    let timer;
    search.addEventListener('input', () => {
      clearTimeout(timer);
      timer = setTimeout(async () => {
        const q = encodeURIComponent(search.value.trim());
        const res = await fetch(`ajax/search_courses.php?q=${q}`);
        results.innerHTML = await res.text();
      }, 250);
    });
  }
});

// Handle SPA navigation
document.querySelectorAll('[data-page]').forEach(link => {
  link.addEventListener('click', async (e) => {
    e.preventDefault();
    const page = e.target.getAttribute('data-page');
    try {
      // adjust the path for Live Server (from index.html location)
      const response = await fetch(`views/${page}.html`);
      if (!response.ok) throw new Error('Page not found');
      const html = await response.text();
      document.getElementById('content').innerHTML = html;
    } catch (err) {
      document.getElementById('content').innerHTML = `<p class="text-danger">⚠️ Failed to load page: ${page}</p>`;
      console.error(err);
    }
  });
});

// Load default page on startup
window.addEventListener('DOMContentLoaded', async () => {
  try {
    const response = await fetch('views/dashboard.html');
    const html = await response.text();
    document.getElementById('content').innerHTML = html;
  } catch {
    document.getElementById('content').innerHTML = '<p class="text-danger">⚠️ Failed to load default page.</p>';
  }
});


function loadView(viewName) {
    fetch(`views/${viewName}.html`)
        .then(res => {
            if (!res.ok) throw new Error('View not found');
            return res.text();
        })
        .then(html => {
            document.getElementById('app').innerHTML = html;
        })
        .catch(err => {
            document.getElementById('app').innerHTML = `<h2>Error: ${err.message}</h2>`;
            console.error(err);
        });
}


loadView('dashboard');

document.querySelectorAll('.navbar-links a, .navbar-brand').forEach(link => {
    link.addEventListener('click', e => {
        e.preventDefault();
        const page = e.target.closest('[data-page]').dataset.page;
        if (page) loadView(page);
    });
});


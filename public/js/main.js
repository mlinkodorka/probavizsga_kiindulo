// main.js
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('szakdoga-container');

    Ajax.get('/api/szakdoga').then(data => {
        data.forEach(item => {
            const szakdoga = new Szakdoga(item.id, item.title, item.description);
            container.appendChild(szakdoga.render());
        });
    });
});
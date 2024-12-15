// szakdoga.js
class Szakdoga {
    constructor(id, title, description) {
        this.id = id;
        this.title = title;
        this.description = description;
    }

    render() {
        const container = document.createElement('div');
        container.innerHTML = `
            <h3>${this.title}</h3>
            <p>${this.description}</p>
            <button class="edit">Edit</button>
            <button class="delete">Delete</button>
        `;

        container.querySelector('.delete').addEventListener('click', () => {
            this.delete();
        });

        container.querySelector('.edit').addEventListener('click', () => {
            this.edit();
        });

        return container;
    }

    delete() {
        Ajax.delete(`/api/szakdoga/${this.id}`).then(() => {
            alert('Deleted successfully');
            // Optionally, remove the element from the DOM
        });
    }

    edit() {
        // Populate form with current data
        document.getElementById('title').value = this.title;
        document.getElementById('description').value = this.description;
        document.getElementById('save').addEventListener('click', () => {
            this.save();
        });
    }

    save() {
        const updatedData = {
            title: document.getElementById('title').value,
            description: document.getElementById('description').value
        };

        Ajax.put(`/api/szakdoga/${this.id}`, updatedData).then(() => {
            alert('Updated successfully');
            // Optionally, update the element in the DOM
        });
    }
}
// ajax.js
class Ajax {
    static request(method, url, data = null) {
        return fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json'
            },
            body: data ? JSON.stringify(data) : null
        }).then(response => response.json());
    }

    static get(url) {
        return this.request('GET', url);
    }

    static post(url, data) {
        return this.request('POST', url, data);
    }

    static put(url, data) {
        return this.request('PUT', url, data);
    }

    static delete(url) {
        return this.request('DELETE', url);
    }
}
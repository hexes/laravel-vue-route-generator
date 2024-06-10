import { routes } from '../routes';

export default function route(name, params = {}) {
    let path = routes[name] || '#';

    // Replace placeholders with actual values from params
    Object.keys(params).forEach(key => {
        path = path.replace(`{${key}}`, params[key]);
    });

    return path;
}
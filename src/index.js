export const routes = {

};

export default function route(name) {
    return routes[name] || '#';
}
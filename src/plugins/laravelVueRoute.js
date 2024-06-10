import route from '../examples/services/routeService';

export default {
  install(app) {
    app.config.globalProperties.route = route;
  }
};
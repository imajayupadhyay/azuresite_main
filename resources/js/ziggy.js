const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"admin.login":{"uri":"admin\/azureskill-secure-login","methods":["GET","HEAD"]},"admin.login.post":{"uri":"admin\/azureskill-secure-login","methods":["POST"]},"admin.dashboard":{"uri":"admin\/dashboard","methods":["GET","HEAD"]},"admin.logout":{"uri":"admin\/logout","methods":["POST"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };

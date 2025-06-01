const WebSocket = require('ws');
const http = require('http');

const wss = new WebSocket.Server({ noServer: true });
const clients = new Set();

wss.on('connection', function connection(ws) {
  clients.add(ws);
  console.log('Client connected');

  ws.on('close', () => {
    clients.delete(ws);
    console.log('Client disconnected');
  });
});

const server = http.createServer((req, res) => {
  if (req.method === 'POST' && req.url === '/broadcast') {
    let body = '';
    req.on('data', chunk => { body += chunk; });
    req.on('end', () => {
      try {
        const data = JSON.parse(body);

        // Envoie à la cuisine
        clients.forEach(client => {
          if (client.readyState === WebSocket.OPEN) {
            client.send(JSON.stringify(data));
          }
        });

        res.writeHead(200, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify({ status: 'ok' }));
      } catch (e) {
        res.writeHead(400);
        res.end('Invalid JSON');
      }
    });
  }  else if (req.url === '/waiter' && req.url === '/broadcast') {

  } else if (req.url === '/ws') {
    wss.handleUpgrade(req, req.socket, Buffer.alloc(0), onSocketConnect);
  } else {
    res.writeHead(404);
    res.end();
  }
});

function onSocketConnect(ws) {
  wss.emit('connection', ws);
}

server.listen(8765, () => {
  console.log('HTTP + WebSocket server started on port 8765');
});

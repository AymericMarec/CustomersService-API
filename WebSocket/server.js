const WebSocket = require('ws');
const http = require('http');

const wss = new WebSocket.Server({ noServer: true });
const clients = new Set();

wss.on('connection', function connection(ws) {
  ws.role = null;
  clients.add(ws);
  console.log('Client connected');

  ws.on('message', msg => {
    try {
      const data = JSON.parse(msg);
      if (data.type === 'register' && data.role) {
        ws.role = data.role; // "kitchen" ou "waiter"
        console.log(`Client registered as ${ws.role}`);
      }
    } catch (e) {
      console.error('Invalid registration message');
    }
  });

  ws.on('close', () => {
    clients.delete(ws);
    console.log('Client disconnected');
  });
});

function broadcastTo(role, data) {
  clients.forEach(client => {
    if (client.readyState === WebSocket.OPEN && client.role === role) {
      client.send(JSON.stringify(data));
    }
  });
}

const server = http.createServer((req, res) => {
  if (req.method === 'POST' && (req.url === '/kitchen' || req.url === '/waiter')) {
    let body = '';
    req.on('data', chunk => { body += chunk; });
    req.on('end', () => {
      try {
        const data = JSON.parse(body);
        const role = req.url.substring(1); 
        broadcastTo(role, data);

        res.writeHead(200, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify({ status: 'ok' }));
      } catch (e) {
        res.writeHead(400);
        res.end('Invalid JSON');
      }
    });
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

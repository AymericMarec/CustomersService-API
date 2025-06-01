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
        ws.role = data.role;
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
  console.log(`Received ${req.method} request for ${req.url}`);

  if (req.method === 'POST' && (req.url === '/kitchen' || req.url === '/waiter')) {
    let body = '';
    req.on('data', chunk => { body += chunk; });
    req.on('end', () => {
      try {
        const data = JSON.parse(body);
        const role = req.url.substring(1); // 'kitchen' ou 'waiter'
        broadcastTo(role, data);

        res.writeHead(200, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify({ status: 'ok' }));
      } catch (e) {
        console.error(e);
        res.writeHead(400);
        res.end('Invalid JSON');
      }
    });
  } 
});

server.on('upgrade', (request, socket, head) => {
  if (request.url === '/ws') {
    wss.handleUpgrade(request, socket, head, (ws) => {
      wss.emit('connection', ws, request);
    });
  } else {
    socket.destroy();
  }
});

server.listen(8765, () => {
  console.log('HTTP + WebSocket server started on port 8765');
});

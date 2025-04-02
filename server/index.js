const express = require('express');
const path = require('path');
const uploadRouter = require('./upload');

const app = express();
const PORT = 3000;

// Middleware to serve static files
app.use(express.static(path.join(__dirname, '..', 'public')));

// Use the upload router
app.use('/upload', uploadRouter);

// Serve the frontend
app.get('*', (req, res) => {
  res.sendFile(
    path.join(__dirname, '..', 'src', 'View', 'etudiants', 'dashboard2.html')
  );
});

// Start the server
app.listen(PORT, () => {
  console.log(`Server is running at http://localhost:${PORT}`);
});

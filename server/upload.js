const express = require('express');
const multer = require('multer');
const fs = require('fs');
const path = require('path');
const cors = require('cors'); // Import CORS

const router = express.Router();

// Enable CORS
router.use(cors());

// Middleware pour gérer les fichiers
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    const folder = req.body.folder;
    const uploadPath = path.join(__dirname, '..', 'uploads', folder);

    // Crée le dossier s'il n'existe pas
    if (!fs.existsSync(uploadPath)) {
      fs.mkdirSync(uploadPath, { recursive: true });
    }

    cb(null, uploadPath);
  },
  filename: (req, file, cb) => {
    cb(null, req.body.newFileName);
  },
});

const upload = multer({ storage });

// Route pour téléverser les fichiers
router.post('/upload', upload.single('file'), (req, res) => {
  res.status(200).send('Fichier téléversé avec succès.');
});

module.exports = router;

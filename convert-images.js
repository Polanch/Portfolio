import sharp from 'sharp';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const imagesDir = path.join(__dirname, 'storage', 'app', 'profile_pictures');

fs.readdir(imagesDir, async (err, files) => {
    if (err) {
        console.error('Error reading images directory:', err);
        return;
    }

    for (const file of files) {
        const ext = path.extname(file).toLowerCase();
        if (['.jpg', '.jpeg', '.png', '.gif'].includes(ext)) {
            const inputPath = path.join(imagesDir, file);
            const outputPath = path.join(imagesDir, path.basename(file, ext) + '.webp');

            try {
                await sharp(inputPath)
                    .webp({ quality: 95 })
                    .toFile(outputPath);
                console.log(`✓ Converted: ${file} → ${path.basename(outputPath)}`);
            } catch (error) {
                console.error(`✗ Failed to convert ${file}:`, error.message);
            }
        }
    }
});


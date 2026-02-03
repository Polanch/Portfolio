import fs from 'fs';
import path from 'path';
import { cwebp } from 'webp-converter';

const imagesDir = path.join(process.cwd(), 'public', 'images');

fs.readdir(imagesDir, (err, files) => {
    if (err) {
        console.error('Error reading images directory:', err);
        return;
    }
    files.forEach(file => {
        const ext = path.extname(file).toLowerCase();
        if (ext === '.jpg' || ext === '.jpeg' || ext === '.png') {
            const inputPath = path.join(imagesDir, file);
            const outputPath = path.join(imagesDir, path.basename(file, ext) + '.webp');
            cwebp(inputPath, outputPath, "-q 80", (status, error) => {
                if (status === '100') {
                    console.log(`Converted: ${file} -> ${path.basename(outputPath)}`);
                } else {
                    console.error(`Failed to convert ${file}:`, error);
                }
            });
        }
    });
});

const fs = require('fs');
const path = require('path');

const dir = path.join(__dirname, 'resources', 'views', 'public');
const files = fs.readdirSync(dir).filter(f => f.endsWith('.blade.php'));

for (const file of files) {
    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');
    
    // Replace old Zehanat colors with new Engitech colors/classes
    content = content.replace(/#0c5adb/g, '#43baff');
    content = content.replace(/#182433/g, '#1b1d21');
    content = content.replace(/bg-blue-600/g, 'bg-primary');
    content = content.replace(/text-blue-600/g, 'text-primary');
    content = content.replace(/border-blue-600/g, 'border-primary');
    
    fs.writeFileSync(filePath, content, 'utf8');
    console.log(`Updated ${file}`);
}

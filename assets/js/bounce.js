document.addEventListener('DOMContentLoaded', function() {
    const dog = document.querySelector('.bouncing-dog');
    const dogSize = 50;  // Changed from 150 to match actual dog size
    const buffer = 100;  // Added buffer space for better bouncing
    let x = Math.random() * (window.innerWidth - dogSize - buffer);
    let y = Math.random() * (window.innerHeight - dogSize - buffer);
    let speedX = 1.5;  // Adjusted for smoother movement
    let speedY = 1.5;

    // Handle window resize
    window.addEventListener('resize', function() {
        x = Math.min(x, window.innerWidth - dogSize - buffer);
        y = Math.min(y, window.innerHeight - dogSize - buffer);
    });

    function animate() {
        // Update position
        x += speedX;
        y += speedY;

        // Check for collision with edges
        if (x <= buffer || x >= window.innerWidth - dogSize - buffer) {
            speedX = -speedX;
        }
        if (y <= buffer || y >= window.innerHeight - dogSize - buffer) {
            speedY = -speedY;
        }

        // Keep within bounds
        x = Math.max(buffer, Math.min(x, window.innerWidth - dogSize - buffer));
        y = Math.max(buffer, Math.min(y, window.innerHeight - dogSize - buffer));

        // Apply the position
        dog.style.left = x + 'px';
        dog.style.top = y + 'px';

        requestAnimationFrame(animate);
    }

    animate();
}); 
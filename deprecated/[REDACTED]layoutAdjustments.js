document.addEventListener('DOMContentLoaded', function () {
    // Get all the top and bottom sections
    const topSections = document.querySelectorAll('.top');
    const bottomSections = document.querySelectorAll('.bottom');

    // Function to set the same height for all sections in a row
    const setEqualHeight = (sections) => {
        let maxHeight = 0;
        sections.forEach((section) => {
            section.style.height = 'auto'; // Reset height before calculating
            const sectionHeight = section.offsetHeight;
            maxHeight = Math.max(maxHeight, sectionHeight);
        });
        sections.forEach((section) => {
            section.style.height = `${maxHeight}px`;
        });
    };

    // Set equal heights for both rows
    setEqualHeight(topSections);
    setEqualHeight(bottomSections);
});

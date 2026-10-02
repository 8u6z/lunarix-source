document.addEventListener('DOMContentLoaded', () => {
    const phrases = ["LUNARIX at your hands.", "The Perfect Player base.", "A Smart community.", "Huge Amounts of Clients.", "User Freedom."];
    const typingElement = document.getElementById('typing-text');
    const typingSpeed = 100;
    const deletingSpeed = 75;
    const delayBeforeNextPhrase = 3500;
    let phraseIndex = 0;
    let charIndex = 0;

    function type() {
        const currentPhrase = phrases[phraseIndex];
        
        if (charIndex < currentPhrase.length) {
            typingElement.textContent += currentPhrase.charAt(charIndex);
            charIndex++;
            setTimeout(type, typingSpeed);
        } else {
            setTimeout(erase, delayBeforeNextPhrase);
        }
    }

    function erase() {
        const currentPhrase = phrases[phraseIndex];
        
        if (charIndex > 0) {
            typingElement.textContent = currentPhrase.substring(0, charIndex - 1);
            charIndex--;
            setTimeout(erase, deletingSpeed);
        } else {
            phraseIndex = (phraseIndex + 1) % phrases.length;
            setTimeout(type, 500); 
        }
    }
    typingElement.classList.add('border-end', 'border-5', 'border-white'); 
    type();
});
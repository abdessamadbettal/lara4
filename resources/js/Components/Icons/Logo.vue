<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        class="logo-svg text-gray-800 dark:text-red-400 h-16 transition-all duration-500 hover:rotate-1 focus:outline-none"
        viewBox="0 0 280 100"
        aria-label="Lara4 Logo"
        tabindex="0"
        role="img"
    >
        <!-- Enhanced gradients with more vibrant colors -->
        <defs>
            <linearGradient id="mainGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color: #EF4444; stop-opacity: 1" />
                <stop offset="50%" style="stop-color: #E11D48; stop-opacity: 1" />
                <stop offset="100%" style="stop-color: #DC2626; stop-opacity: 0.9" />
            </linearGradient>
            <linearGradient id="numberGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color: #6366F1; stop-opacity: 1" />
                <stop offset="50%" style="stop-color: #4F46E5; stop-opacity: 1" />
                <stop offset="100%" style="stop-color: #4338CA; stop-opacity: 0.9" />
            </linearGradient>
            <!-- Improved glow filter with better light diffusion -->
            <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                <feGaussianBlur in="SourceGraphic" stdDeviation="3" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="glow" />
                <feBlend in="SourceGraphic" in2="glow" mode="normal" />
            </filter>
            <!-- New subtle texture overlay -->
            <pattern id="subtle-pattern" width="10" height="10" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
                <rect width="10" height="10" fill="none"/>
                <path d="M0,0 L1,0 L1,1 L0,1 Z" fill="currentColor" class="opacity-[0.03]"/>
            </pattern>
        </defs>

        <!-- Background with subtle texture -->
        <rect x="5" y="10" width="270" height="70" fill="url(#subtle-pattern)" rx="8" class="backdrop" />
        
        <!-- Code pattern lines for decoration with subtle motion -->
        <g class="code-lines">
            <line x1="8" y1="32" x2="272" y2="32" class="stroke-current opacity-5 code-line" stroke-width="0.5" />
            <line x1="8" y1="42" x2="272" y2="42" class="stroke-current opacity-5 code-line" stroke-width="0.5" />
            <line x1="8" y1="52" x2="272" y2="52" class="stroke-current opacity-5 code-line" stroke-width="0.5" />
        </g>
        
        <!-- Main text with improved animations -->
        <g class="main-text">
            <text
                x="15"
                y="52"
                font-family="'JetBrains Mono', monospace"
                font-weight="700"
                font-size="42"
                letter-spacing="-1"
                class="tracking-tight text-group"
            >
                <tspan fill="url(#mainGradient)" class="text-lara">
                    Lara</tspan
                ><tspan fill="url(#numberGradient)" class="text-number fill-black dark:fill-white"
                    >4</tspan
                >
            </text>
        </g>

        <!-- Animated dots repositioned to be closer to Lara4 -->
        <g class="loading-dots">
            <circle cx="125" cy="52" r="2" class="fill-current dot dot-1" />
            <circle cx="133" cy="52" r="2" class="fill-current dot dot-2" />
            <circle cx="141" cy="52" r="2" class="fill-current dot dot-3" />
        </g>

        <!-- Enhanced tagline with code tags and typewriter effect -->
        <g class="tagline-container">
            <text
                x="17"
                y="80"
                font-family="'JetBrains Mono', monospace"
                font-size="11"
                class="fill-current opacity-90 tagline"
            >
                &lt;<tspan class="tag-name typewriter-text">Laravel starter kit</tspan>/&gt;
            </text>
        </g>
    </svg>
</template>

<script setup>
import { onMounted, onBeforeUnmount } from 'vue';

const slogans = [
    'Laravel starter kit',
    'Modern dev experience',
    'Full-stack solution',
    'Rapid prototyping',
    'Developer friendly'
];

let currentSloganIndex = 0;
let typewriterInterval;
let tagNameElement;

onMounted(() => {
    tagNameElement = document.querySelector('.typewriter-text');
    startTypewriterEffect();
});

onBeforeUnmount(() => {
    clearInterval(typewriterInterval);
});

function startTypewriterEffect() {
    let isTyping = true;
    let currentText = '';
    let currentPosition = 0;
    
    typewriterInterval = setInterval(() => {
        const currentSlogan = slogans[currentSloganIndex];
        
        if (isTyping) {
            // Typing phase
            currentText = currentSlogan.substring(0, currentPosition + 1);
            currentPosition++;
            
            if (currentPosition >= currentSlogan.length) {
                isTyping = false;
                // Pause at the end of typing
                setTimeout(() => {
                    isTyping = false;
                    currentPosition = currentSlogan.length;
                }, 1500);
            }
        } else {
            // Erasing phase
            currentText = currentSlogan.substring(0, currentPosition);
            currentPosition--;
            
            if (currentPosition < 0) {
                isTyping = true;
                currentPosition = 0;
                currentSloganIndex = (currentSloganIndex + 1) % slogans.length;
            }
        }
        
        if (tagNameElement) {
            tagNameElement.textContent = currentText;
        }
    }, 100);
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap');

/* Enhanced animations with more natural easing */
@keyframes slide-in {
    0% { 
        opacity: 0;
        transform: translateX(-15px);
    }
    100% { 
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes reveal {
    0% { 
        opacity: 0;
        transform: translateY(10px);
    }
    100% { 
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0%, 100% { 
        opacity: 0.4;
        transform: scale(0.9);
    }
    50% { 
        opacity: 1;
        transform: scale(1.2);
    }
}

@keyframes subtle-float {
    0%, 100% { 
        transform: translateY(0);
    }
    50% { 
        transform: translateY(-1.5px);
    }
}

@keyframes code-line-grow {
    0% { 
        stroke-dashoffset: 280;
    }
    100% { 
        stroke-dashoffset: 0;
    }
}

@keyframes fade-in {
    0% { 
        opacity: 0;
    }
    100% { 
        opacity: 0.03;
    }
}

@keyframes cursor-blink {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
}

/* Element animations */
.text-lara {
    animation: slide-in 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    transition: all 0.4s ease;
}

.text-number {
    animation: slide-in 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards;
    opacity: 0;
    transition: all 0.4s ease;
}

.backdrop {
    animation: fade-in 1s ease-out 0.5s forwards;
    opacity: 0;
}

.dot {
    animation: pulse 2s infinite;
    transform-origin: center;
}

.dot-1 {
    animation-delay: 0s;
}

.dot-2 {
    animation-delay: 0.4s;
}

.dot-3 {
    animation-delay: 0.8s;
}

.tagline {
    animation: reveal 0.8s ease-out 0.6s forwards;
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.typewriter-text::after {
    content: '|';
    animation: cursor-blink 1s infinite;
    font-weight: 100;
    color: currentColor;
}

.tag-name {
    transition: fill 0.3s ease;
}

.code-line {
    stroke-dasharray: 280;
    stroke-dashoffset: 280;
    animation: code-line-grow 1.2s ease-out 0.3s forwards;
}

/* Hover interactions */
.text-lara:hover, .text-number:hover {
    filter: url(#glow);
}

.main-text:hover .text-lara {
    transform: translateX(-2px) scale(1.02);
}

.main-text:hover .text-number {
    transform: translateX(2px) scale(1.08);
    fill: url(#numberGradient) !important;
}

.tagline:hover .tag-name {
    fill: #E11D48;
}

.tagline-container:hover .tagline {
    opacity: 1;
    transform: translateY(-2px);
}

/* Logo overall effects with improved focus states for accessibility */
.logo-svg {
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
}

.logo-svg:hover {
    filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.4));
    transform: rotate(1deg) scale(1.03);
}

.logo-svg:focus-visible {
    outline: 2px solid rgba(239, 68, 68, 0.5);
    outline-offset: 4px;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.25);
    transform: scale(1.03);
}

/* Enhanced loading dots behavior on hover */
.logo-svg:hover .loading-dots {
    transform: translateX(3px);
}

.logo-svg:hover .dot {
    animation-duration: 1.5s;
}

/* Enhanced responsiveness */
@media (max-width: 640px) {
    .logo-svg {
        height: 3.5rem;
    }
}

/* Dark mode enhancements */
@media (prefers-color-scheme: dark) {
    .logo-svg:hover {
        filter: drop-shadow(0 0 15px rgba(239, 68, 68, 0.5));
    }
    
    .tag-name:hover {
        fill: #F87171;
    }
}
</style>